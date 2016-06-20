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

        if ($input['purchase_plan'] == 'increase') {
            $input['purchase_plan'] = 2;
        } else if ($input['purchase_plan'] == 'decrease') {
            $input['purchase_plan'] = 0;
        }

        PurchasePlan::create($input);

        return view('mis.business.purchase_plan');
    }

}
