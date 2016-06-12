<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Customer;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $customerList = Customer::all();
        $customerList = DB::table('customers')->paginate(10);

        return view('inventory.customer', compact('customerList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.customer_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'name' => 'required|unique:customers|min:1|max:45',
            'is_saler' => 'required',
        ]);
        $input['name'] = $this->str_trim($input['name']);
        $input['created_at'] = Carbon::now()->addHours(8);
        $input['updated_at'] = Carbon::now()->addHours(8);
        Customer::create($input);

        return redirect('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('inventory.customer_show', compact('customer'));
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
