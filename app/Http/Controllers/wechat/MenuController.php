<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Tools\tools;
use DB;
class MenuController extends Controller
{
    public $tools;

    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }

    // public function create()
    // {
    //     return view('menu/create');
    // }

    // public function create_do()
    // {
    //     $req = request()->except('_token');
    //     dd($req);
    // }

    public function create_menu()
    {
        $data = [
            'button'=>[
                [
                    'type'=>'click',
                    'name'=>'今日歌曲',
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
        dd($data);
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        // dd($data);
        // dd($this->get_wechat_access_token());
        $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->tools->get_wechat_access_token();
        $result=$this->tools->curl_post($url,$data);
        $res=json_decode($result,1);
        dd($res);
    }
    // 
    public function menu_list()
    {
         $info = DB::table('menu')->orderBy('name1','asc','name2','asc')->get();
        return view('agent/menuList',['info'=>$info]);
        // return view('agent/menuList');
    }

     public function del_menu(Request $request)
    {
        $id = $request->all()['id'];
        $del_result = DB::table('menu')->where(['id'=>$id])->delete();
        if(!$del_result){
            dd('删除失败');
        }
        //根据表数据翻译成菜单结构
        $this->load_menu();
    }

 //    public function create_menu(Request $request)
 //    {
        
 // //     $data = [
 // //          'button'=> [
 //    //           [  
 //    //                'type'=>'click',
 //    //                'name'=>'今日歌曲',
 //    //                'key'=>'V1001_TODAY_MUSIC'
 //    //            ],
 //    //            [
 //    //                 "name"=>"菜单",
 //    //                 "sub_button"=>[
 //    //                 [    
 //    //                     "type"=>"view",
 //    //                     "name"=>"搜索",
 //    //                     "url"=>"http://www.soso.com/"
 //    //                  ],
 //    //                  [
 //    //                       "type"=>"miniprogram",
 //    //                       "name"=>"wxa",
 //    //                       "url"=>"http://mp.weixin.qq.com",
 //    //                       "appid"=>"wx286b93c14bbf93aa",
 //    //                       "pagepath"=>"pages/lunar/index"
 //    //                   ],
 //    //                  [
 //    //                     "type"=>"click",
 //    //                     "name"=>"赞一下我们",
 //    //                     "key"=>"V1001_GOOD"
 //    //               ]
 //    //          ]
 // //         ]
 // //     ]
 //    // ]
 //    // $button_type = !empty();
 //    // $re = $this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
 //    // dd($re);
 //    // $result = json_decode($re,1);




 //        $req = $request->all();
 //        // dd($req);
 //        $button_type = !empty($reg['name2'])?2:1;
 //        $result = DB::table('menu')->insert([
 //            'name1'=>$req['name1'],
 //            'name2'=>$req['name2'],
 //            'type'=>$req['type'],
 //            'button_type'=>$button_type,
 //            'event_value'=>$req['event_value']
 //        ]);
 //         if (!$request) {
 //            dd('插入失败');
 //         }
 //             //根据表数据翻译成菜单结构
 //        $this->load_menu();
 //    }


    public function load_menu()
    {
        $data = [];
        $event_arr = [1=>'click',2=>'view'];
        $menu_info = DB::table('menu')->get()->toArray();
        $menu = [];
        foreach ($menu_info as $v) {
            $menu[] = (array)$v;
        }
        // dd($menu);


        foreach ($menu as $v) {
            if ($v['button_type'] ==1) {
                $arr = [];
                if ($v['type'] ==1) {//click
                    $arr =[
                        'type'=>'view',
                        'name'=>$v['name1'],
                        'url'=>$v['event_value']
                    ];
                    // dd($arr);
                }elseif ($v['type']==2) {//view
                    $arr =[
                        'type'=>'view',
                        'name'=>$v['name2'],
                        'url'=>$v['event_value']
                    ];  
                }
                $data['button'][] = $arr;
            }
        }
        // dd($data);
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        // dd($data);
    //     // dd($this->get_wechat_access_token());
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
