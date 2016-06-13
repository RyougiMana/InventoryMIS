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

use Carbon\Carbon;

class SaleReceiptController extends Controller
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
            $SaleReceiptSet = SaleReceipt::where('id', $backReceipt['salereceipt_id'])
                ->get();
            $SaleReceipt = $SaleReceiptSet[0];
            array_push($backReceiptSaleList, $SaleReceipt);
            /* add commodity into list */
            $commoditySet = Commodity::where('id', $backReceipt['commodity_id'])
                ->get();
            $commodity = $commoditySet[0];
            array_push($backReceiptCommodityList, $commodity);
        }

        /* sale receipt presentation */
        $receiptListDB = SaleReceipt::all();
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
        return view('inventory.sale_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'stock_id' => 'required',
        ]);
        $input = $request->all();

        /* get customer id by name */
        $customerSet = Customer::where('name', $input['saler_name'])
            ->where('is_saler', 1)
            ->get();
        if (count($customerSet) != 0) {
            $customerId = $customerSet[0]['id'];
        } else {
            abort(404);
        }

        /* seed input's values */
        $input['saler_id'] = $customerId;
        $input['user_id'] = 1;
        $input['sum'] = 0;
        $input['daily_index'] = 0;

        $input['created_at'] = Carbon::now()->addHours(8);
        $input['updated_at'] = Carbon::now()->addHours(8);

        //TODO change daily index & user id
        $id = DB::table('sale_receipts')->insertGetId(
            ['daily_index' => 0, 'saler_id' => $customerId,
                'stock_id' => $input['stock_id'], 'user_id' => 1,
                'sum' => 0,
                'created_at' => Carbon::now()->addHours(8),
                'updated_at' => Carbon::now()->addHours(8)]
        );

        return redirect('saleitem/create/{' . $id . '}');
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
