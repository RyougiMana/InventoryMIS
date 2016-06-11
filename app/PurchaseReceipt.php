<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseReceipt extends Model
{
    protected $table = 'purchase_receipts';

    protected $fillable = ['id', 'daily_index', 'supplier_id', 'stock_id', 'user_id', 'comment', 'sum',
        'created_at', 'updated_at'];
}
