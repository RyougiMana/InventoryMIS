<?php

namespace App\Http\Controllers;

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

        for ($k = 0; $k < count($commodities); $k++) {
            $commodity = $commodities[$k];

            $purchaseSum = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $saleSum = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            for ($i = 0; $i < 12; $i++) {
                /* get purchase count, sum */
                $purchaseItems = PurchaseReceiptItem::where('commodity_id', $commodity['id'])
                    ->where('is_back', 0)
                    ->get();
                foreach ($purchaseItems as $item) {
                    if ($item['created_at']->month == ($i + 1) && ($item['created_at']->year == $currentYear)) {
                        $purchaseSum[$i] += $item['commodity_sum'];
                    }
                }

                /* get sale count, sum */
                $saleItems = SaleReceiptItem::where('commodity_id', $commodity['id'])
                    ->where('is_back', 0)
                    ->get();
                foreach ($saleItems as $item) {
                    if ($item['created_at']->month == ($i + 1) && ($item['created_at']->year == $currentYear)) {
                        $saleSum[$i] += $item['commodity_sum'];
                    }
                }

                /* get profit */
                $commodityProfit[$i] = $saleSum[$i] - $purchaseSum[$i];
                $profitTendency[$i] += $commodityProfit[$i];
            }

            $commodity['profit'] = $commodityProfit;
        }

        return view('mis.commodity.classification_show', compact('parent', 'profitTendency'));
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
