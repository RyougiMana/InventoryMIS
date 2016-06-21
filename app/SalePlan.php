<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalePlan extends Model
{
    protected $table = 'sale_plans';

    protected $fillable = ['id', 'commodity_id', 'commodity_name', 'commodity_parent', 'commodity_classification',
        'sale_plan', 'created_at', 'updated_at'];
}
