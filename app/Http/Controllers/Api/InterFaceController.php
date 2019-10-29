<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cache;
use App\Tools\Aes;
use App\Tools\Rsa;
class InterFaceController extends Controller
{
    public function weather()
    {
        $city = request()->input('city');
        if (empty($city)) {
            $city = "北京";
        }
        // dd($city);
        $cache_key = "weather_data".$city;
        $url = "http://api.k780.com/?app=weather.today&weaid=".$city."&appkey=45882&sign=667edba6d6067924c8d737658b6314bf&format=json";
        $weather = file_get_contents($url);
        $time = date("Y-m-d");
        $time0 = strtotime($time)+86400;
        $cache_time = $time0  - time();
        if (!$weather) {
            $weather = Cache::get($cache_key);
        }
        $weather = json_decode($weather,1);
        Cache::put($cache_key,$weather,$cache_time);
        return json_encode(['weather'=>$weather]);
    }

    public function add()
    {
        $name = request()->name;
        $age = request()->age;
        if (empty($name)  ||   empty($age)) {
            return json_encode(['msg'=>'参数不能为空','code'=>0]);
        }
        $res = DB::table('test')->insert([
                'name'=>$name,
                'age' =>$age
        ]);
        if ($res) {
            return json_encode(['msg'=>'添加成功','code'=>1]);
        }else{
            return json_encode(['msg'=>'添加失败','code'=>0]);
        }
    }

    public function show()
    {
        $data = DB::table('test')->get();
        return json_encode(['data'=>$data]);
    }

    public function find()
    {
        $id = request('id');
        // dd($id);
        $data = DB::table('test')->where(['id'=>$id])->first();
        array($data);
        return json_encode(['data'=>$data]);
    }

    public function update()
    {
         $name = request()->name;
        $age = request()->age;
        $id = request()->id;
        $res = DB::table('test')->where(['id'=>$id])->update([
                'name'=>$name,
                'age' =>$age
        ]);
        if ($res) {
            return json_encode(['msg'=>'修改成功','code'=>1]);
        }else{
            return json_encode(['msg'=>'修改失败','code'=>0]);
        }
    }

    public function delete()
    {
        $id = request()->id;
        $res = DB::table('test')->where(['id'=>$id])->delete();
        if ($res) {
            return json_encode(['msg'=>'删除成功','code'=>1]);
        }else{
            return json_encode(['msg'=>'删除失败','code'=>0]);
        }
    }

    public function info()
    {
        echo phpinfo();
    }

    public function today()
    {
       $url = 'http://wym.yingge.fun/api/user/test';
       $rand = rand(1000,9999);
       $name = '岳松';
       $age = '19';
       $mobile = '17805271790';
       // $time = time();
       $sign = sha1('1902age='.$age.'&mobile='.$mobile.'&name='.$name.'&rand='.$rand.'');
       // dd($sign);
       $url .= '?name='.$name.'&age='.$age.'&mobile='.$mobile.'&rand='.$rand.'&sign='.$sign;
       // dd($url);
       $data = file_get_contents($url);
       var_dump($data);die;
    }

    public function aes()
    {
        $obj = new Aes('123456');
        $name = '岳松';
        $res = $obj->encrypt($name);
        dump($res);
        $result = $obj->decrypt($res);
        dd($result);
    }

    public function rsa()
    {
        $Rsa = new Rsa();
        // $keys = $Rsa->new_rsa_key(); //生成完key之后应该记录下key值，这里省略
        // p($keys);die;
        $privkey = file_get_contents("cert_private.pem");//$keys['privkey'];
        $pubkey  = file_get_contents("cert_public.pem");//$keys['pubkey'];
        //echo $privkey;die;
        //初始化rsaobject
        $Rsa->init($privkey, $pubkey,TRUE);
         
        //原文
        $data = '学习PHP太开心了';
         
        //私钥加密示例
        $encode = $Rsa->priv_encode($data);
        dump($encode);
        $ret = $Rsa->pub_decode($encode);
        dump($ret);
         
        //公钥加密示例
        $encode = $Rsa->pub_encode($data);
         
        dump($encode);
        $ret = $Rsa->priv_decode($encode);
        dump($ret);
    }

    public function exam()
    {
        $url = "https://www.avatardata.cn/Docs/Api/bb84699c-80a3-427e-b710-9b5e36646c13";
        $data = file_get_contents($url);
        dd($data);
    }
}
