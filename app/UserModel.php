<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table='crm_user';
    public $timestamps = false;
    protected  $primaryKey ='crm_id';
}
