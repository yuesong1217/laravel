<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {
        $info='清华大学欢迎您';
        $email='yuesong1217@163.com';
        send($email,$info);
    }

    

}
