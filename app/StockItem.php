<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $table = 'stock_items';

    protected $fillable = ['id', 'stock_id', 'commodity_id', 'commodity_count',
        'created_at', 'updated_at'];
}
