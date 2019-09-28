<?php

namespace App\Http\Controllers\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    public $redis;

    public function __construct()
    {
        $this->redis = new \Redis;
        $this->redis->connect('127.0.0.1','6379');
    }

    public function get_wechat_access_token()
    {
        $access_token_key = 'access_token_wechat';
        if ($this->redis->exists($access_token_key)) {
            return $this->redis->get($access_token_key);
        }else{
            $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx8918aabe1b28f58a&secret=972b14bfb6d98e92898eb57ec5e070c1');
            // dd($result);
            $res = json_decode($result,1);
            // dd($res);
            $this->redis->set($access_token_key,$res['access_token'],$res['expires_in']);
            return $res['access_token'];
        }
    }
}
