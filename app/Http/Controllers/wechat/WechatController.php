<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;


class WechatController extends Controller
{
        public function get_user_list()
    {
        $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->get_wechat_access_token().'&next_openid=');
        $re = json_decode($result,1);
        // dd($re);
        $last_info = [];
        foreach($re['data']['openid'] as $k=>$v){
            $user_info = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->get_wechat_access_token().'&openid='.$v.'&lang=zh_CN');
            $user = json_decode($user_info,1);
            $last_info[$k]['nickname'] = $user['nickname'];
            $last_info[$k]['openid'] = $v;
        }
        // dd($last_info);
        //dd($re['data']['openid']);
        return view('Wechat.userList',['info'=>$last_info]);
    }
    /**
     * 获取access_token
     */
    public function get_access_token()
    {
        return $this->get_wechat_access_token();
    }
    public function get_wechat_access_token()
    {
        // $redis = new \Redis();
        // $redis->connect('127.0.0.1','6379');
        // //加入缓存
        // $access_token_key = 'wechat_access_token';
        // if($redis->exists($access_token_key)){
        //     //存在
        //     return $redis->get($access_token_key);
        // }else{
        //     //不存在
        //     $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET'));
        //     $re = json_decode($result,1);
        //     // dd($re);
        //     $redis->set($access_token_key,$re['access_token'],$re['expires_in']);  //加入缓存
        //     return $re['access_token'];
        // }
        if(Redis::exists('wechat_access_token')){
            //存在
            return Redis::get('wechat_access_token');
        }else{
            //不存在
            $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxc82a04ef31eb2584&secret=666a5b097d1054dab68f81d3a48c978b');
            $res = json_decode($result,1);
            $token=$res['access_token'];
            Redis::set('wechat_access_token',$token,7200);  //加入缓存
            return $res['access_token'];
        }
    }

    public function get_user_info()
    {
        $user_info = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->get_wechat_access_token().'&openid='.$v.'&lang=zh_CN");
            $user = json_decode($user_info,1);
        return view('wechat/get_user_info',['user'=>$user]);
    }

    public function login()
    {
        return view('wechat/login');
    }

    public function wechat_login()
    {
        // echo 111;
        $redirect_url = "http://www.yuesong.com/wechat/code";
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
        dd($wechat_user_info);
    }

    public function curl_upload($url,$path)
    {
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POST,true);  //发送post
        $form_data = [
            'meida' => new \CURLFile($path)
        ];
        curl_setopt($curl,CURLOPT_POSTFIELDS,$form_data);
        $data = curl_exec($curl);
        //$errno = curl_errno($curl);  //错误码
        //$err_msg = curl_error($curl); //错误信息
        curl_close($curl);
        return $data;
    }

    public function upload()
    {
        return view('wechat/upload');
    }

    public function guzzle_upload($url,$path,$client)
    {
        $client->request('POST',$url,[
                'multipart' => [
                    [
            'name'     => 'media',
            'contents' => fopen($path, 'r')
        ],
            ]
        
        ]);
        return $client->getBody();
    }

    public function upload_do(Request $request,Client $client)
    {
        // $client = new \Client();
        $name = 'file_name';
        $type=request()->type;
        if(!empty($request->hasFile($name)) && request()->file($name)->isValid()){
            // echo 111;die;
            //$size = $request->file($name)->getClientSize() / 1024 / 1024;
            $ext = $request->file($name)->getClientOriginalExtension();  //文件类型
            $file_name = time().rand(1000,9999).'.'.$ext;
            $path = request()->file($name)->storeAs('wechat/'.$type,$file_name);
            //dd($path);
            $path = realpath('./storage/'.$path);
             // dd($path);
            $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$this->get_wechat_access_token().'&type='.$type;
            $result = $this->guzzle_upload($url,$path,$client);
            dd($result);
        }
    }
}
