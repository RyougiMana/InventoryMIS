<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleReceipt extends Model
{
    protected $table = 'sale_receipts';

    protected $fillable = ['id', 'daily_index', 'saler_id', 'stock_id', 'user_id',
        'sum', 'discount', 'coupon', 'final_sum',
        'created_at', 'updated_at'];
}