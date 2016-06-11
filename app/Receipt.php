<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = 'receipts';

    protected $fillable = ['id', 'type', /* type: 赠送、报溢、报损、报警 0 1 2 3 */
        'is_approved', 'created_at', 'updated_at'];

}
