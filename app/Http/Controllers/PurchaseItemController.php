<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Commodity;
use App\CommodityParent;
use App\Customer;
use App\PurchaseReceipt;
use App\PurchaseBackReceipt;
use App\PurchaseReceiptItem;
use App\StockItem;

use Carbon\Carbon;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param $id receipt id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //get commodity parent list
        $parentList = $this->getParentList();

        //get commodity list
        $commodityList = $this->getCommodityList();

        return view('inventory.purchaseitem_create', compact('parentList', 'commodityList', 'id'));
    }

    private function getParentList()
    {
        $parentList = [];
        $commodityParents = CommodityParent::where('is_deleted', 0)
            ->orderby('updated_at', 'desc')
            ->get();

        foreach ($commodityParents as $commodityParent) {
            $parentList[$commodityParent->id] = $commodityParent->name;
        }
        return $parentList;
    }

    private function getCommodityList()
    {
        $commodityList = [];
        $commodityParents = CommodityParent::where('is_deleted', 0)
            ->orderby('updated_at', 'desc')
            ->get();

        foreach ($commodityParents as $commodityParent) {
            $tmpList = [];
            $commodities = Commodity::where('parent_id', $commodityParent->id)
                ->orderby('updated_at', 'desc')
                ->get();
            foreach ($commodities as $commodity) {
                array_push($tmpList, $commodity);
            }
            $commodityList[$commodityParent->id] = $tmpList;
        }
        return $commodityList;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        /* process id before and after the method body */

        //current id reference to {$id}
        $id = substr($id, 1, strlen($id) - 2);

        $this->validate($request, [
            'commodity_name' => 'required',
            'commodity_count' => 'required',
            'commodity_price' => 'required'
        ]);

        $input['purchasereceipt_id'] = $id;

        $commodityName = $this->str_trim($request->commodity_name);

        $input['commodity_count'] = $this->str_trim($request->commodity_count);
        $input['commodity_price'] = $this->str_trim($request->commodity_price);
        $input['commodity_sum'] = $input['commodity_count'] * $input['commodity_price'];

        /* modify sum in the receipt by adding sum of item created */
        $receipt = PurchaseReceipt::find($id);
        $receipt['sum'] = $receipt['sum'] + $input['commodity_sum'];
        $receipt->save();

        //get commodity id
        $commoditySet = Commodity::where('name', $commodityName)
            ->get();
        $commodityId = $commoditySet[0]['id'];
        $input['commodity_id'] = $commodityId;

        $input['created_at'] = Carbon::now()->addHours(8);
        $input['updated_at'] = Carbon::now()->addHours(8);

        /* update commodity's attribute recent purchase price */
        Commodity::where('id', $commodityId)
            ->update(['recent_purchase_price' => $input['commodity_price']]);

        /* update the money customer (should pay) */
        $customer = Customer::findOrFail($receipt['supplier_id']);
        $shouldPay = $customer['should_pay'] + $input['commodity_sum'];
        Customer::where('id', $receipt['supplier_id'])
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
            $stockItem['commodity_count'] = $stockItemTmp['commodity_count'] + $input['commodity_count'];
            $stockItem['created_at'] = $stockItemTmp['created_at'];
            $stockItem['updated_at'] = Carbon::now()->addHours(8);

            $query = StockItem::where('stock_id', $stockId)
                ->where('commodity_id', $input['commodity_id']);
            $query->delete();

            StockItem::create($stockItem);
        } else {
            /* create new stock item in the stock */
            $newItem['stock_id'] = $stockId;
            $newItem['commodity_id'] = $input['commodity_id'];
            $newItem['commodity_count'] = $input['commodity_count'];
            $newItem['created_at'] = Carbon::now()->addHours(8);
            $newItem['updated_at'] = Carbon::now()->addHours(8);

            StockItem::create($newItem);
        }

        /* judge if commodity in the item */
        $itemsInReceipt = PurchaseReceiptItem::where('purchasereceipt_id', $id)
            ->get();
        $inReceipt = 0;
        foreach ($itemsInReceipt as $itemInReceipt) {
            if ($itemInReceipt['commodity_id'] == $commodityId) {
                $inReceipt = 1;
            }
        }
        /* $inReceipt : 1 : commodity already in receipt, change item */
        /* $inReceipt : 0 : commodity not in receipt, insert item */
        if ($inReceipt === 1) {
            $item = PurchaseReceiptItem::where('commodity_id', $commodityId)
                ->where('purchasereceipt_id', $input['purchasereceipt_id'])
                ->first();

            $query = PurchaseReceiptItem::where('commodity_id', $commodityId);
            $query->delete();

            $input['commodity_count'] = $item['commodity_count'] + $input['commodity_count'];
            $input['commodity_sum'] = $item['commodity_sum'] + $input['commodity_sum'];
            $input['updated_at'] = Carbon::now()->addHours(8);

            PurchaseReceiptItem::create($input);

        } else {
            PurchaseReceiptItem::create($input);
        }

        //get commodity parent list
        $parentList = $this->getParentList();

        //get commodity list
        $commodityList = $this->getCommodityList();

        //get id
        $id = '{' . $input['purchasereceipt_id'] . '}';

        return view('inventory.purchaseitem_create', compact('parentList', 'commodityList', 'id'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    private function str_trim($value)
    {

        $value = str_replace("全角空格", " ", trim($value));
        $value = preg_replace("/^[\s\v" . chr(194) . chr(160) . "]+/", "", $value);
        $value = preg_replace("/[\s\v" . chr(194) . chr(160) . "]+$/", "", $value);

        return $value;

    }

}
