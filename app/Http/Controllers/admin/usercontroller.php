<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;
use DB;
class usercontroller extends Controller
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
    // public function login()
    // {
    //     return view('admin/login');
    // }
    // public function logindo()
    // {
    //     $crm_user=request()->input('crm_user');
    //     $crm_pwd=request()->input('crm_pwd');
    //     $user=DB::table('crm_user')->where(['crm_user'=>$crm_user])->first();
    //     dd($user);
    //     // dd($crm_user);
    // }
    public function user()
    {
        // dd(\Auth::check());
        $search=request()->input();
        $crm_user=$search['crm_user']??'';
        // dd($search);
        
        $data=db::table('crm_user')->where('crm_user','like','%'.$crm_user.'%')->paginate(4);
        return view('admin/user/user',compact(['data','search','crm_user']));
    }
    public function user_do(Request $request)
    {
        // echo "123";die;
        // $request->validate([         
        //     'crm_user' => 'required|unique:crm_user|max:255',         
        //     'crm_pwd' => 'required'
        //     ]);
         

        
        // dd($headimg);
        // $user=request()->input('user');
        // $pwd=request()->input('pwd');
        // $headimg=request()->input('post.headimg');
        $post=request()->input();
        
        // dd($post);
        // dd($headimg);
        // dd($request->hasFile('headimg'));
        if (request()->hasFile('headimg')) {
            $post['headimg']=upload('headimg');
            
        }
        // dd($post);
        unset($post['_token']);
        $post['crm_time']=time();
        $post['crm_vip']=0;
        $validator = Validator::make($post, [
            'crm_user' => 'required|unique:crm_user|max:50',
        ],[
            'crm_user.required'=>'用户名不能为空',
             'crm_user.unique'=>'用户名已存在',
        ]);
            if ($validator->fails()) {
            return redirect('admin/user/user')
            ->withErrors($validator)
           ->withInput();
            }
        // $where=[
        //     'crm_user'=>$user,
        //     'crm_pwd'=>$pwd,
        //     'crm_vip'=>0,
        //     'crm_time'=>time(),
        //     'headimg'=>123,
        // ];
        $res=db::table('crm_user')->insert($post);
        if ($res){
            return redirect('admin/user/user');
        }
    }

    

    public function edit($crm_id)
    {
        // dd($crm_id);
        $data=DB::table('crm_user')->where(['crm_id'=>$crm_id])->first();
        // dd($data);
        return view('admin/user/edit',['data'=>$data]);
    }

    public function update($crm_id)
    {
        // dd($crm_id);
        $post=request()->except('_token');
        $validator = Validator::make($post,[
         'crm_user'=>[
                'required',
                //验证排除自己
                Rule::unique('crm_user')->ignore($crm_id,'crm_id'),
                'max:50',
        ],[
            'crm_user.required'=>'用户名不能为空',
             'crm_user.unique'=>'用户名已存在',
        ]]);
            if ($validator->fails()) {
            return redirect('admin/user/edit')
            ->withErrors($validator)
           ->withInput();
            }
        if (request()->hasFile('headimg')) {
            $post['headimg']=upload('headimg');
            $filename=storage_path('app/public/').$post['oldimg'];
            if (file_exists($filename)) {
            
            // dd($filename);
            unlink($filename);
        }
        }
        unset($post['oldimg']);
        $res=DB::table('crm_user')->where(['crm_id'=>$crm_id])->update($post);
        // dd($res);
        if ($res) {
            return redirect('admin/user/user');
        }
        // dd($post);
    }

    public function delete($crm_id)
    {
        // dd($crm_id);
        $res=DB::table('crm_user')->where(['crm_id'=>$crm_id])->delete();
        if ($res) {
            return redirect('admin/user/user');
        }
    }
}
