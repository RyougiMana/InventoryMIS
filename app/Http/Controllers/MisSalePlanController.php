<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Commodity;
use App\CommodityParent;
use App\MisCommodity;
use App\SalePlan;

class MisSalePlanController extends Controller
{
    public function index()
    {
        return view('mis.business.sale_plan');
    }


    public function planCreate(Request $request)
    {
        $input = $request->all();

        /* create sale plan */
        SalePlan::create($input);

        /* change info in mis commodity */
        $misCommodity = MisCommodity::where('commodity_id', $input['commodity_id'])
            ->first();
        if ($input['sale_plan'] == 2) {
            $misCommodity['sale_plan'] = 2;
        } else if ($input['sale_plan'] == 0) {
            $misCommodity['sale_plan'] = 0;
        }
        $misCommodity->save();

        return view('mis.business.sale_plan');
    }

}
