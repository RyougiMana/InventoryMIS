<?php

namespace App\Http\Controllers;

use App\PurchaseReceiptItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use App\PurchaseReceipt;
use App\PurchaseBackReceipt;
use App\Customer;
use App\CommodityParent;
use App\Commodity;

use Carbon\Carbon;

class PurchaseBackReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* purchase back receipt presentation */
        $backReceiptList = PurchaseBackReceipt::all();
        $backReceiptPurchaseList = [];
        $backReceiptCommodityList = [];
        foreach ($backReceiptList as $backReceipt) {
            /* add purchase receipt into list */
            $purchaseReceiptSet = PurchaseReceipt::where('id', $backReceipt['purchasereceipt_id'])
                ->get();
            $purchaseReceipt = $purchaseReceiptSet[0];
            array_push($backReceiptPurchaseList, $purchaseReceipt);
            /* add commodity into list */
            $commoditySet = Commodity::where('id', $backReceipt['commodity_id'])
                ->get();
            $commodity = $commoditySet[0];
            array_push($backReceiptCommodityList, $commodity);
        }

        /* purchase receipt presentation */
        $receiptListDB = PurchaseReceipt::all();
        $receiptList = [];
        foreach ($receiptListDB as $receipt) {
            $customerSet = Customer::where('id', $receipt['supplier_id'])
                ->get();
            $customerName = $customerSet[0]['name'];
            $receipt['customer_name'] = $customerName;
            array_push($receiptList, $receipt);
        }

        return view('inventory.purchase', compact('receiptList', 'backReceiptList',
            'backReceiptPurchaseList', 'backReceiptCommodityList'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receiptListDB = PurchaseReceipt::all();
        $receiptList = [];
        foreach ($receiptListDB as $receipt) {
            $customerSet = Customer::where('id', $receipt['supplier_id'])
                ->get();
            $customerName = $customerSet[0]['name'];
            $receipt['customer_name'] = $customerName;
            array_push($receiptList, $receipt);
        }

        return view('inventory.purchaseback_receipt', compact('receiptList', 'backReceiptList',
            'backReceiptPurchaseList', 'backReceiptCommodityList'));
    }

    public function showPurchase($id)
    {
        /* get receipt by id */
        $receiptSet = PurchaseReceipt::where('id', $id)
            ->get();
        $receipt = $receiptSet[0];

        /* get customer of receipt */
        $customerSet = Customer::where('id', $receipt->supplier_id)
            ->get();
        $customer = $customerSet[0];

        /* get items of receipt */
        $items = PurchaseReceiptItem::where('purchasereceipt_id', $id)
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

        return view('inventory.purchaseback_create', compact('receipt', 'customer', 'items', 'commodityList', 'parentList'));
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

        /* create a purchase back receipt */
        $input['created_at'] = Carbon::now()->addHours(8);
        $input['updated_at'] = Carbon::now()->addHours(8);
        PurchaseBackReceipt::create($input);

        /* get the item to be deleted */
//        dd($input);
        $itemSet = PurchaseReceiptItem::all();
//        $itemSet = PurchaseReceiptItem::where('purchasereceipt_id', $input->purchasereceipt_id)
//            ->where('commodity_id', $input->commodity_id)
//            ->get();
//        dd("test");
        $item = $itemSet[0];
        $sum = $item->commodity_sum;

        /* change sum in the purchase receipt */
        $receipt = PurchaseReceipt::findOrFail($id);
        $receipt['sum'] = $receipt['sum'] - $sum;

        /* delete the item of the purchase receipt */
        DB::table('purchase_receipt_items')
            ->where('id', $item['id'])
            ->delete();

        return redirect('purchase');
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
        $receipt = PurchaseReceipt::findOrFail($id);

        /* items */
        $items = PurchaseReceiptItem::where('purchasereceipt_id', $id)
            ->get();

        /* customer */
        $customer = Customer::findOrFail($receipt['supplier_id']);

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
        return view('inventory.purchase_show', compact('receipt', 'items', 'customer', 'commodityList', 'parentList'));
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
