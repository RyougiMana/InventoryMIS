<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommodityParent extends Model
{
    protected $table = 'commodity_parents';

    protected $fillable = ['id', 'name', 'is_deleted', 'created_at', 'updated_at'];
}
