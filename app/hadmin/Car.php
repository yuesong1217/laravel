<?php

namespace App\hadmin;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'hadmin_car';
    protected $primaryKey = 'car_id';
    protected $guarded = [];
    public $timestamps = false;
}
