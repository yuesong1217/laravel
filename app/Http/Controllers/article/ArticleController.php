<?php

namespace App\Http\Controllers\article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use DB;

class ArticleController extends Controller
{
    public function create()
    {
        return view('article/create');
    }

    public function save()
    {
        $post=request()->except("_token");
        $post['a_time']=time();
        // dd($post);
        $res=DB::table('article')->insert($post);
        if ($res) {
            return redirect('article/index');
        }
    }

    public function index()
    {
        $data=DB::table('article')->get();
        foreach ($data as  $v) {
            $v->count=Redis::get($v->a_id);
        }
        // dd($data);
        // $data->count=Redis::get('likes');
        return view('article/index',['data'=>$data]);
    }

    public function login()
    {
        return view('article/login');
    }

    public function logindo()
    {
        $post=request()->except('_token');
        // dd($post);
        $data=DB::table('usr')->where(['u_name'=>$post['u_name']])->first();
        // dd($data);
        if ($post['u_name']!=$data->u_name) {
            echo json_encode(['msg'=>'用户名不存在','code'=>0]);die;
        }else if($post['u_pwd']!=$data->u_pwd){
            echo json_encode(['msg'=>'密码错误','code'=>0]);die;
        }else{
            request()->session()->put('userarticle',$data);
            request()->session()->save();
            echo json_encode(['msg'=>'登录成功','code'=>1]);
        }
    }

    public function logout()
    {
        request()->session()->forget('userarticle');
        return redirect('article/index');
    }

    public function likes()
    {
        if (!request()->session()->get('userarticle')) {
            echo json_encode(['msg'=>'请先登录','code'=>0]);die;
        }
        $post=request()->except('_token');
        $user=DB::table('usr')->where(['u_id'=>$post['u_id']])->first();
        if ($user->u_status==1) {
            echo json_encode(['msg'=>'您已经喜欢过别的文章了','code'=>2]);die;
        }
        // dd($post['a_id']);
        Redis::set($post['a_id'],0);
        $redis = Redis::get($post['a_id']);
        // dd($redis);
        $redis=$redis+1;
        Redis::set($post['a_id'],$redis);
        $count=Redis::get($post['a_id']);
        // dd($count);
        
        $res=DB::table('usr')->where(['u_id'=>$post['u_id']])->update(['u_status'=>1]);
        if ($res) {
            echo json_encode(['msg'=>'点赞成功','code'=>1,'count'=>$count]);
        }
        // $user->u_status=1;
        // dd($redis);
        
    }
}
