<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cache;
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
        $name = request()->input('name');
        $age = request()->input('age');
        $sign = request()->input('sign');
        if (empty($name) || empty($age)) {
            return json_encode(['code'=>0,'msg'=>'参数不能为空']);
        }
        if (empty($sign)) {
            return json_encode(['code'=>0,'msg'=>'签名不能为空']);
        }
        $mysign = md5("1902",$name.$age);
        if (!$mysign != $sign) {
            return json_encode(['code'=>1,'msg'=>'签名不对']);
        }

        $res = DB::table('today')->insert(['name'=>$name,'age'=>$age,'ip'=>$_SERVER['REMOTE_ADDR']]);
    }
}
