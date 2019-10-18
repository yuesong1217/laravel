<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\Goods;
use DB;
use Storage;
use Cache;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($data);
        // $
        $name = request('search_name');
        if (isset($name)) {
            $where[]=["goods_name","like","%$name%"];
        }
        $data = Goods::paginate(3);
        return json_encode(['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo 1;die;
        $post = $request->all();
        // $path="";
        //dd($_FILES);
        $time = date('Y-n-j');
        if (request()->hasFile("goods_img")) {
            // echo 1;die;
            $post['goods_img'] = $request->goods_img->store('img/'.$time);
        }
        $post['goods_img'] = '/'.$post['goods_img'];

        // dd($post);
        $res = Goods::create($post);
        if ($res) {
            return json_encode(['msg'=>'添加成功','code'=>1]);
        }else{
            return json_encode(['msg'=>'添加失败','code'=>0]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
