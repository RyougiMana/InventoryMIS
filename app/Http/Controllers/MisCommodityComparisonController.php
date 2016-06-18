<?php

namespace App\Http\Controllers;

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
        $commodityList = Commodity::where('is_deleted', 0)
            ->orderby('updated_at', 'desc')
            ->get();
        $commodityParentList = [];
        foreach ($commodityList as $commodity) {
            $parent = CommodityParent::findOrFail($commodity['parent_id']);
            array_push($commodityParentList, $parent);
        }

        return view('mis.commodity.comparison', compact('commodityList', 'commodityParentList'));
    }

    public function makeComparison(Request $request)
    {
        $checkboxes = $request->input('check_commodity');
        /* value parsing of checkbox in Laravel */
        return 1;
    }

}