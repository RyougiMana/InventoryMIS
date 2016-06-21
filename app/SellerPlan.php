<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerPlan extends Model
{
    protected $table = 'seller_plans';

    protected $fillable = ['id', 'seller_id', 'seller_name', 'seller_plan',
        'created_at', 'updated_at'];
}
