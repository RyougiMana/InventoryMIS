<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Commodity;
use App\CommodityParent;
use App\PurchaseReceiptItem;
use App\SaleReceiptItem;
use App\PurchaseBackReceipt;
use App\SaleBackReceipt;
use App\MisCommodity;

use Carbon\Carbon;

class MisCommodityRankingController extends Controller
{
    public function index()
    {
        $commoditySet = Commodity::where('is_deleted', 0)
            ->orderby('updated_at', 'desc')
            ->get();

        $commodityList = [];

        foreach ($commoditySet as $commodity) {
            $commodity = $this->getCommodity($commodity['id']);
            array_push($commodityList, $commodity);
        }

        return view('mis.commodity.ranking', compact('commodityList'));
    }

    private function getCommodity($id)
    {

        $commodity = Commodity::where('id', $id)->get();
        $commodity = $commodity[0];

        /* get parent name */
        $parent = CommodityParent::findOrFail($commodity['parent_id']);
        $commodity['parent_name'] = $parent['name'];

        $purchaseItems = PurchaseReceiptItem::where('commodity_id', $id)
            ->where('is_back', 0)
            ->get();
        $purchase_count = 0;
        $purchase_sum = 0;
        foreach ($purchaseItems as $item) {
            $purchase_count = $purchase_count + $item['commodity_count'];
            $purchase_sum = $purchase_sum + $item['commodity_sum'];
        }
        $commodity['purchase_count'] = $purchase_count;
        $commodity['purchase_sum'] = $purchase_sum;

        $saleItems = SaleReceiptItem::where('commodity_id', $id)
            ->where('is_back', 0)
            ->get();
        $sale_count = 0;
        $sale_sum = 0;

        foreach ($saleItems as $item) {
            $sale_count = $sale_count + $item['commodity_count'];
            $sale_sum = $sale_sum + $item['commodity_sum'];
        }
        $commodity['sale_count'] = $sale_count;
        $commodity['sale_sum'] = $sale_sum;

        /* 总利润计算方式:该时间段内总销售额-总营业额 */
        $commodity['profit'] = $purchase_sum - $sale_sum;
        /* 利润占比计算方式:平均进价/平均零售价 */
        if ($purchase_count == 0 || $sale_count == 0) {
            $commodity['profit_quota'] = 1;/* 无法计算 */
        } else {
            $commodity['profit_quota'] = number_format(($purchase_sum / $purchase_count) / ($sale_sum / $sale_count), 2, '.', '');
        }

        $commodityList[$id] = $commodity;

        /* 利润趋势 */
        $profitQuota = $this->getProfitTendency($id);
        if ($profitQuota[0] < $profitQuota[1]) {
            $commodity['profit_tendency'] = "增加";
            $profitRanking = 2;
            //        $commodity['profit_tendency'] = $profitQuota[0] . $profitQuota[1];
        } else if ($profitQuota[0] > $profitQuota[1]) {
            $commodity['profit_tendency'] = "减少";
            $profitRanking = 0;
            //        $commodity['profit_tendency'] = $profitQuota[0] . $profitQuota[1];
        } else {
            $commodity['profit_tendency'] = "不变";
            $profitRanking = 1;
        }

        /* 退货数量 */
        $purchaseBackReceipts = PurchaseBackReceipt::where('commodity_id', $id)
            ->get();
        $saleBackReceipts = SaleBackReceipt::where('commodity_id', $id)
            ->get();

        $purchaseBackCount = 0;
        foreach ($purchaseBackReceipts as $receipt) {
            $receiptId = $receipt['purchasereceipt_id'];
            $purchaseItems = PurchaseReceiptItem::where('purchasereceipt_id', $receiptId)
                ->where('is_back', 0)
                ->where('commodity_id', $id)
                ->get();
            $purchaseItem = $purchaseItems[0];
            $purchaseBackCount += $purchaseItem['commodity_count'];
        }
        $commodity['purchase_back_count'] = $purchaseBackCount;

        $saleBackCount = 0;
        foreach ($saleBackReceipts as $receipt) {
            $receiptId = $receipt['salereceipt_id'];
            $saleItems = SaleReceiptItem::where('salereceipt_id', $receiptId)
                ->where('is_back', 0)
                ->where('commodity_id', $id)
                ->get();
            $saleItem = $saleItems[0];
            $saleBackCount += $saleItem['commodity_count'];
        }
        $commodity['sale_back_count'] = $saleBackCount;

        /* 进货退货与销售的比例 */

        if ($purchase_count != 0) {
            $purchaseProportion = number_format(($purchaseBackCount / $purchase_count), 2, '.', '');
        } else {
            $purchaseProportion = 0;
        }
        $commodity['purchase_proportion'] = $purchaseProportion;

        /* 销售退货与销售的比例 */

        if ($sale_count != 0) {
            $saleProportion = number_format(($saleBackCount / $sale_count), 2, '.', '');
        } else {
            $saleProportion = 0;
        }
        $commodity['sale_proportion'] = $saleProportion;

        /* 得到口碑:
        若两个比例相加<0.01: 良好
        若两个比例相加>=0.01, <=0.04: 中等
        若两个比例相加>0.04: 差 */
        if (($purchaseProportion + $saleProportion) < 0.03) {
            $reputationRanking = 2;
            $commodity['reputation'] = "良好";
        } else if (($purchaseProportion + $saleProportion) < 0.075) {
            $commodity['reputation'] = "中等";
            $reputationRanking = 1;
        } else {
            $commodity['reputation'] = "差";
            $reputationRanking = 0;
        }

        /* get rank and update */
        $star = $profitRanking + $reputationRanking;
        switch ($star) {
            case 0:
                $commodity['star'] = "☆";
                break;
            case 1:
                $commodity['star'] = "☆☆";
                break;
            case 2:
                $commodity['star'] = "☆☆☆";
                break;
            case 3:
                $commodity['star'] = "☆☆☆☆";
                break;
            case 4:
                $commodity['star'] = "☆☆☆☆☆";
                break;
        }
        $query = MisCommodity::where('commodity_id', $id)
            ->first();
        $query['star'] = $star;
        $query->save();

        return $commodity;
    }

    private function getProfitTendency($id)
    {

        $purchaseCount = [0, 0];
        $purchaseSum = [0, 0];
        $saleCount = [0, 0];
        $saleSum = [0, 0];

        /* get current month */
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        for ($i = 0; $i < 2; $i++) {
            /* get purchase count, sum */
            $purchaseItems = PurchaseReceiptItem::where('commodity_id', $id)
                ->where('is_back', 0)
                ->get();
            foreach ($purchaseItems as $item) {
                if ($item['created_at']->month == ($i + $currentMonth - 1) && ($item['created_at']->year == $currentYear)) {
                    $purchaseCount[$i] += $item['commodity_count'];
                    $purchaseSum[$i] += $item['commodity_sum'];
                }
            }

            /* get sale count, sum */
            $saleItems = SaleReceiptItem::where('commodity_id', $id)
                ->where('is_back', 0)
                ->get();
            foreach ($saleItems as $item) {
                if ($item['created_at']->month == ($i + $currentMonth - 1) && ($item['created_at']->year == $currentYear)) {
                    $saleCount[$i] += $item['commodity_count'];
                    $saleSum[$i] += $item['commodity_sum'];
                }
            }
        }

        for ($i = 0; $i < 2; $i++) {
            $profit[$i] = $purchaseSum[$i] - $saleSum[$i];
            if ($purchaseCount[$i] == 0 || $saleCount[$i] == 0) {
                $profitQuota[$i] = 0.3;/* 无法计算 */
            } else {
                $profitQuota[$i] = ($purchaseSum[$i] / $purchaseCount[$i]) / ($saleSum[$i] / $saleCount[$i]);
            }
        }

        return $profitQuota;

    }

}
