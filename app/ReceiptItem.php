<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
    protected $table = 'receipt_items';

    protected $fillable = ['id', 'receipt_id', 'commodity_id', 'commodity_count', 'count',
        'created_at', 'updated_at'];
}
