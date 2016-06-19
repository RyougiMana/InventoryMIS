<?php

namespace App\Http\Controllers;

use App\PurchaseReceiptItem;
use App\SaleReceiptItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Commodity;
use App\CommodityParent;

use Carbon\Carbon;


class MisCommodityComparisonController extends Controller
{
    public function index()
    {
        $commoditySet = Commodity::where('is_deleted', 0)
            ->orderby('updated_at', 'desc')
            ->get();

        $commodityList = [];

        foreach ($commoditySet as $commodity) {
            $commodity = $this->getCommodity($commodity['id']);
            array_push($commodityList, $commodity);
        }

        return view('mis.commodity.comparison', compact('commodityList'));
    }

    private function getCommodity($id)
    {

        $commodity = Commodity::where('id', $id)->get();
        $commodity = $commodity[0];

        /* get parent name */
        $parent = CommodityParent::findOrFail($commodity['parent_id']);
        $commodity['parent_name'] = $parent['name'];

        $purchaseItems = PurchaseReceiptItem::where('commodity_id', $id)
            ->get();
        $purchase_count = 0;
        $purchase_sum = 0;
        foreach ($purchaseItems as $item) {
            $purchase_count = $purchase_count + $item['commodity_count'];
            $purchase_sum = $purchase_sum + $item['commodity_sum'];
        }
        $commodity['purchase_count'] = $purchase_count;
        $commodity['purchase_sum'] = $purchase_sum;

        $saleItems = SaleReceiptItem::where('commodity_id', $id)
            ->get();
        $sale_count = 0;
        $sale_sum = 0;

        foreach ($saleItems as $item) {
            $sale_count = $sale_count + $item['commodity_count'];
            $sale_sum = $sale_sum + $item['commodity_sum'];
        }
        $commodity['sale_count'] = $sale_count;
        $commodity['sale_sum'] = $sale_sum;

        /* 总利润计算方式:该时间段内总销售额-总营业额 */
        $commodity['profit'] = $purchase_sum - $sale_sum;
        /* 利润占比计算方式:平均进价/平均零售价 */
        if ($purchase_count == 0 || $sale_count == 0) {
            $commodity['profit_quota'] = 1;/* 无法计算 */
        } else {
            $commodity['profit_quota'] = number_format(($purchase_sum / $purchase_count) / ($sale_sum / $sale_count), 2, '.', '');
        }

        $commodityList[$id] = $commodity;

        /* 商品分类、销售件数、总营业额、总利润额、利润占比 */
        return $commodity;
    }


    public function getCommodityMonth($id)
    {
        /* 12 * 4 + 1 + 1 */
        /* 4 : 销售件数、总营业额、总利润额、利润占比. */
        /* 1 : 当前月份 */
        /* 1 : commodity name */
        $result = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
            0, 0];

        $purchaseCount = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $purchaseSum = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $saleCount = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $saleSum = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $profit = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $profitQuota = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        /* get commodity, name */
        $commodity = Commodity::where('id', $id)
            ->get();
        $commodity = $commodity[0];
        $result[49] = $commodity['name'];

        /* get current month */
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        for ($i = 0; $i < 12; $i++) {
            /* get purchase count, sum */
            $purchaseItems = PurchaseReceiptItem::where('commodity_id', $id)
                ->get();
            foreach ($purchaseItems as $item) {
                if ($item['created_at']->month == ($i + 1) && ($item['created_at']->year == $currentYear)) {
                    $purchaseCount[$i] += $item['commodity_count'];
                    $purchaseSum[$i] += $item['commodity_sum'];
                }
            }

            /* get sale count, sum */
            $saleItems = SaleReceiptItem::where('commodity_id', $id)
                ->get();
            foreach ($saleItems as $item) {
                if ($item['created_at']->month == ($i + 1) && ($item['created_at']->year == $currentYear)) {
                    $saleCount[$i] += $item['commodity_count'];
                    $saleSum[$i] += $item['commodity_sum'];
                }
            }
        }

        /* 总利润计算方式:该时间段内总销售额-总营业额 */
        /* 利润占比计算方式:平均进价/平均零售价 */
        for ($i = 0; $i < 12; $i++) {
            $profit[$i] = $purchaseSum[$i] - $saleSum[$i];
            if ($purchaseCount[$i] == 0 || $saleCount[$i] == 0) {
                $profitQuota[$i] = 1;/* 无法计算 */
            } else {
                //        $profitQuota[$i] = number_format(($purchaseSum[$i] / $purchaseCount[$i]) / ($saleSum[$i] / $saleCount[$i]), 2, '.', '');
                $profitQuota[$i] = ($purchaseSum[$i] / $purchaseCount[$i]) / ($saleSum[$i] / $saleCount[$i]);
            }
        }

        /* seed result */
        for ($i = 0; $i < 12; $i++) {
            $result[$i] = $saleCount[$i];
            $result[12 + $i] = $saleSum[$i];
            $result[24 + $i] = $profit[$i];
            $result[36 + $i] = $profitQuota[$i];
        }

        $result[48] = $currentMonth;

        return $result;
    }

    public function makeComparison(Request $request)
    {
        $checkboxes = $request->input('check_commodity');
        /* value parsing of checkbox in Laravel */

        $idSet = $checkboxes;
        $commodityList = [];
        foreach ($idSet as $id) {
            /* get commodity from db */
            $commodity = Commodity::where('id', $id)
                ->get();
            $commodity = $commodity[0];

            /* get sale count */

        }

        if (count($idSet) >= 1) {
            $idStr = $idSet[0];
            for ($i = 1; $i < count($idSet); $i++) {
                $idStr = $idStr . "," . $id;
            }
        }


        return view('mis.commodity.comparison_make', compact('checkboxes', 'idStr'));
    }

}