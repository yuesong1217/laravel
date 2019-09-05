<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class CateController extends Controller
{
    public function create()
    {
        $cate=DB::table('cate')->get();
        $data=createTree($cate);
        return view('admin/cate/create',['data'=>$data]);
    }

    public function save()
    {
        $post=request()->except('_token');
        $validator = Validator::make($post, [
            'cate_name' => 'required|unique:cate|max:50',
        ],[
            'cate_name.required'=>'分类名称不能为空',
             'cate_name.unique'=>'分类名称已存在',
        ]);
            if ($validator->fails()) {
            return redirect('admin/cate/create')
            ->withErrors($validator)
           ->withInput();
            }
        $res=DB::table('cate')->insert($post);
        if ($res) {
            return redirect('admin/cate/index');
        }
        // dd($res);
        // dd($post);
    }

    public function index()
    {
        $cate=DB::table('cate')->get();
        $data=createTree($cate);
        return view('admin/cate/index',['data'=>$data]);
    }
}
