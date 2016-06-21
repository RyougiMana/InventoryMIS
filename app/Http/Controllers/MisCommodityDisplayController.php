<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Commodity;
use App\CommodityParent;
use App\PurchaseReceiptItem;
use App\SaleReceiptItem;
use App\MisCommodity;

use Carbon\Carbon;

class MisCommodityDisplayController extends Controller
{
    /* 商品列表 */
    public function display()
    {
        /* get all parents and every parent's commodities amount */
        $parentList = CommodityParent::where('is_deleted', 0)
            ->orderby('updated_at', 'desc')
            ->get();
        foreach ($parentList as $parent) {
            $commoditiesOfParent = Commodity::where('is_deleted', 0)
                ->where('parent_id', $parent['id'])
                ->get();
            $parent['child_count'] = count($commoditiesOfParent);
        }

        /* get all commodities and their parents */
        $commodityList = Commodity::where('is_deleted', 0)
            ->orderby('updated_at', 'desc')
            ->get();
        $commodityParentList = [];
        foreach ($commodityList as $commodity) {
            $parent = CommodityParent::findOrFail($commodity['parent_id']);
            array_push($commodityParentList, $parent);
        }

        return view('mis.commodity_display', compact('parentList', 'commodityList', 'commodityParentList'));
    }

    public function classificationTendency($id)
    {
        $parent = CommodityParent::findOrFail($id);
        return view('mis.commodity_classification_tendency', compact('parent', 'id'));
    }

    public function getCommodityInfo($id)
    {
        $commodity = Commodity::findOrFail($id);
        return $commodity;
    }

    /* commodity tendency of year, season, month, day */
    public function getCommoditySaleInfoYear($id)
    {
        /* tendency during the past 5 years */
        $frequency = [0, 0, 0, 0, 0];
        $itemSet = SaleReceiptItem::where('commodity_id', $id)
            ->where('is_back', 0)
            ->get();
        $current_year = Carbon::now()->year;
        foreach ($itemSet as $item) {
            $created_at_year = $item['created_at']->year;
            if ($created_at_year >= ($current_year - 4)) {
                $frequency[$created_at_year - $current_year + 4] += $item['commodity_count'];
            }
        }
        return $frequency;
    }

    public function getCommoditySaleInfoMonth($id)
    {
        /* tendency during 12 months in current year */
        $frequency = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $itemSet = SaleReceiptItem::where('commodity_id', $id)
            ->where('is_back', 0)
            ->get();
        foreach ($itemSet as $item) {
            $created_at_year = $item['created_at']->year;
            $created_at_month = $item['created_at']->month;
            if ($created_at_year == Carbon::now()->year) {
                $frequency[$created_at_month] += $item['commodity_count'];
            }
        }
        return $frequency;
    }

    public function getCommoditySaleInfoDay($id)
    {
        /* tendency during 30 days in current month */
        $frequency = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $itemSet = SaleReceiptItem::where('commodity_id', $id)
            ->where('is_back', 0)
            ->get();
        $current_year = Carbon::now()->year;
        $current_month = Carbon::now()->month;
        $current_day = Carbon::now()->day;
        foreach ($itemSet as $item) {
            $created_at_year = $item['created_at']->year;
            $created_at_month = $item['created_at']->month;
            $created_at_day = $item['created_at']->day;
            if ($created_at_year == $current_year &&
                ($created_at_month == $current_month)
            ) {
                $frequency[$created_at_day] += $item['commodity_count'];
            }
        }
        return $frequency;
    }

    public function getCommodityPurchaseInfoYear($id)
    {
        /* tendency during the past 5 years */
        $frequency = [0, 0, 0, 0, 0];
        $itemSet = PurchaseReceiptItem::where('commodity_id', $id)
            ->where('is_back', 0)
            ->get();
        $current_year = Carbon::now()->year;
        foreach ($itemSet as $item) {
            $created_at_year = $item['created_at']->year;
            if ($created_at_year >= ($current_year - 4)) {
                $frequency[$created_at_year - $current_year + 4] += $item['commodity_count'];
            }
        }
        return $frequency;
    }

    public function getCommodityPurchaseInfoMonth($id)
    {
        /* tendency during 12 months in current year */
        $frequency = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $itemSet = PurchaseReceiptItem::where('commodity_id', $id)
            ->where('is_back', 0)
            ->get();
        foreach ($itemSet as $item) {
            $created_at_year = $item['created_at']->year;
            $created_at_month = $item['created_at']->month;
            if ($created_at_year == Carbon::now()->year) {
                $frequency[$created_at_month] += $item['commodity_count'];
            }
        }
        return $frequency;
    }

    public function getCommodityPurchaseInfoDay($id)
    {
        /* tendency during 30 days in current month */
        $frequency = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
            0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $itemSet = PurchaseReceiptItem::where('commodity_id', $id)
            ->where('is_back', 0)
            ->get();
        $current_year = Carbon::now()->year;
        $current_month = Carbon::now()->month;
        $current_day = Carbon::now()->day;
        foreach ($itemSet as $item) {
            $created_at_year = $item['created_at']->year;
            $created_at_month = $item['created_at']->month;
            $created_at_day = $item['created_at']->day;
            if ($created_at_year == $current_year &&
                ($created_at_month == $current_month)
            ) {
                $frequency[$created_at_day] += $item['commodity_count'];
            }
        }
        return $frequency;
    }

    /* get commodity tendency views */
    public function getCommodityTendencyYear($id)
    {
        /* the input id is mis primary id */
        $misCommodity = MisCommodity::findOrFail($id);

        $commodity = Commodity::where('name', $misCommodity['commodity_name'])
            ->get();
        $commodity = $commodity[0];

        $id = $commodity['id'];
        return view('mis.commodity.tendency_show', compact('commodity', 'id'));
    }

}
