<?php

namespace App\Http\Controllers\hadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\hadmin\Product;
use App\hadmin\Goods;
use App\hadmin\GoodsAttr;

class ProductController extends Controller
{
    public function add()
    {
        $goods_id = request()->goods_id;
        // dd($goods_id);sss
        $goodsdata = Goods::where(['goods_id'=>$goods_id])->first();
        // dd($goodsdata);
        $goodsattr = GoodsAttr::join('hadmin_attr','hadmin_val.attr_id','=','hadmin_attr.attr_id')->where(['goods_id'=>$goods_id,'attr_cate'=>2])->get()->toArray();
        // dd($goodsattr);
        $color = [];
        // $attr_val = [];
        // $neicun = [];
        foreach ($goodsattr as $k => $v) {
            $attr_name=$v['attr_name'];
            // $attr_val[$k][3]=$v['attr_val'];
            // $attr_val['attr_name'][$k]=$v['attr_val'];
            $color[$attr_name][]=$v;
        }
        // dd($color);
        return view('hadmin.product.add',['color'=>$color,'goodsdata'=>$goodsdata]);
    }

    public function add_do()
    {
        $postdata = request()->all();
        $size = count($postdata['attr_list']) / count($postdata['product_num']);
        $goodsattr = array_chunk($postdata['attr_list'], $size);
        // dd($goodsattr);
        // dd($postdata);
        foreach ($goodsattr as $k => $v) {
            $res = Product::create([
                'goods_id'=>$postdata['goods_id'],
                'attr_list'=>implode(',', $v),
                'product_num'=>$postdata['product_num'][$k],
            ]);
        }
        if ($res) {
            return redirect('hadmin/goods/list');
        }
    }
}
