<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Commodity;
use App\CommodityParent;

use Carbon\Carbon;

class CommodityDisplayController extends Controller
{
    public function index()
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
}
