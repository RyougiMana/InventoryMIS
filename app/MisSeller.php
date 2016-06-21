<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MisSeller extends Model
{
    protected $table = 'mis_sellers';

    protected $fillable = ['id', 'seller_id', 'seller_name', 'seller_plan'];

    public $timestamps = false;
}
