<?php

namespace App\hadmin;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{
    protected $table = 'hadmin_attr';
    protected $primaryKey = 'attr_id';
    protected $guarded = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key', 'other_key');
    }
}
