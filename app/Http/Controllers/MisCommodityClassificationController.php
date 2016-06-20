<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Commodity;
use App\CommodityParent;
use App\SaleReceiptItem;
use App\PurchaseReceiptItem;

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

    }


}
