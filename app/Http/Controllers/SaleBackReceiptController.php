<?php

namespace App\Http\Controllers;

use App\SaleReceiptItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use App\SaleReceipt;
use App\SaleBackReceipt;
use App\Customer;
use App\CommodityParent;
use App\Commodity;
use App\StockItem;

use Carbon\Carbon;

class SaleBackReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* sale back receipt presentation */
        $backReceiptList = SaleBackReceipt::all();
        $backReceiptSaleList = [];
        $backReceiptCommodityList = [];
        foreach ($backReceiptList as $backReceipt) {
            /* add sale receipt into list */
            $saleReceiptSet = saleReceipt::where('id', $backReceipt['salereceipt_id'])
                ->get();
            $saleReceipt = $saleReceiptSet[0];
            array_push($backReceiptsaleList, $saleReceipt);
            /* add commodity into list */
            $commoditySet = Commodity::where('id', $backReceipt['commodity_id'])
                ->get();
            $commodity = $commoditySet[0];
            array_push($backReceiptCommodityList, $commodity);
        }

        /* sale receipt presentation */
        $receiptListDB = saleReceipt::all();
        $receiptList = [];
        foreach ($receiptListDB as $receipt) {
            $customerSet = Customer::where('id', $receipt['saler_id'])
                ->get();
            $customerName = $customerSet[0]['name'];
            $receipt['customer_name'] = $customerName;
            array_push($receiptList, $receipt);
        }

        return view('inventory.sale', compact('receiptList', 'backReceiptList',
            'backReceiptSaleList', 'backReceiptCommodityList'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receiptListDB = SaleReceipt::all();
        $receiptList = [];
        foreach ($receiptListDB as $receipt) {
            $customerSet = Customer::where('id', $receipt['saler_id'])
                ->get();
            $customerName = $customerSet[0]['name'];
            $receipt['customer_name'] = $customerName;
            array_push($receiptList, $receipt);
        }

        return view('inventory.saleback_receipt', compact('receiptList', 'backReceiptList',
            'backReceiptSaleList', 'backReceiptCommodityList'));
    }

    public function showSale($id)
    {
        /* get receipt by id */
        $receiptSet = SaleReceipt::where('id', $id)
            ->get();
        $receipt = $receiptSet[0];

        /* get customer of receipt */
        $customerSet = Customer::where('id', $receipt->saler_id)
            ->get();
        $customer = $customerSet[0];

        /* get items of receipt */
        $items = SaleReceiptItem::where('salereceipt_id', $id)
            ->get();
        $parentList = [];
        $commodityList = [];

        /* get commodity/parent of items */
        foreach ($items as $item) {
            $commoditySet = Commodity::where('id', $item->commodity_id)
                ->get();
            $commodity = $commoditySet[0];
            array_push($commodityList, $commodity);

            $parentSet = CommodityParent::where('id', $commodity->parent_id)
                ->get();
            $parent = $parentSet[0];
            array_push($parentList, $parent);
        }

        return view('inventory.saleback_create', compact('receipt', 'customer', 'items', 'commodityList', 'parentList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $input = $request->all();

        /* create a sale back receipt */
        $input['created_at'] = Carbon::now()->addHours(8);
        $input['updated_at'] = Carbon::now()->addHours(8);
        SaleBackReceipt::create($input);

        /* get the item to be deleted */
        $item = DB::table('sale_receipt_items')
            ->where('salereceipt_id', $input['salereceipt_id'])
            ->where('commodity_id', $input['commodity_id'])
            ->first();
        $sum = $item->commodity_sum;

        /* change sum in the sale receipt */
        $receipt = SaleReceipt::findOrFail($id);
        $receipt['sum'] = $receipt['sum'] - $sum;
        $receipt->save();

        /* delete the item of the sale receipt */
        $query = DB::table('sale_receipt_items')
            ->where('salereceipt_id', $input['salereceipt_id'])
            ->where('commodity_id', $input['commodity_id']);
        $query->delete();
        //first() and delete() these functions execute the code.
        //So first assign your conditions to a variable and then execute them separately.

        /* update the money customer (should receive) */
        $customer = Customer::findOrFail($receipt['saler_id']);
        $shouldPay = $customer['should_pay'] + $sum;
        Customer::where('id', $receipt['saler_id'])
            ->update(['should_pay' => $shouldPay]);

        /* update the commodity item in stock */
        $stockId = $receipt['stock_id'];
        $stockItems = StockItem::where('stock_id', $stockId)
            ->where('commodity_id', $input['commodity_id'])
            ->get();
        if (count($stockItems) != 0) {
            /* update stock item with given commodity and stock id */
            $stockItemId = $stockItems[0]['id'];
            $stockItemTmp = StockItem::findOrFail($stockItemId);
            $stockItem['stock_id'] = $stockItemTmp['stock_id'];
            $stockItem['commodity_id'] = $stockItemTmp['commodity_id'];
            $stockItem['commodity_count'] = $stockItemTmp['commodity_count'] - $item->commodity_count;
            $stockItem['created_at'] = $stockItemTmp['created_at'];
            $stockItem['updated_at'] = Carbon::now()->addHours(8);

            $query = StockItem::where('stock_id', $stockId)
                ->where('commodity_id', $input['commodity_id']);
            $query->delete();

            if ($stockItem['commodity_count'] != 0) {
                StockItem::create($stockItem);
            }

        } else {
            /* create new stock item in the stock */
            $newItem['stock_id'] = $stockId;
            $newItem['commodity_id'] = $input['commodity_id'];
            $newItem['commodity_count'] = $input['commodity_count'];
            $newItem['created_at'] = Carbon::now()->addHours(8);
            $newItem['updated_at'] = Carbon::now()->addHours(8);

            StockItem::create($newItem);
        }

        return redirect('sale');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /* receipt */
        $receipt = SaleReceipt::findOrFail($id);

        /* items */
        $items = SaleReceiptItem::where('salereceipt_id', $id)
            ->get();

        /* customer */
        $customer = Customer::findOrFail($receipt['saler_id']);

        /* commodity list, parent list */
        $commodityList = [];
        $parentList = [];

        foreach ($items as $item) {
            $commoditySet = Commodity::where('id', $item['commodity_id'])
                ->where('is_deleted', 0)
                ->get();
            if (count($commoditySet) != 0) {
                $commodityId = $commoditySet[0]['id'];
                $commodity = Commodity::findOrFail($commodityId);
                array_push($commodityList, $commodity);
                $parentSet = CommodityParent::where('id', $commodity['parent_id'])
                    ->get();
                if (count($parentSet) != 0) {
                    $parentId = $parentSet[0]['id'];
                    $parent = CommodityParent::findOrFail($parentId);
                    array_push($parentList, $parent);
                } else {
                    abort(404);
                }
            } else {
                abort(404);
            }
        }
        /* item/customer/commodity/parent 一一对应 */
        return view('inventory.sale_show', compact('receipt', 'items', 'customer', 'commodityList', 'parentList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
