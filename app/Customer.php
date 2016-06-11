<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = ['id', 'is_saler', 'level', 'name', 'telephone', 'address',
        'zipcode', 'email', 'should_receive_quota', 'should_receive', 'should_pay',
        'created_at', 'updated_at'];
    /*
    id int primary key auto_increment,
    is_saler bool not null, 进货商:0; 销售商:1
    level int not null,
    name varchar(45) not null,
    telephone varchar(15),
    address varchar(115),
    zipcode varchar(45),
    email varchar(45),
    should_receive_quota double not null,
    should_receive double not null,
    should_pay double not null,
    created_at datetime,
    updated_at datetime
     */
}
