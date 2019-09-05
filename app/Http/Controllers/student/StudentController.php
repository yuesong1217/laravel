<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class StudentController extends Controller
{
    public function add()
    {
        return view('student/add');
    }

    public function add_do()
    {
        $post=request()->except('_token');
        // dd($post);
        $res=DB::table('student')->insert($post);
        // dd($res);
        if ($res) {
            return redirect('student/list');
        }
    }

    public function list()
    {
        $data=DB::table('student')->where(['s_status'=>0])->get();
        $datas=DB::table('student')->where(['s_status'=>1])->get();
        return view('student/list',['data'=>$data,'datas'=>$datas]);
    }

    public function delete($id)
    {
        $data=DB::table('student')->where(['s_id'=>$id])->first();
        // dd($data);
        $data->s_status=1;
        $datas=json_decode(json_encode($data),true);
        // dd($datas);
        $res=DB::table('student')->where(['s_id'=>$id])->update($datas);
        if ($res) {
            return redirect('student/list');
        }
    }
}
