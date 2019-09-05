<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin/user/login');
    }

    public function logindo()
    {
        $crm_user=request()->crm_user;
        // dd($crm_user);
        $crm_pwd=request()->crm_pwd;
        $where=[
            'crm_user'=>$crm_user,
            'crm_pwd'=>$crm_pwd,
        ];
        // dd($where);
        $user=DB::table('crm_user')->where($where)->first();
        // dd($user);
        // dd(!$crm_user==$user['crm_user']);
        // dd($user);
        if (!$crm_user==$user->crm_user) {
            echo "<script>alert('账号不存在！');location.href='/admin/login'</script>";
        }else if(!$crm_pwd==$user->crm_pwd){
            echo "<script>alert('密码不正确！');location.href='/admin/login'</script>";
        }else{
            echo "<script>alert('登录成功！');location.href='/admin/index'</script>";
            session(['userinfo'=>$user]);
        }
    }
}
