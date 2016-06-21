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
                        ->where('is_back', 0)
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
            $seller['star'] = 2;
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
        /* 一年总销售额,上月销售额,一年总退货件数,上月退货件数 */

        $customerList = Customer::where('is_saler', 1)->get();

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        foreach ($customerList as $customer) {
            /* 平均月消费额为当年一至当时月份的平均月消费 */
            $totalSum = 0;
            $lastMonthSum = 0;
            $totalCount = 0;
            $lastMonthCount = 0;
            $totalBackCount = 0;
            $lastMonthBackCount = 0;
            $receiptList = SaleReceipt::where('saler_id', $customer['id'])
                ->get();
            foreach ($receiptList as $receipt) {
                if ($receipt['created_at']->year == $currentYear) {
                    /* total sum */
                    $receiptItems = SaleReceiptItem::where('salereceipt_id', $receipt['id'])
                        ->where('is_back', 0)
                        ->get();
                    foreach ($receiptItems as $item) {
                        /* sum */
                        $totalSum += $item['commodity_sum'];
                        $totalCount += $item['commodity_count'];
                    }
                    /* last month sum */
                    if ($receipt['created_at']->month == $currentMonth) {
                        foreach ($receiptItems as $item) {
                            $lastMonthSum += $item['commodity_sum'];
                            $lastMonthCount += $item['commodity_count'];
                        }
                    }

                    /* back commodities count */
                    $receiptBackItems = SaleReceiptItem::where('salereceipt_id', $receipt['id'])
                        ->where('is_back', 1)
                        ->get();
                    foreach ($receiptBackItems as $item) {
                        /* sum */
                        $totalBackCount += $item['commodity_count'];

                    }
                    /* last month sum */
                    if ($receipt['created_at']->month == $currentMonth) {
                        foreach ($receiptBackItems as $item) {
                            $lastMonthBackCount += $item['commodity_count'];
                        }
                    }

                }
            }

            $customer['total_count'] = $totalCount;
            $customer['last_month_count'] = $lastMonthCount;
            $customer['total_sum'] = $totalSum;
            $customer['last_month_sum'] = $lastMonthSum;
            $customer['total_back_count'] = $totalBackCount;
            $customer['last_month_back_count'] = $lastMonthBackCount;

            if ($lastMonthCount == 0) {
                $backRanking = 0;
            } else if ($lastMonthBackCount / $lastMonthCount > 0.3) {
                $backRanking = 0;
            } else if ($lastMonthBackCount / $lastMonthCount > 0.1) {
                $backRanking = 1;
            } else {
                $backRanking = 2;
            }

            if ($lastMonthSum > 50000) {
                $sumRanking = 2;
            } else if ($lastMonthSum > 20000) {
                $sumRanking = 1;
            } else {
                $sumRanking = 0;
            }

            switch ($backRanking + $sumRanking) {
                case 0:
                    $customer['star'] = "☆";
                    break;
                case 1:
                    $customer['star'] = "☆☆";
                    break;
                case 2:
                    $customer['star'] = "☆☆☆";
                    break;
                case 3:
                    $customer['star'] = "☆☆☆☆";
                    break;
                case 4:
                    $customer['star'] = "☆☆☆☆☆";
                    break;
            }

            /* update mis seller star information */
            $toUpdate = MisSeller::where('seller_id', $customer['id'])
                ->first();
            $toUpdate['star'] = $backRanking + $sumRanking;
            $toUpdate->save();

        }


        return view('mis.seller.ranking', compact('customerList'));
    }

    public function plan()
    {
        return view('mis.seller.plan');
    }

}
