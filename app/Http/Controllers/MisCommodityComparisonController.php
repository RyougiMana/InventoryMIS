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
            $commodity['profit_quota'] = "无法计算";
        } else {
            $commodity['profit_quota'] = number_format(($purchase_sum / $purchase_count) / ($sale_sum / $sale_count), 2, '.', '');
        }

        $commodityList[$id] = $commodity;

        /* 商品分类、销售件数、总营业额、总利润额、利润占比 */
        return $commodity;
    }


    private function getCommodityMonth($id)
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
            $commodity['profit_quota'] = "无法计算";
        } else {
            $commodity['profit_quota'] = number_format(($purchase_sum / $purchase_count) / ($sale_sum / $sale_count), 2, '.', '');
        }

        $commodityList[$id] = $commodity;

        /* 商品分类、销售件数、总营业额、总利润额、利润占比 */
        return $commodity;
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


        return view('mis.commodity.comparison_make', compact('checkboxes'));
    }

}