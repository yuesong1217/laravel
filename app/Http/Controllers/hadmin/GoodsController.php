<?php

namespace App\Http\Controllers\hadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\hadmin\Goods;
use App\hadmin\Cate;
use App\hadmin\Type;
use App\hadmin\Attr;
use App\hadmin\GoodsAttr;
class GoodsController extends Controller
{
    public function add()
    {
        $cate = Cate::get();
        $cate = createTree($cate);
        $type = Type::get();
        return view('hadmin.goods.add',['cate'=>$cate,'type'=>$type]);
    }

    public function list()
    {
        // dd(time());
        $goods_name = request()->goods_name;
        $cate_id = request()->cate_id;
        $where = [];
        $cate = Cate::get();
        $cate = createTree($cate);
        // dd($cate);
        if ($goods_name) {
            $where[] = ['goods_name','like',"%$goods_name%"];
        }
        if ($cate_id) {
            $where[] = ['hadmin_cate.cate_id','=',$cate_id];
        }
        $data = Goods::join('hadmin_cate','hadmin_cate.cate_id','=','hadmin_goods.cate_id')->where($where)->get();
        // dd($data);
        // dd($data);
        return view('hadmin.goods.list',['data'=>$data,'cate'=>$cate]);
    }

    public function getattr()
    {
        $type_id = request()->type_id;
        $data = Attr::where(['type_id'=>$type_id])->get();
        // dd($attr);?
        return json_encode($data);
    }

    public function add_do()
    {
        $postdata = request()->all();
        $postdata['sku_num'] = rand(1000,9999).time();
        // dd($postdata);
        $time = date('Y-n-j');
        if (request()->hasFile("goods_img")) {
            // echo 1;die;
            $postdata['goods_img'] = request()->goods_img->store('img/'.$time);
        }
        $postdata['goods_img'] = '/'.$postdata['goods_img'];
        $goodsModel = Goods::create([
                'goods_name'=>$postdata['goods_name'],
                'cate_id'=>$postdata['cate_id'],
                'goods_price'=>$postdata['goods_price'],
                'sku_num'=>$postdata['sku_num'],
                // 'goods_name'=>$postdata['goods_name'],
                'goods_img'=>$postdata['goods_img']
            ]);
        // var_dump($goodsModel);die;
        $goods_id = $goodsModel->goods_id;
        // dd($goods_id);
        $goodsAttrdata = [];
        foreach ($postdata['attr_value_list'] as $k => $v) {
            $goodsAttrdata[]=[
                'goods_id'=>$goods_id,
                'attr_id'=>$postdata['attr_id_list'][$k],
                'attr_val'=>$v,
                'attr_price'=>$postdata['attr_price_list'][$k],
            ];
        }
        // dd($goodsAttrdata);
        $goodsAttrModel=GoodsAttr::insert($goodsAttrdata);
        // dd($goodsAttrModel);
        if ($goodsModel && $goodsAttrModel) {
            return redirect('hadmin/goods/list');
        }
        
    }

    public function update()
    {
        $postdata = request()->all();
        // dd($postdata);
        $res = Goods::where(['goods_id'=>$postdata['goods_id']])->update(['goods_name'=>$postdata['goods_name']]);
        // dd($res);
        if ($res) {
            return json_encode(['msg'=>'修改成功','code'=>1]);
        }
    }


}
