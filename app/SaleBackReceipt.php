<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleBackReceipt extends Model
{
    protected $table = 'sale_back_receipts';

    protected $fillable = ['id', 'salereceipt_id', 'commodity_id',
        'created_at', 'updated_at'];
}
