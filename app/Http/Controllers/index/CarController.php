<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CarController extends Controller
{
    public function create()
    {
        $post=request()->except('_token');
        // dd($post);
        $session=request()->session()->get('userindex');
        // dd($session->user_id);
        if (!$session) {
            echo json_encode(['msg'=>'请登录后再进行操作','code'=>0]);die;
        }else{
            $goods=DB::table('goods')->where(['goods_id'=>$post['goods_id']])->first();
            if ($goods->goods_num<$post['buy_number']) {
                echo json_encode(['msg'=>'库存不足','code'=>2]);die;
            }
            $where=[
                'user_id'=>$session->user_id,
                'goods_id'=>$post['goods_id']
            ];
            $data=DB::table('car')->where($where)->first();
            // dd($data);
            if ($data) {
                $data->buy_number=$data->buy_number+$post['buy_number'];
                if ($goods->goods_num<$data['buy_number']) {
                echo json_encode(['msg'=>'库存不足','code'=>2]);die;
                }
                $res=DB::table('car')->where($where)->update($data);
            }else{
                $array=[
                    'goods_name'=>$goods->goods_name,
                    'goods_id'=>$post['goods_id'],
                    'goods_sprice'=>$goods->goods_sprice,
                    'buy_number'=>$post['buy_number'],
                    'goods_img'=>$goods->goods_img,
                    'user_id'=>$session->user_id,
                ];
                $res=DB::table('car')->insert($array);
            }
            if ($res) {
                echo json_encode(['msg'=>'添加成功','code'=>1]);
            }
            
        }
    }

    public function index()
    {
        $car=DB::table('car')->get()->toArray();
        $count=DB::table('car')->count();
        // dd($count);
        return view('index/car',['car'=>$car,'count'=>$count]);
    }
}
