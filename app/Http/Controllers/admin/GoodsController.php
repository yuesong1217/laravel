<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    public function add()
    {
        $cate=DB::table('cate')->get();
        $cates=createTree($cate);
        $brand=DB::table('brand')->get();
        return view('/admin/goods/add',['cate'=>$cates,'brand'=>$brand]);
    }

    public function add_do()
    {
        $post=request()->except('_token');
        if (request()->hasFile('goods_img')) {
            $post['goods_img']=upload('goods_img');
        }
        $res=DB::table('goods')->insert($post);
        // dd($post);
        // dd($res);
        if ($res) {
            return redirect('/admin/goods/list');
        }
    }

    public function list()
    {
        $goods_name=request()->input('goods_name')??'';
        $data=DB::table('goods')->join('cate', 'cate.cate_id', '=', 'goods.cate_id')->join('brand', 'brand.brand_id', '=', 'goods.brand_id')->where('goods_name','like','%'.$goods_name.'%')->paginate(4);

        return view('/admin/goods/list',['data'=>$data,'goods_name'=>$goods_name]);
    }
}
