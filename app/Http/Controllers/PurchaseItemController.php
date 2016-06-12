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

        //get commodity id
        $commoditySet = Commodity::where('name', $commodityName)
            ->get();
        $commodityId = $commoditySet[0]['id'];
        $input['commodity_id'] = $commodityId;

        $input['created_at'] = Carbon::now()->addHours(8);
        $input['updated_at'] = Carbon::now()->addHours(8);

        //insert
        PurchaseReceiptItem::create($input);

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
