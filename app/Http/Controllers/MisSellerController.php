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

use Carbon\Carbon;

class MisSellerController extends Controller
{
    public function tendency()
    {
        $customerList = Customer::where('is_saler', 1)->get();

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        foreach ($customerList as $customer) {
            /* 平均月消费额为当年一至当时月份的平均月消费 */
            $totalSum = 0;
            $lastMonthSum = 0;
            $purchaseMostCount = 0;
            $purchaseMostCommodityId = 0;
            $receiptList = SaleReceipt::where('saler_id', $customer['id'])
                ->get();
            foreach ($receiptList as $receipt) {
                if ($receipt['created_at']->year == $currentYear) {
                    /* total sum */
                    $receiptItems = SaleReceiptItem::where('salereceipt_id', $receipt['id'])
                        ->get();
                    foreach ($receiptItems as $item) {
                        /* sum */
                        $totalSum += $item['commodity_sum'];
                        /* get most purchase commodity */
                        if ($item['commodity_count'] > $purchaseMostCount) {
                            $purchaseMostCount = $item['commodity_count'];
                            $purchaseMostCommodityId = $item['commodity_id'];
                        }
                    }
                    /* last month sum */
                    if ($receipt['created_at']->month == $currentMonth) {
                        foreach ($receiptItems as $item) {
                            $lastMonthSum += $item['commodity_sum'];
                        }
                    }
                }
            }
            $avgSum = number_format($totalSum / $currentMonth, 2, '.', '');
            $customer['avg_sum'] = $avgSum;
            $customer['last_month_sum'] = $lastMonthSum;

            /* recommend operation */
            if ($lastMonthSum <= $avgSum) {
                $customer['recommend_seller_plan'] = 0;
            } else {
                $customer['recommend_seller_plan'] = 1;
            }

            $seller['seller_id'] = $customer['id'];
            $seller['seller_name'] = $customer['name'];
            $seller['seller_plan'] = 1;
            $sellerList = MisSeller::where('seller_id', $customer['id'])
                ->get();

            if (count($sellerList) == 0) {
                MisSeller::create($seller);
                $customer['seller_plan'] = $customer['recommend_seller_plan'];
            } else {
                $misSeller = $sellerList[0];
                $customer['seller_plan'] = $misSeller['seller_plan'];
            }

            /* 可能感兴趣的商品 */
            if ($purchaseMostCount != 0) {
                $commodity = Commodity::findOrFail($purchaseMostCommodityId);
                $parent_id = $commodity['parent_id'];
                $classification = $commodity['classification'];
                $commodityList = Commodity::where('parent_id', $parent_id)
                    ->where('classification', $classification)
                    ->get();
                $customer['commodities'] = $commodityList;
            }

        }


        return view('mis.seller.tendency', compact('customerList'));
    }

    public function makePlan(Request $request)
    {
        $input = $request->all();
        SellerPlan::create($input);

        return redirect('/mis/seller/plan');
    }

    public function showTendency($id)
    {
        return view('mis.seller.tendency_show', compact('id'));
    }

    public function getTendencyInfo($id)
    {
        $currentYear = Carbon::now()->year;

        $tendency = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $receiptList = SaleReceipt::where('saler_id', $id)
            ->get();
        foreach ($receiptList as $receipt) {
            if ($receipt['created_at']->year == $currentYear) {
                $receiptItems = SaleReceiptItem::where('salereceipt_id', $receipt['id'])
                    ->get();
                foreach ($receiptItems as $item) {
                    $month = $item['created_at']->month;
                    $tendency[$month - 1] += $item['commodity_sum'];
                }
            }
        }

        return $tendency;
    }

    public function getAverageInfo($id)
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $customer = Customer::findOrFail($id);

        $totalSum = 0;
        $receiptList = SaleReceipt::where('saler_id', $customer['id'])
            ->get();
        foreach ($receiptList as $receipt) {
            if ($receipt['created_at']->year == $currentYear) {
                $receiptItems = SaleReceiptItem::where('salereceipt_id', $receipt['id'])
                    ->get();
                foreach ($receiptItems as $item) {
                    $totalSum += $item['commodity_sum'];
                }
            }
        }
        $avg = $totalSum / $currentMonth;
        $avgSum = [];
        for ($i = 0; $i < $currentMonth; $i++) {
            array_push($avgSum, $avg);
        }
        for ($i = $currentMonth; $i < 12; $i++) {
            array_push($avgSum, 0);
        }

        return $avgSum;
    }


    public function ranking()
    {
        return view('mis.seller.ranking');
    }

    public function plan()
    {
        return view('mis.seller.plan');
    }

}
