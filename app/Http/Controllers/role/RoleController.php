<?php

namespace App\Http\Controllers\role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RoleController extends Controller
{
    public function add()
    {
        return view('role/add');
    }

    public function add_do()
    {
        $post=request()->except('_token');
        // dd($post);
        if (request()->hasFile('hpic')) {
            $post['hpic']=upload('hpic');
        }
        $post['htime']=time();
        // dd($post);
        $res=DB::table('huowu')->insert($post);
        $data=DB::table('huowu')->where(['hname'=>$post['hname']])->first();
        $session=request()->session()->get('userhuo');
        // dd($data);
        $arr = [
            'uid'=>$session->uid,
            'hid'=>$data->hid,
            'time'=>time(),
            'type'=>'入库',
        ];
        $res=DB::table('guanli')->insert($arr);
        // dd($res);
        if ($res) {
            return redirect('role/list');
        }
    }

    public function login()
    {
        return view('role/login');
    }

    public function logindo()
    {
        $post=request()->except('_token');
        // dd($post);
        $data=DB::table('role')->where(['uname'=>$post['uname']])->first();
        // dd($data);
        if (!$data) {
            echo json_encode(['msg'=>'查无此人','code'=>0]);die;
        }else if($data->upwd!=$post['upwd']){
            echo json_encode(['msg'=>'密码错误','code'=>0]);die;
        }else{
            request()->session()->put('userhuo',$data);
            request()->session()->save();
            echo json_encode(['msg'=>'登陆成功','code'=>1]);
        }

    }

    public function userlist()
    {
        $data=DB::table('role')->get();
        return view('role/userlist',['data'=>$data]);
    }

    public function delete()
    {
        $uid=request()->uid;
        // $pid=request()->pid;
        // dd($uid);
        $session=request()->session()->get('userhuo');
        // dd($session);
        if ($session->pid!='主管') {
            echo json_encode(['msg'=>'只有主管才能进行此类操作','code'=>0]);die;
        }
        
        $res=DB::table('role')->where(['uid'=>$uid])->delete();
        if ($res) {
            echo json_encode(['msg'=>'禁用成功','code'=>1]);
        }
    }

    public function update()
    {
        $uid=request()->uid;
        $pid=request()->pid;
        if ($pid!='库管员') {
            echo json_encode(['msg'=>'主管不能升级为主管','code'=>0]);die;
        }
        $session=request()->session()->get('userhuo');
        // dd($session);
        if ($session->pid!='主管') {
            echo json_encode(['msg'=>'只有主管才能进行此类操作','code'=>0]);die;
        }
        $res=DB::table('role')->where(['uid'=>$uid])->update(['pid'=>'主管']);
        if ($res) {
            echo json_encode(['msg'=>'升级成功','code'=>1]);
        }
    }

    public function logout()
    {
        request()->session()->forget('userhuo');
        echo "<script>alert('退出成功')</script>";
        return redirect('role/login');
    }

    public function list()
    {
        $data=DB::table('huowu')->get();
        return view('role/list',['data'=>$data]);
    }

    public function huout($id)
    {
        $data=DB::table('huowu')->where(['hid'=>$id])->first();
        return view('role/huout',['data'=>$data]);
    }

    public function huout_do()
    {
        $post=request()->except('_token');
        // dd($post);
        $data=DB::table('huowu')->where(['hid'=>$post['hid']])->first();
        if ($post['hnum'] > $data->hnum) {
            echo json_encode(['msg'=>'出库数量超过库存数量','code'=>0]);die;
        }else{
            $session=request()->session()->get('userhuo');
            // dd($session->uid);
            $hnum=$data->hnum - $post['hnum'];
            // dd($hnum);
            DB::table('huowu')->where(['hid'=>$post['hid']])->update(['hnum'=>$hnum]);
            $arr = [
                'uid'=>$session->uid,
                'hid'=>$post['hid'],
                'time'=>time(),
                'type'=>'出库',
            ];
            $res=DB::table('guanli')->insert($arr);
            if ($res) {
                echo json_encode(['msg'=>'出库成功','code'=>1]);
            }
            
        }
    }

    public function guanli()
    {
        $data=DB::table('guanli')->get();
        return view('role/guanli',['data'=>$data]);
    }

    public function useradd()
    {
        return view('role/useradd');
    }

    public function useradd_do()
    {
        $post=request()->except('_token');
        $res=DB::table('role')->insert($post);
        if ($res) {
            return redirect('role/userlist');
        }
    }
}
