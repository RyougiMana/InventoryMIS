<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleReceiptItem extends Model
{
    protected $table = 'sale_receipt_items';

    protected $fillable = ['id', 'salereceipt_id', 'commodity_id', 'commodity_count', 'commodity_price',
        'commodity_sum', 'is_back',
        'created_at', 'updated_at'];
}
