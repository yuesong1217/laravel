<?php

namespace App\hadmin;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'hadmin_type';
    protected $primaryKey = 'type_id';
    protected $guarded = [];
    public $timestamps = false;
}
