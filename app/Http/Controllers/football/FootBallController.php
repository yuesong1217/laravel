<?php

namespace App\Http\Controllers\football;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class FootBallController extends Controller
{
    public function add()
    {
        // echo date("Y-m-d H:i:s",time());die;
        return view('football/add');
    }

    public function add_do()
    {
        $post=request()->except('_token');
        $post['f_time']=strtotime($post['f_time']);
        // dd($post);
        $res=DB::table('football')->insert($post);
        if ($res) {
            echo json_encode(['msg'=>'添加成功','code'=>1]);
        }
    }

    public function list()
    {
        // echo date("Y-m-d H:i:s",time());die;
        $data=DB::table('football')->get();
        return view('football/list',['data'=>$data]);
    }

    public function guess($id)
    {
        // dd($id);
        // $f_id=request()->f_id;
        // dd($f_id);
        $data=DB::table('football')->where(['f_id'=>$id])->first();
        // dd($data);
        // dd($data);
        return view('football/guess',['data'=>$data]);
    }

    public function guess_do($id)
    {
        $f_result=request()->f_result;
        $res=DB::table('football')->where(['f_id'=>$id])->update(['f_result'=>$f_result]);
        // dd($res);
        if ($res) {
            return redirect('football/list');
        }
    }

    public function lookresult($id)
    {
        $data=DB::table('football')->where(['f_id'=>$id])->first();
        $data=DB::table('football')->where(['f_id'=>$id])->first();
        return view('football/lookresult',['data'=>$data]);
    }

    public function result($id)
    {
        $data=DB::table('football')->where(['f_id'=>$id])->first();
        return view('football/result',['data'=>$data]);
    }

    public function result_do($id)
    {
        $result=request()->result;
        $res=DB::table('football')->where(['f_id'=>$id])->update(['result'=>$result]);
        // dd($res);
        if ($res) {
            return redirect('football/list');
        }
    }
}
