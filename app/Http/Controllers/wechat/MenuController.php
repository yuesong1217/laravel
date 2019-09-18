<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Tools\tools;
class MenuController extends Controller
{
    // public $tools;

    // public function __construct(Tools $tools)
    // {
    //     $this->tools = $tools;
    // }

    public function create_menu()
    {
        $data = [
            'button'=>[
                [
                    'type'=>'click',
                    'name'=>'',
                    'key' =>'V1001_TODAY_MUSIC'
                ],
                [
                    'name'=>'菜单',
                    'sub_button'=>[
                        [
                            'type'=>'view',
                            'name'=>'搜索',
                            'url' =>'http://www.soso.com/'
                        ]
                    ]
                ]
            ]
        ];
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        // dd($data);
        // dd($this->get_wechat_access_token());
        $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->tools->get_wechat_access_token();
        $result=$this->tools->curl_post($url,$data);
        $res=json_decode($result,1);
        dd($res);
    }

    public function event()
    {
        $xml_string = file_get_contents('php://input');  //获取
        $wechat_log_psth = storage_path('logs/wechat/'.date('Y-m-d').'.log');
        file_put_contents($wechat_log_psth,"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
        file_put_contents($wechat_log_psth,$xml_string,FILE_APPEND);
        file_put_contents($wechat_log_psth,"\n<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n\n",FILE_APPEND);
        //dd($xml_string);
        $xml_obj = simplexml_load_string($xml_string,'SimpleXMLElement',LIBXML_NOCDATA);
        $xml_arr = (array)$xml_obj;
        \Log::Info(json_encode($xml_arr,JSON_UNESCAPED_UNICODE));
    }

}
