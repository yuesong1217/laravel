<?php

namespace App\Http\Controllers\likeyou;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\tools;
use Illuminate\Support\Facades\Storage;
use DB;

class WechatController extends Controller
{
    public $tools;

    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }
    public function getUserList($id)
    {
        $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->tools->get_wechat_access_token().'&next_openid=');
        // dd($result);
        $res = json_decode($result,1);
        // dd($res);
        $last_info = [];
        $users = [];
        foreach ($res['data']['openid'] as $k => $v) {
            $user_info = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->tools->get_wechat_access_token().'&openid='.$v.'&lang=zh_CN');
            // dd($user_info);
            $user = json_decode($user_info,1);
            // dd($user);
            $last_info[$k]['openid'] = $v;
            $last_info[$k]['nickname'] = $user['nickname'];
            $users[]=$user;
        }
        
        // dd($users);
        // dd($user);
        return view('likeyou/get_user_list',['user'=>$users,'id'=>$id]);
    }

    public function createTag()
    {
        // $result = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token=ACCESS_TOKEN'.$this->tools->get_wechat_access_token();
        // dd($result);
        return view('likeyou/createTag');
    }

    public function create_do()
    {
        $tag = [];
        $data = request()->all();
        $tag['tag'] = $data;
        // dd($tag);
        $tag = json_encode($tag,JSON_UNESCAPED_UNICODE);
        // dd($tag);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.$this->tools->get_wechat_access_token();
        $result = $this->tools->curl_post($url,$tag);
        // dd($result);
        $res = json_decode($result,1);
        dd($res);
    }

    public function getTagList()
    {
        // dd($id);
        $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->tools->get_wechat_access_token());
        // dd($result);
        $res = json_decode($result,1);
        // dd($res);
        return view('likeyou/get_tag_list',['tag'=>$res['tags']]);
    }

    public function createfans($id)
    {
        $req = request()->all();
        // dd($id);
        // dd($req);
        $data['openid_list'] = $req;
        $data['tagid'] = $id;
        // dd($data);
        $data = json_encode($data);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token='.$this->tools->get_wechat_access_token();
        $result = $this->tools->curl_post($url,$data);
        dd($result);
        // dd($data);
    }

    public function sendmsg($id)
    {
        return view('likeyou/sendmsg',['id'=>$id]);
    }

    public function sendmsg_do($id)
    {
        // dd($id);
        $data = [];
        $filter = [
            'is_to_all' => false,
            'tag_id' => $id
        ];
        // dd($filter);
        $data['filter'] = $filter;
        $data['text'] = request()->all();
        $data['msgtype'] = 'text';
        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
        // dd($data);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$this->tools->get_wechat_access_token();
        $result = $this->tools->curl_post($url,$data);
        dd($result);
    }

    public function create_qrcode()
    {
        $data = [];
        $data['expire_seconds'] = 604800;
        $data['action_name'] = 'QR_SCENE';
        $action_info = [];
        $scene = [];
        $scene['scene_id'] = 123;
        $action_info['scene'] = $scene;
        // dd($action_info);
        $data['action_info'] = $action_info;
        // dd($data);
        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
        // dd($data);
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->tools->get_wechat_access_token();
        // dd($url);
        $result = $this->tools->curl_post($url,$data);
        // dd($result);
        $res = json_decode($result,1);
        // dd($res);
        $path = '/wechat/qrcode/'.time().rand(1000,9999).'.jpg';
        $qrcode_info = file_get_contents('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($res['ticket']).'');
        // dd($re);
        Storage::put($path, $qrcode_info);
    }

    public function create_menu()
    {
        return view('likeyou/create_menu');
    }

    public function menu_do()
    {
        $req = request()->all();
        $button_type = !empty($req['name2'])?2:1;
        $result = DB::table('menu')->insert([
            'name1'=>$req['name1'],
            'name2'=>$req['name2'],
            'type'=>$req['type'],
            'button_type'=>$button_type,
            'event_value'=>$req['event_value']
        ]);
        if(!$result){
            dd('插入失败');
        }
        //根据表数据翻译成菜单结构
        $this->load_menu();
    }

    public function load_menu()
    {
        $data = [];
        $menu_list = DB::table('menu')->select(['name1'])->groupBy('name1')->get();
        foreach($menu_list as $vv){
            $menu_info = DB::table('menu')->where(['name1'=>$vv->name1])->get();
            $menu = [];
            foreach ($menu_info as $v){
                $menu[] = (array)$v;
            }
            $arr = [];
            foreach($menu as $v){
                if($v['button_type'] == 1){ //普通一级菜单
                    if($v['type'] == 1){ //click
                        $arr = [
                            'type'=>'click',
                            'name'=>$v['name1'],
                            'key'=>$v['event_value']
                        ];
                    }elseif($v['type'] == 2){//view
                        $arr = [
                            'type'=>'view',
                            'name'=>$v['name1'],
                            'url'=>$v['event_value']
                        ];
                    }
                }elseif($v['button_type'] == 2){ //带有二级菜单的一级菜单
                    $arr['name'] = $v['name1'];
                    if($v['type'] == 1){ //click
                        $button_arr = [
                            'type'=>'click',
                            'name'=>$v['name2'],
                            'key'=>$v['event_value']
                        ];
                    }elseif($v['type'] == 2){//view
                        $button_arr = [
                            'type'=>'view',
                            'name'=>$v['name2'],
                            'url'=>$v['event_value']
                        ];
                    }
                    $arr['sub_button'][] = $button_arr;
                }
            }
            $data['button'][] = $arr;
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->tools->get_wechat_access_token();
        $re = $this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $result = json_decode($re,1);
        dd($result);
    }

    public function menu_list()
    {
        $info = DB::table('menu')->orderBy('name1','asc','name2','asc')->get();
        return view('likeyou/menu_list',['info'=>$info]);
    }

    public function delete_menu($id)
    {
        // $id = $request->all()['id'];
        $del_result = DB::table('menu')->where(['id'=>$id])->delete();
        if(!$del_result){
            dd('删除失败');
        }
        //根据表数据翻译成菜单结构
        $this->load_menu();
    }

    public function login()
    {
        // echo 111;die;
        return view('likeyou/login');
    }

    public function wechat_login()
    {
        // echo 111;die;
        $redirect_url = 'http://www.yuesong.com/likeyou/code';
        // dd($redirect_url);
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_url).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        // dd($url);
        header('Location:'.$url);
    }

    public function code()
    {
        $req = request()->all();
        // dd($req);
        $result = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$req['code'].'&grant_type=authorization_code');
        // dd($result);
        $res = json_decode($result,1);
        // dd($res);
        $user_info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$res['access_token'].'&openid='.$res['openid'].'&lang=zh_CN');
        $wechat_user_info = json_decode($user_info,1);
        dd($wechat_user_info);

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
        //获取用户的基本信息
        $user_info = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->tools->get_wechat_access_token().'&openid='.$xml_arr['FromUserName'].'&lang=zh_CN');
            // dd($user_info);
            $user = json_decode($user_info,1);
        if($xml_arr['MsgType']=="event"){
            if($xml_arr['Event']=="subscribe"){
                 $message = '欢迎'.$user['nickname'].'同学，感谢您的关注';
            $xml_str = '<xml><ToUserName><![CDATA['.$xml_arr['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml_arr['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
            echo $xml_str;
            }
        }
    }
}
