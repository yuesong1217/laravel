<?php

namespace App\Http\Controllers\hadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\hadmin\Attr;
use App\hadmin\Type;
class AttrController extends Controller
{
    public function add()
    {
        $type = Type::get();
        // dd($type);
        return view('hadmin.attr.add',['type'=>$type]);
    }

    public function add_do()
    {
        $post = request()->all();
        $res = Attr::create($post);
        if ($res) {
            return redirect('hadmin/attr/list');
        }
    }

    public function list()
    {
        // dd($datas);
        $type = Type::get();
        $data = Attr::join('hadmin_type','hadmin_attr.type_id','=','hadmin_type.type_id')->get();
        // dd($data);
        return view('hadmin.attr.list',['data'=>$data,'type'=>$type]);
    }

    public function search()
    {
         $id = request()->type_id;
         if (!$id) {
            // dd(1);
             $data = Attr::join('hadmin_type','hadmin_attr.type_id','=','hadmin_type.type_id')->get();
             // dd($data);
             // return json_encode($data);
         }
        // dd($id);
        // echo $id;
        // var_dump($id);
        $typedata = Type::where(['type_id'=>$id])->get();
        // dd($data);
        foreach ($typedata as $k => $v) {
            $data = Type::join('hadmin_attr','hadmin_attr.type_id','=','hadmin_type.type_id')->where(['type_name'=>$v['type_name']])->get();
        }
        // dd($data);
        return json_encode(['data'=>$data]);
    }
}
