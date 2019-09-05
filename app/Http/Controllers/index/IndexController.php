<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $count=DB::table('goods')->count();
        $goods_commen=DB::table('goods')->where(['goods_commen'=>1])->get();
        $topcate=DB::table('cate')->where(['pid'=>0])->get();
        $goods_hot=DB::table('goods')->where(['goods_hot'=>1])->get();
        $goods_best=DB::table('goods')->where(['goods_best'=>1])->get();
        // dd($count);
        return view('index/index',['count'=>$count,'goods_commen'=>$goods_commen,'topcate'=>$topcate,'goods_hot'=>$goods_hot,'goods_best'=>$goods_best]);
    }

    public function reg()
    {
        return view('index/reg');
    }

    public function login()
    {
        // dd(request()->session()->get('userindex'));
        return view('index/login');
    }

    public function wechat_login()
    {
        $redirect_url = "http://www.yuesong.com/wechat/code";
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_url).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        header('Location:'.$url);
    }

    public function logindo()
    {
        $post=request()->except('_token');
        $user=DB::table('user')->where(['user_email'=>$post['user_email']])->first();
        // dd($user);
        
        if ($user->user_email!=$post['user_email']) {
            echo json_encode(['code'=>0,'msg'=>'账号不存在']);die;
        }else if($user->user_pwd!=$post['user_pwd']){
            echo json_encode(['code'=>0,'msg'=>'密码不正确']);die;
        }else{
            request()->session()->put('userindex',$user);
            request()->session()->save();
            echo json_encode(['code'=>1,'msg'=>'登录成功']);
        }
    }


    public function sendemail()
    {
        $email=request()->email;
        // $a=request()->session()->forget('code'); 
        // dd($a);
        
        $code=rand(1000,9999);
        // dd($code);
        request()->session()->put('code', $code);
        request()->session()->save();
        $info='欢迎注册电商前台用户';
        send($email,$info,$code);
        echo json_encode(['code'=>1,'msg'=>'注册成功，请前往邮箱查看验证码']);die;
    }

    public function regdo()
    {
        $post=request()->except('_token');
        // dd($post);
        $code=request()->session()->get('code');
        $count=DB::table('user')->where(['user_email'=>$post['user_email']])->count();
        // dd($count);
        if ($count) {
             echo json_encode(['msg'=>'该邮箱已被他人注册','code'=>0]);die;
        }
        // dd($code);
        if ($post['code']!=$code) {
            echo json_encode(['msg'=>'您填写的验证码与邮箱中不符请核对后再进行注册','code'=>0]);die;
        }
        if ($post['user_pwd']!=$post['user_repwd']) {
            echo json_encode(['msg'=>'密码与确认密码不一致','code'=>0]);die;
        }
        unset($post['code']);
        $res=DB::table('user')->insert($post);
        // dd($res);
        if ($res) {
            echo json_encode(['msg'=>'注册成功','code'=>1]);
        }
        // dd($post);
    }

    public function lists($id)
    {
        $cate=DB::table('cate')->get();
        // dd($cate);
        $cates=createTree($cate,$id);
        // dd($cates);
        $ids=array_column($cates,'cate_id');
        // dd($ids);
        $data=DB::table('goods')->whereIn('cate_id',$ids)->get();
        // dd($data);
        return view('index/lists',['data'=>$data]);
    }

    public function goods($id)
    {
        $data=DB::table('goods')->where(['goods_id'=>$id])->first();
        // dd($data);
        return view('index/goods',['data'=>$data]);
    }
}
