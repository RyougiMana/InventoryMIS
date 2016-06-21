<?php

namespace App\Http\Controllers;

use App\MisCommodity;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Commodity;
use App\CommodityParent;
use App\SaleReceiptItem;
use App\PurchaseReceiptItem;

use Carbon\Carbon;

class MisCommodityClassificationController extends Controller
{
    public function index()
    {

        $parentList = CommodityParent::all();
        $parentRelatedCommodityList = [];
        foreach ($parentList as $parent) {
            /* 得到每个商品种类下的商品 */
            $commodityTmpList = Commodity::where('parent_id', $parent['id'])
                ->get();
            array_push($parentRelatedCommodityList, $commodityTmpList);

            /* 得到每个种类的商品数量 */
            $parent['commodity_count'] = count($commodityTmpList);

            /* 得到每个种类中销量最大的商品 */
            $maxCount = 0;
            $maxCommodity = [];
            foreach ($commodityTmpList as $commodity) {
                $saleItems = SaleReceiptItem::where('commodity_id', $commodity['id'])
                    ->where('is_back', 0)
                    ->get();
                $saleCount = 0;
                foreach ($saleItems as $item) {
                    $saleCount += $item['commodity_count'];
                }
                $commodity['sale_count'] = $saleCount;
                if ($saleCount > $maxCount) {
                    $maxCount = $saleCount;
                    $maxCommodity = [];
                    array_push($maxCommodity, $commodity);
                } else if ($saleCount == $maxCount && ($maxCount != 0)) {
                    array_push($maxCommodity, $commodity);
                }
            }
            $parent['max_count'] = $maxCount;
            $parent['max_commodity'] = $maxCommodity;

        }

        return view('mis.commodity.classification', compact('parentList', 'parentRelatedCommodityList'));
    }

    public function getClassificationInfo($id)
    {
        /* 分类名称、分类下不同商品的月利润占比情况 */
        $parent = CommodityParent::where('id', $id)
            ->first();
        $commodities = Commodity::where('parent_id', $parent['id'])
            ->get();
        $profitTendency = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $currentYear = Carbon::now()->year;

        $parentTotalCount = 0;

        for ($k = 0; $k < count($commodities); $k++) {
            $commodity = $commodities[$k];

            $purchaseSum = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $saleSum = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            /* 单件商品的销量,销售额等 */
            $pSum = 0;
            $pCount = 0;
            $sSum = 0;
            $sCount = 0;

            for ($i = 0; $i < 12; $i++) {
                /* get purchase count, sum */
                $purchaseItems = PurchaseReceiptItem::where('commodity_id', $commodity['id'])
                    ->where('is_back', 0)
                    ->get();
                foreach ($purchaseItems as $item) {
                    if ($item['created_at']->month == ($i + 1) && ($item['created_at']->year == $currentYear)) {
                        $purchaseSum[$i] += $item['commodity_sum'];
                        $pSum += $item['commodity_sum'];
                        $pCount += $item['commodity_count'];
                    }
                }

                /* get sale count, sum */
                $saleItems = SaleReceiptItem::where('commodity_id', $commodity['id'])
                    ->where('is_back', 0)
                    ->get();
                foreach ($saleItems as $item) {
                    if ($item['created_at']->month == ($i + 1) && ($item['created_at']->year == $currentYear)) {
                        $saleSum[$i] += $item['commodity_sum'];
                        $sSum += $item['commodity_sum'];
                        $sCount += $item['commodity_count'];
                    }
                }

                /* get profit */
                $commodityProfit[$i] = $saleSum[$i] - $purchaseSum[$i];
                $profitTendency[$i] += $commodityProfit[$i];

                $commodity['purchase_count'] = $pCount;
                $commodity['purchase_sum'] = $pSum;
                $commodity['sale_count'] = $sCount;
                $commodity['sale_sum'] = $sSum;
                $commodity['c_profit'] = $sSum - $pSum;

            }

            $parentTotalCount += $commodity['sale_count'];
            $commodity['profit'] = $commodityProfit;

        }

        foreach ($commodities as $commodity) {
            $commodity['sale_quota'] = number_format(($commodity['sale_count'] / $parentTotalCount), 2, '.', '');
            if ($commodity['sale_count'] / $parentTotalCount > 0.3) {
                $commodity['recommend_sale_plan'] = 2;
            } else if ($commodity['sale_count'] / $parentTotalCount < 0.1) {
                $commodity['recommend_sale_plan'] = 0;
            } else {
                $commodity['recommend_sale_plan'] = 1;
            }

            $misCommodity = MisCommodity::where('commodity_id', $commodity['id'])
                ->first();
            $commodity['sale_plan'] = $misCommodity['sale_plan'];
        }

        return view('mis.commodity.classification_show', compact('parent', 'profitTendency', 'commodities'));
    }

    public function getAjaxInfo($id)
    {
        $info = [];
        /* info is composed of commodity count after commodity name */
        $parent = CommodityParent::where('id', $id)
            ->first();
        $commodities = Commodity::where('parent_id', $parent['id'])
            ->get();

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        foreach ($commodities as $commodity) {
            /* commodity name */
            array_push($info, $commodity['name']);

            /* commodity count */
            $count = 0;
            $saleItems = SaleReceiptItem::where('commodity_id', $commodity['id'])
                ->where('is_back', 0)
                ->get();
            foreach ($saleItems as $item) {
                if ($item['created_at']->month == $currentMonth && ($item['created_at']->year == $currentYear)) {
                    $count += $item['commodity_count'];
                }
            }
            array_push($info, $count);
        }

        return $info;
    }



}
