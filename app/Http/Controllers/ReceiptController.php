<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Receipt;
use App\ReceiptItem;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presentReceiptList = [];
        $overflowReceiptList = [];
        $lossReceiptList = [];
        $alertReceiptList = [];

        return view('inventory.receipt', compact('presentReceiptList', 'overflowReceiptList',
            'lossReceiptList', 'alertReceiptList', 'items'));
    }

    public function createPresent()
    {
        $type = 0;
//        return view('inventory.receipt_create', compact('type'));
        return 1;
    }

    public function createOverflow()
    {
        $type = 1;
        return view('inventory.receipt_create', compact('type'));
    }

    public function createLoss()
    {
        $type = 2;
        return view('inventory.receipt_create', compact('type'));
    }

    public function createAlert()
    {
        $type = 3;
        return view('inventory.receipt_create', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * $id = DB::table('receipts')->insertGetId(
            ['is_approved' => '0', 'created_at' => Carbon::now()->addHours(8), 'updated_at' => Carbon::now()->addHours(8)]
        );*/
        return view('inventory.receipt_create', compact('items'));
    }

    public function storeItem(Request $request)
    {
        $input = $request->all();
        $name = $input['commodity_name'];
        $count = $input['commodity_count'];
        $items = $this->items;
        $items[$name] = $count;
        $this->items = $items;
        return view('inventory.receipt_create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $items = [];
        $input = $request->all();

        return $input['receipt_name'];
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
