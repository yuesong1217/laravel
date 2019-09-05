<?php

namespace App\Http\Controllers\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\Rule;
use DB;

class LinkController extends Controller
{
    public function create()
    {
        return view('exam/create');
    }

    public function index()
    {
        $url_name=request()->input('url_name')??'';
        // dd($url_name);
        $where=[
            ['url_name','like','%'.$url_name.'%']
        ];
        // dd($where);
        $data=DB::table('url')->where($where)->paginate(4);
        return view('exam/index',['data'=>$data],['url_name'=>$url_name]);
    }

    public function save()
    {
        $post = request()->except('_token');
        
        // $reg='//'
        $url_name=request()->post('url_name');
        $url_address=request()->post('url_address');
        $count=DB::table('url')->where(['url_name'=>$url_name])->count();
        if ($count) {
            echo json_encode(['msg'=>'用户名已存在','code'=>0]);return;
        }
        $validator = Validator::make($post, [
            'url_name' => 'required|unique:url|alpha_dash ',
            'url_address'=>'required|url'

        ],[
            'url_name.required'=>'网站名称不能为空',
            'url_name.alpha_dash'=>'网站名称必须为字母、数字、下划线或者破折号',
             'url_name.unique'=>'网站名称已存在',
             'url_address:url'=>'网站地址必须为正确的url地址',
        ]);
            if ($validator->fails()) {
            return redirect('exam/create')
            ->withErrors($validator)
           ->withInput();
            }
        if (request()->hasFile('url_logo')) {
            $post['url_logo']=upload('url_logo');
        }
        // dd($post);
        $res=DB::table('url')->insert($post);
        // dd($res);
        if ($res) {
            return redirect('exam/index');
        }
        // dd($post);
    }

    public function edit($url_id)
    {
        $data=DB::table('url')->where(['url_id'=>$url_id])->first();
        // dd($data);
        return view('exam/edit',['data'=>$data]);
    }

    public function update($url_id)
    {
        $post=request()->except('_token');
        
        $validator = Validator::make($post, [
         'url_name'=>[
                'required',
                //验证排除自己
                Rule::unique('url')->ignore($url_id,'url_id'),
        ],[
            'url_name.required'=>'网站名称不能为空',
             'url_name.unique'=>'网站名称已存在',
        ]]);
            if ($validator->fails()) {
            return redirect('exam/edit/'.$url_id.'')
            ->withErrors($validator)
           ->withInput();
            }
            if (request()->hasFile('url_logo')) {
                $post['url_logo']=upload('url_logo');
            }
        $res=DB::table('url')->where(['url_id'=>$url_id])->update($post);
        // dd($res);
        if ($res) {
            return redirect('exam/index');
        }
    }

    public function delete($url_id)
    {
        // $url_id=request()->input();
        // dd($url_id);
        $res=DB::table('url')->where(['url_id'=>$url_id])->delete();
        if ($res) {
            return redirect('exam/index');
        }
    }

}
