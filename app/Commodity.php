<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $table = 'commodities';

    protected $fillable = ['id', 'parent_id', 'name', 'classification', 'count', 'purchase_price',
        'retail_price', 'recent_purchase_price', 'recent_retail_price', 'is_deleted',
        'created_at', 'updated_at'];
}
