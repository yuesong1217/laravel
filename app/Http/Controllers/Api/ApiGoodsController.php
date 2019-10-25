<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\hadmin\Goods;
use App\hadmin\Login;
use App\hadmin\GoodsAttr;
use App\hadmin\Car;
use App\hadmin\Product;
use App\hadmin\Cate;
use App\hadmin\Attr;
use Illuminate\Support\Facades\Cache;

class ApiGoodsController extends Controller
{
    public function news()
    {
        // echo 1;die;
        // header("Access-Control-Allow-Origin:*");

        // header('Access-Control-Allow-Methods:POST');

        // header('Access-Control-Allow-Headers:x-requested-with, content-type');
        $data = Goods::limit(4)->orderby('goods_id','DESC')->get();
        foreach ($data as $k => $v) {
            $data[$k]['goods_img'] = "http://www.yuesong.com/".$v['goods_img'];
        }
        return json_encode($data);
    }

    public function cate()
    {
        $cate = Cate::get();
        // dd($cate);
        return json_encode($cate);
    }

    public function cate_show()
    {
        $cate_id = request()->cate_id;
        // dd($cate_id);
        $goods = Goods::where(['cate_id'=>$cate_id])->get();
        foreach ($goods as $k => $v) {
            $v['goods_img'] = 'http://www.yuesong.com/'.$v['goods_img'];
        }
        // dd($goods);
        return json_encode($goods);
    }

    public function getAttr()
    {
        $goods_id = request()->goods_id;
        $ip = $_SERVER['REMOTE_ADDR'];
        // dd($ip);
        $cache_name = 'pass_time_'.$ip.$goods_id;
        // $num = Cache::get($cache_name);
        $goodsdata = Goods::where(['goods_id'=>$goods_id])->first();
        $num = $goodsdata->visit_num;
        if (!$num) {
            $num = 0;
        }
        $num += 1;
        Cache::put($cache_name,$num);
        // dd($num);
        // dd($goods_id);
        Goods::where(['goods_id'=>$goods_id])->update(['visit_num'=>$num]);
        $goodsdata['goods_img'] = "http://www.yuesong.com/".$goodsdata['goods_img'];
        // dd($goodsdata);
        $goodsattrdata = GoodsAttr::join('hadmin_attr','hadmin_val.attr_id','=','hadmin_attr.attr_id')->where(['goods_id'=>$goods_id])->get()->toArray();
        $specdata = [];
        $argsdata = [];
        // djjhgfdsaghjlkllkkklkkkkkkklkkkkklkklkkklkklkkoiiiiid($goodsattrdata);
        foreach ($goodsattrdata as $k => $v) {
            if ($v['attr_cate'] == 2) {
                $status = $v['attr_name'];
                $specdata[$status][] = $v;
            }else{
                $argsdata[] = $v;
            }
            
        }
        // dd($data);
        return json_encode(['goodsdata'=>$goodsdata,'specdata'=>$specdata,'argsdata'=>$argsdata]);
    }

    public function login()
    {
        // 接收账号密码
        $name=\request()->input('login_name');
        // dd($name);
        $pwd=\request()->input('login_pwd');
        // dd($pwd);
        // 根据账号密码查询有没有这个账号
        $login_data=Login::where([
            'login_name'=>$name,
            'login_pwd'=>$pwd,
        ])->first();
        // dd($login_data);
        // 判断没有返回错误
        if(empty($login_data)){
            return json_encode(['code'=>0,'msg'=>'账号或者密码错误']);
        }else{
            // 有账号生成token
            $token=md5($login_data['login_id'].time());
            // 修改表中的token
            $up_login_data=Login::where(['login_id'=>$login_data['login_id']])->update([
                'login_token'=>$token,
                'login_time'=>time()+7200,
            ]);
        }
        // 返回登陆成功
        return json_encode(['code'=>1,'msg'=>'登陆成功','token'=>$token]);
    }

    public function token()
    {
        $token=\request()->input('token');
        if (empty($token)){
            return json_encode(['code'=>0,'msg'=>'请先登录'],JSON_UNESCAPED_UNICODE);
        }
        $userData=Login::where(['login_token'=>$token])->first();
        if(empty($userData)){
            return json_encode(['code'=>0,'msg'=>'请先登录'],JSON_UNESCAPED_UNICODE);
        }
        if ($userData['login_time'] < time()){
            return json_encode(['code'=>0,'msg'=>'登陆过期'],JSON_UNESCAPED_UNICODE);
        }else{
            Login::where(['login_token'=>$userData['login_token']])->update([
                'login_time'=>time()+7200,
            ]);
        }
    }

    public function caradd()
    {
        $userData = request()->get('userData');
        $goods_id = request()->goods_id;
        $val_id = implode(',', request()->val_list);
        $login_id = $userData->login_id;
        // dd($login_id);
        $buy_number = 1;
        $productdata = Product::where(['goods_id'=>$goods_id,'attr_list'=>$val_id])->first();
        // dd($productdata);
        if ($buy_number > $productdata['product_num']) {
            $is_have_num = 0;
        }else{
            $is_have_num = 1;
        }
        $cardata = Car::where(['goods_id'=>$goods_id,'login_id'=>$login_id,'goods_attr_list'=>$val_id])->first();
        if ($cardata) {
            $cardata->buy_number = $cardata['buy_number']+$buy_number;
            $result = $cardata->save();
            if ($cardata->buy_number > $productdata['product_num']) {
                $is_have_num = 0;
            }else{
                $is_have_num = 1;
            }
        }else{
            $result = Car::create([
                    'goods_id'=>$goods_id,
                    'login_id'=>$login_id,
                    'product_id'=>$productdata['product_id'],
                    'buy_number'=>$buy_number,
                    'is_have_num'=>$is_have_num,
                    'goods_attr_list'=>$val_id,
                ]);
        }
        if ($result) {
            return json_encode(['msg'=>'添加成功','code'=>1]);
        }
        
        
    }

    public function car_list()
    {
        $userData = request()->get('userData');
        $login_id = $userData->login_id;
        $cardata = Car::join('hadmin_goods','hadmin_goods.goods_id','=','hadmin_car.goods_id')->get()->toArray();
        // $goods_attr_list = [];
        foreach ($cardata as $k => $v) {
            $goodsattrdata = GoodsAttr::join('hadmin_attr','hadmin_attr.attr_id','=','hadmin_val.attr_id')->whereIn('val_id',explode(',',$v['goods_attr_list']))->get()->toArray();
            $attr_list = "";
            foreach ($goodsattrdata as $key => $value) {
                $attr_list .= $value['attr_name'].":".$value['attr_val'].",";
                $cardata[$k]['goods_price'] += $value['attr_price'];
            }
            $cardata[$k]['attr_list'] = rtrim($attr_list,',');
            $cardata[$k]['goods_img'] = "http://www.yuesong.com/".$v['goods_img'];
        }
        // dd($cardata);
        
        
        
        // dd($cardata);
        return json_encode($cardata);
    }
}
