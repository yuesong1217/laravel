<?php

namespace App\hadmin;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'hadmin_login';
    protected $primaryKey = 'login_id';
    protected $guarded = [];
    public $timestamps = false;
}
