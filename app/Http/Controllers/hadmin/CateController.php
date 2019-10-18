<?php

namespace App\Http\Controllers\hadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\hadmin\Cate;
class CateController extends Controller
{
    public function add()
    {
        $cates = Cate::get();
        $cates = createTree($cates);
        // dd($cates);
        return view('hadmin.cate.add',['cates'=>$cates]);
    }

    public function add_do()
    {
        $post = request()->post();
        $res = Cate::create($post);
        if ($res) {
            return redirect('hadmin/cate/list');
        }
    }

    public function list()
    {
        $cate = Cate::get();
        $cate = createTree($cate);
        return view('hadmin.cate.list',['cate'=>$cate]);
    }

    public function checkname()
    {
        $cate_name = request()->cate_name;
        // dd($cate_name);
        $count = Cate::where(['cate_name'=>$cate_name])->count();
        // dd($count);
        if ($count) {
            echo json_encode(['msg'=>'该名称已存在','code'=>1]);die;
        }
    }

    public function delete($id)
    {
        // dd($id);
        $res = Cate::destroy($id);
        // dd($res);
        if ($res) {
            return redirect('hadmin/cate/list');
        }
    }

    public function edit($id)
    {
        $data = Cate::find($id);
        // dd($data['cate_id']);
        $cates = Cate::get();
        $cates = createTree($cates);
        return view('hadmin.cate.edit',['cates'=>$cates,'data'=>$data]);
    }

    public function update($id)
    {
        $post = request()->post();
        $res = Cate::where(['cate_id'=>$id])->update($post);
        if ($res) {
            return redirect('hadmin/cate/list');
        }
    }
}
