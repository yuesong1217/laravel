<?php

namespace App\hadmin;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = 'hadmin_cate';
    protected $primaryKey = 'cate_id';
    protected $guarded = [];
    public $timestamps = false;
}
