<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasePlan extends Model
{
    protected $table = 'purchase_plans';

    protected $fillable = ['id', 'commodity_id', 'commodity_name', 'commodity_parent', 'commodity_classification',
        'purchase_plan', 'created_at', 'updated_at'];
}
