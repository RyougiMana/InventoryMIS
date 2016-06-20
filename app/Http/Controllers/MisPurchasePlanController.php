<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Commodity;
use App\CommodityParent;
use App\MisCommodity;
use App\PurchasePlan;

class MisPurchasePlanController extends Controller
{
    public function rankingCreate(Request $request)
    {
        $input = $request->all();

        /* create purchase plan */
        PurchasePlan::create($input);

        /* change info in mis commodity */
        $misCommodity = MisCommodity::where('commodity_id', $input['commodity_id'])
            ->first();
        if ($input['purchase_plan'] == 2) {
            $misCommodity['purchase_plan'] = 2;
        } else if ($input['purchase_plan'] == 0) {
            $misCommodity['purchase_plan'] = 0;
        }
        $misCommodity->save();

        return view('mis.business.purchase_plan');
    }

}
