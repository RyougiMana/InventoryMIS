<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\StockItem;
use App\CommodityParent;
use App\Commodity;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class StockController extends Controller
{
    public function index()
    {
        $stockList = Stock::all();
        return view('inventory.stock', compact('stockList'));
    }

    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        $stockItemList = DB::table('stock_items')
            ->where('stock_id', $id)
            ->get();

        $parentList = [];
        $commodityList = [];
        foreach ($stockItemList as $item) {
            $commodity = Commodity::where('id', $item['commodity_id'])
                ->first();
            array_push($commodityList, $commodity);

            $parent = CommodityParent::where('id', $commodity->parent_id)
                ->first();
            array_push($parentList, $parent);
        }

        return view('inventory.stock_show', compact('stock', 'stockItemList', 'parentList', 'commodityList'));
    }

}