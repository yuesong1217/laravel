<?php

namespace App\Api;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'api_goods';
    protected $primaryKey = 'goods_id';
    protected $guarded = [];
    public $timestamps = false;
}

