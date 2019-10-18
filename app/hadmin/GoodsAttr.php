<?php

namespace App\hadmin;

use Illuminate\Database\Eloquent\Model;

class GoodsAttr extends Model
{
    protected $table = 'hadmin_val';
    protected $primaryKey = 'val_id';
    protected $guarded = [];
    public $timestamps = false;
}
