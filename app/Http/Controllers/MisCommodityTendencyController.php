<?php

namespace App\Http\Controllers;

use App\MisCommodity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Commodity;
use App\CommodityParent;
use App\PurchaseReceiptItem;
use App\SaleReceiptItem;

use Carbon\Carbon;

class MisCommodityTendencyController extends Controller
{

    /* 商品走势 */

    public function tendency()
    {
        $misCommodityList = $this->init();
        return view('mis.commodity_tendency', compact('id', 'misCommodityList'));
    }

    private function init()
    {
        /* create rank for those not in the mis db */
        $commodityList = Commodity::all();
        foreach ($commodityList as $commodity) {
            $mis_commodity = MisCommodity::where('commodity_id', $commodity['id'])
                ->get();
            if (count($mis_commodity) == 0) {
                $id = $commodity['id'];
                $input['commodity_id'] = $id;

                /* commodity name */
                $commoditySet = Commodity::where('id', $id)->all();
                $input['commodity_name'] = $commoditySet[0]['name'];
                $input['commodity_classification'] = $commoditySet[0]['classification'];

                /* commodity classification */
                $commodityParentSet = CommodityParent::where('id', $commoditySet[0]['parent_id']);
                $input['commodity_parent'] = $commodityParentSet[0]['name'];

                $input['purchase_plan'] = $this->getPurchasePlan($id);
                $input['sale_plan'] = $this->getSalePlan($id);
                $input['star'] = $this->getStar($id);
                MisCommodity::create($input);
            }
        }

        /* get mis commodity list */
        $misCommodityList = MisCommodity::all();
        return $misCommodityList;

    }

    private function getPurchasePlan($id)
    {
        return 0;
    }

    private function getSalePlan($id)
    {
        return 0;
    }

    private function getStar($id)
    {
        return 0;
    }

    /*
    commodity_id int not null,
    commodity_name varchar(45) not null,
    commodity_parent varchar(45) not null,
    commodity_classification varchar(45) not null,
    purchase_plan int not null, -- 0：减少进货；1：保持不变；2：增加进货
    sale_plan int not null, -- 0:设置赠送；1:保持不变；2:设置主推
    star int not null, -- 0, 1, 2, 3, 4
     */


}
