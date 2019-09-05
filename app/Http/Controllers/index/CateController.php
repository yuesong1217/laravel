<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CateController extends Controller
{
    public function lists($id)
    {
        $cate=DB::table('cate')->get();
        $cates=createTree($cate,$id);
        $ids=array_column($cates,'cate_id');
        $data=DB::table('goods')->whereIn('cate_id',$ids)->get();
        // dd($data);
        return view('index/lists',['data'=>$data]);
    }
}
