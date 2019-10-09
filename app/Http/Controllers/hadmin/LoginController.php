<?php

namespace App\Http\Controllers\hadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Tools\tools;

class LoginController extends Controller
{
    public $tools;

    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }

    public function login()
    {
        // echo 123;die;
        return view('hadmin.login');
    }

    public function login_do()
    {
        $post = request()->all();
        // dd($post);
        $user = DB::table('hadmin_user')->where(['username'=>$post['username']])->first();
        $code = request()->session()->get('hadmin_code');
        if ($post['code']!=$code) {
            echo "验证码错误";die;
        }
        if (!$user) {
            echo "账号不存在";die;
        }else if($user->pwd!=$post['pwd']){
            echo "密码错误";die;
        }else{
            echo "登录成功";
        }
    }
    
    public function getCode(Request $request)
    {
        $username = $request->username;
        // dd($username);
        $user = DB::table('hadmin_user')->where(['username'=>$username])->first();
        // dd($user);
        $openid = $user->openid;
        $code = rand(1000,9999);
        request()->session()->put('hadmin_code',$code);
        // dd($openid);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->tools->get_wechat_access_token();
        // dd($url);
        $data = [
           "touser"=>$openid,
           "template_id"=>"e8gEi_uc90EAnXHeKo8RDpFkLiuHqfPY0H6oG257ImM",          
           "data"=>[
                   "first"=> [
                       "value"=>"发送成功！",
                   ],
                   "keyword1"=>[
                       "value"=>$code,
                   ],
                   "keyword2"=>[
                       "value"=>date('Y-m-d H:i:s',time()),
                   ],
           ]
       ];

       // dd($data);
       $data = json_encode($data,JSON_UNESCAPED_UNICODE);
       $result=$this->tools->curl_post($url,$data);
       // dd(request()->session()->get('hadmin_code'));
       // dd($result);
       $res = json_decode($result,1);
       if ($res) {
           echo json_encode(['msg'=>'获取成功！','code'=>1]);
       }

    }

    public function qrcode()
    {
        $id = time().rand(1000,9999);
        $redirect_url="http://39.106.89.199/hadmin/code?id=".$id;
        return view('hadmin.qrcode',['redirect_url'=>$redirect_url,'id'=>$id]);
    }

    public function wechat_login()
    {
        $redirect_url = "http://www.yuesong.com/hadmin/code";
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_url).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        header('Location:'.$url);
    }

    public function code(Request $request)
    {
        $req = $request->all();
        $result = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$req['code'].'&grant_type=authorization_code');
        $re = json_decode($result,1);
        // dd($re);
        $user_info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$re['access_token'].'&openid='.$re['openid'].'&lang=zh_CN');
        $wechat_user_info = json_decode($user_info,1);
        // dd($wechat_user_info);
        dd($wechat_user_info['openid']);
    }


}
