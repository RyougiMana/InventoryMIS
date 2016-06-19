<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseReceiptItem extends Model
{
    protected $table = 'purchase_receipt_items';

    protected $fillable = ['id', 'purchasereceipt_id', 'commodity_id', 'commodity_count', 'commodity_price',
        'commodity_sum', 'is_back',
        'created_at', 'updated_at'];
}
