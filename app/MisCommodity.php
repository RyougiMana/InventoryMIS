<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MisCommodity extends Model
{
    protected $table = 'mis_commodities';

    protected $fillable = ['id', 'commodity_id', 'commodity_name', 'commodity_parent', 'commodity_classification',
        'purchase_plan', 'sale_plan', 'star'];

    public $timestamps = false;
    /*
    commodity_id int not null,
    commodity_name varchar(45) not null,
    commodity_parent varchar(45) not null,
    commodity_classification varchar(45) not null,
    purchase_plan int not null, -- 0：减少进货；1：保持不变；2：增加进货
    sale_plan int not null, -- 0:设置赠送；1:保持不变；2:设置主推
    star int not null, -- 0, 1, 2, 3, 4
     */
}
