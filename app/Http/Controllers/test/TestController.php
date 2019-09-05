<?php

namespace App\Http\Controllers\test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TestController extends Controller
{
    public function add()
    {
        return view('testa/add');
    }

    public function add_do()
    {
        $post=request()->except('_token');
        // dd($post);
        $res=DB::table('test')->insert($post);
        if ($res) {
            return redirect('/test/list');
        }
    }

    public function list()
    {
        $data=DB::table('test')->get();
        return view('/testa/list',['data'=>$data]);
    }

    public function delete($id)
    {
        $res=DB::table('test')->where(['id'=>$id])->delete();
        // dd($res);
        if ($res) {
            return redirect('/test/list');
        }
    }

    public function edit($id)
    {
        $data=DB::table('test')->where(['id'=>$id])->first();
        return view('/testa/edit',['data'=>$data]);
    }

    public function update($id)
    {
        $post=request()->except('_token');
        $res=DB::table('test')->where(['id'=>$id])->update($post);
        // dd($res);
        if ($res) {
            return redirect('/test/list');
        }
    }
}
