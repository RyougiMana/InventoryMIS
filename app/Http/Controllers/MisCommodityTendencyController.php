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
        return view('mis.commodity.tendency', compact('id', 'misCommodityList'));
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
                $commoditySet = Commodity::where('id', $id)
                    ->get();
                $input['commodity_name'] = $commoditySet[0]['name'];
                $input['commodity_classification'] = $commoditySet[0]['classification'];

                /* commodity classification */
                $commodityParentSet = CommodityParent::where('id', $commoditySet[0]['parent_id'])
                    ->get();
                $input['commodity_parent'] = $commodityParentSet[0]['name'];

                $input['purchase_plan'] = $this->getPurchasePlan($id);
                $input['sale_plan'] = $this->getSalePlan($id);
                $input['star'] = $this->getStar($id);
                MisCommodity::create($input);
            }
        }

        /* get mis commodity list */
        $misCommodityListUnprocessed = MisCommodity::all();
        $misCommodityList = [];

        foreach ($misCommodityListUnprocessed as $commodity) {
            $purchasePlan = $commodity['purchase_plan'];
            $salePlan = $commodity['sale_plan'];
            $star = $commodity['star'];

            if ($purchasePlan == 0) {
                $commodity['purchase_plan'] = '减少进货';
            } else if ($purchasePlan == 1) {
                $commodity['purchase_plan'] = '保持不变';
            } else if ($purchasePlan == 2) {
                $commodity['purchase_plan'] = '增加进货';
            } else {
                $commodity['purchase_plan'] = '无法处理';
            }

            if ($salePlan == 0) {
                $commodity['sale_plan'] = '建议赠送';
            } else if ($salePlan == 1) {
                $commodity['sale_plan'] = '保持不变';
            } else if ($salePlan == 2) {
                $commodity['sale_plan'] = '建议主推';
            } else {
                $commodity['sale_plan'] = '无法处理';
            }

            if ($star == 0) {
                $commodity['star'] = '☆';
            } else if ($star == 1) {
                $commodity['star'] = '☆☆';
            } else if ($star == 2) {
                $commodity['star'] = '☆☆☆';
            } else if ($star == 3) {
                $commodity['star'] = '☆☆☆☆';
            } else if ($star == 4) {
                $commodity['star'] = '☆☆☆☆☆';
            } else if ($star == 5) {
                $commodity['star'] = '☆☆☆☆☆☆';
            } else {
                $commodity['star'] = '无法处理';
            }

            array_push($misCommodityList, $commodity);
        }

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


    /* return views */
    public function showPurchasePlan($id)
    {
        return view('mis.tendency.purchaseplan');
    }

    public function showSalePlan($id)
    {
        return view('mis.tendency.saleplan');
    }

    public function showStar($id)
    {
        return view('mis.tendency.star');
    }


}
