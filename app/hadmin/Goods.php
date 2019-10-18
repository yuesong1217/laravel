<?php

namespace App\hadmin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'hadmin_goods';
    protected $primaryKey = 'goods_id';
    protected $guarded = [];
    public $timestamps = false;
}
