<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $where = [];
        // $
        $name = request('search_name');
        if (isset($name)) {
            $where[]=["name","like","%$name%"];
        }
        $data = DB::table('test')->where($where)->paginate(2);
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
        $name = request()->name;
        $age = request()->age;
        if (empty($name)  ||   empty($age)) {
            return json_encode(['msg'=>'参数不能为空','code'=>0]);
        }
        $res = DB::table('test')->insert([
                'name'=>$name,
                'age' =>$age
        ]);
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
        // $id = request('id');
        // dd($id);
        $data = DB::table('test')->where(['id'=>$id])->first();
        array($data);
        return json_encode(['data'=>$data]);
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
        $name = request()->name;
        $age = request()->age;
        // $id = request()->id;
        $res = DB::table('test')->where(['id'=>$id])->update([
                'name'=>$name,
                'age' =>$age
        ]);
        if ($res) {
            return json_encode(['msg'=>'修改成功','code'=>1]);
        }else{
            return json_encode(['msg'=>'修改失败','code'=>0]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $id = request()->id;
        $res = DB::table('test')->where(['id'=>$id])->delete();
        if ($res) {
            return json_encode(['msg'=>'删除成功','code'=>1]);
        }else{
            return json_encode(['msg'=>'删除失败','code'=>0]);
        }
    }
}
