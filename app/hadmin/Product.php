<?php

namespace App\hadmin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'hadmin_product';
    protected $primaryKey = 'product_id';
    protected $guarded = [];
    public $timestamps = false;
}
