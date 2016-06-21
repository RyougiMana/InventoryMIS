<?php

namespace App\Http\Controllers;

use App\MisCommodity;
use App\ReceiptItem;
use App\SellerPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Commodity;
use App\CommodityParent;
use App\PurchaseReceiptItem;
use App\SaleReceiptItem;
use App\Customer;
use App\SaleReceipt;
use App\MisSeller;
use App\ManagementPlan;

use Carbon\Carbon;

class MisManagementController extends Controller
{
    public function planIndex()
    {

        $planList = ManagementPlan::all();

        return view('mis.management.plan', compact('planList'));
    }

    public function getPurchase()
    {

        $tendency = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $currentYear = Carbon::now()->year;

        $itemList = PurchaseReceiptItem::where('is_back', 0)
            ->get();
        foreach ($itemList as $item) {
            if ($item['created_at']->year == $currentYear) {
                $tendency[$item['created_at']->month - 1] += $item['commodity_sum'];
            }
        }

        return $tendency;

    }

    public function getSale()
    {

        $tendency = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $currentYear = Carbon::now()->year;

        $itemList = SaleReceiptItem::where('is_back', 0)
            ->get();
        foreach ($itemList as $item) {
            if ($item['created_at']->year == $currentYear) {
                $tendency[$item['created_at']->month - 1] += $item['commodity_sum'];
            }
        }

        return $tendency;

    }

    public function create()
    {
        return view('mis.management.plan_create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        ManagementPlan::create($input);

        return redirect('mis/management/plan');
    }

}
