<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseBackReceipt extends Model
{
    protected $table = 'purchase_back_receipts';

    protected $fillable = ['id', 'purchasereceipt_id', 'commodity_id',
        'created_at', 'updated_at'];
}
