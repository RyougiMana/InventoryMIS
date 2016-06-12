<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use App\PurchaseReceipt;
use App\Customer;

use Carbon\Carbon;

class PurchaseReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        return view('inventory.purchase', compact('receiptList'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.purchase_create');
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
        $customerSet = Customer::where('name', $input['supplier_name'])
            ->where('is_saler', 0)
            ->get();
        if (count($customerSet) != 0) {
            $customerId = $customerSet[0]['id'];
        } else {
            abort(404);
        }
        $input['supplier_id'] = $customerId;
        $input['user_id'] = 1;
        $input['sum'] = 0;
        $input['daily_index'] = 0;

        $input['created_at'] = Carbon::now()->addHours(8);
        $input['updated_at'] = Carbon::now()->addHours(8);

        //TODO change daily index & user id
        $id = DB::table('purchase_receipts')->insertGetId(
            ['daily_index' => 0, 'supplier_id' => $customerId,
                'stock_id' => $input['stock_id'], 'user_id' => 1,
                'comment' => $input['comment'], 'sum' => 0,
                'created_at' => Carbon::now()->addHours(8),
                'updated_at' => Carbon::now()->addHours(8)]
        );

        return redirect('purchaseitem/create/{' . $id . '}');
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
}
