<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Validation\Rule;
use DB;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin/index');
    }
    public function foot()
    {
        return view('admin/inc/foot');
    }
    public function head()
    {
        return view('admin/inc/head');
    }
    public function left()
    {
        return view('admin/inc/left1');
    }
    public function main()
    {
        return view('admin/inc/main');
    }
    public function list()
    {
        $brand_name=request()->input('brand_name')??'';
        // dd($brand_name);
        $where=[
            ['brand_name','like','%'.$brand_name.'%']
        ];
        $data=DB::table('brand')->where($where)->paginate(4);
        // dd($data);
        return view('admin/brand/list',['data'=>$data],['brand_name'=>$brand_name]);
    }
    public function add()
    {
        return view('admin/brand/add');
    }

    public function add_do()
    {
        $post=request()->except('_token');
        // dd(request()->hasFile('brand_logo'));
        if (request()->hasFile('brand_logo')) {
            $post['brand_logo']=upload('brand_logo');
        }
        $validator = Validator::make($post, [
            'brand_name' => 'required|unique:brand|max:50',
        ],[
            'brand_name.required'=>'品牌名称不能为空',
             'brand_name.unique'=>'品牌名称已存在',
        ]);
            if ($validator->fails()) {
            return redirect('admin/brand/add')
            ->withErrors($validator)
           ->withInput();
            }
        $post['brand_time']=time();
        $res=DB::table('brand')->insert($post);
        // dd($post);
        // dd($res);
        if ($res) {
            return redirect('admin/brand/list');
        }
        // dd($post);
    }
    public function delete($brand_id)
    {
        // dd($brand_id);
        $res=DB::table('brand')->where(['brand_id'=>$brand_id])->delete();
        // dd($res);
        if ($res) {
            return redirect('admin/brand/list');
        }
    }

    public function edit($brand_id)
    {
        // dd($brand_id);
        $data=DB::table('brand')->where(['brand_id'=>$brand_id])->first();
        // dd($data);
        return view('admin/brand/edit',['data'=>$data]);
    }

    public function update($brand_id)
    {
        // dd($brand_id);
        $post=request()->except('_token');
        $validator = Validator::make($post, [
         'brand_name'=>[
                'required',
                //验证排除自己
                Rule::unique('brand')->ignore($brand_id,'brand_id'),
                'max:50',
        ],[
            'brand_name.required'=>'品牌名称不能为空',
             'brand_name.unique'=>'品牌名称已存在',
        ]]);
            if ($validator->fails()) {
            return redirect('admin/brand/edit')
            ->withErrors($validator)
           ->withInput();
            }
            if (request()->hasFile('brand_logo')) {
                $post['brand_logo']=upload('brand_logo');
            }
        $res=DB::table('brand')->where(['brand_id'=>$brand_id])->update($post);
        // dd($res);
        if ($res) {
            return redirect('admin/brand/list');
        }
    }
}
