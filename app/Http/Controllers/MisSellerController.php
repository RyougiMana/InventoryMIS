<?php

namespace App\Http\Controllers;

use App\MisCommodity;
use App\ReceiptItem;
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

        /*
         *
                            <th>名称</th>
                            <th>平均月消费额</th>
                            <th>上月消费额</th>
                            <th>建议操作</th>
                            <th>查看消费趋势</th>
                            <th>查看可能感兴趣的商品</th>
         */

        $customerList = Customer::where('is_saler', 1)->get();

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        foreach ($customerList as $customer) {
            /* 平均月消费额为当年一至当时月份的平均月消费 */
            $totalSum = 0;
            $lastMonthSum = 0;
            $receiptList = SaleReceipt::where('saler_id', $customer['id'])
                ->get();
            foreach ($receiptList as $receipt) {
                if ($receipt['created_at']->year == $currentYear) {
                    /* total sum */
                    $receiptItems = SaleReceiptItem::where('salereceipt_id', $receipt['id'])
                        ->get();
                    foreach ($receiptItems as $item) {
                        $totalSum += $item['commodity_sum'];
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
            $seller['seller_plan'] = $customer['recommend_seller_plan'];
            $sellerList = MisSeller::where('seller_id', $customer['id'])
                ->get();

            if (count($sellerList) == 0) {
                MisSeller::create($seller);
                $customer['seller_plan'] = $customer['recommend_seller_plan'];
            } else {
                $misSeller = $sellerList[0];
                $customer['seller_plan'] = $misSeller['seller_plan'];
            }

        }


        return view('mis.seller.tendency', compact('customerList'));
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
