<?php

namespace App\Http\Controllers\hadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\hadmin\Type;
use App\hadmin\Attr;
class TypeController extends Controller
{
    public function add()
    {
        return view('hadmin.type.add');
    }

    public function add_do()
    {
        $post = request()->all();
        $res = Type::create($post);
        if ($res) {
            return redirect('hadmin/type/list');
        }
    }

    public function list()
    {
        $data = Type::get();
        // $count = Attr::get();
        // $type_id = [];
        $count = [];
        foreach ($data as $k => $v) {
            // $type_id[] = $v['type_id'];
            $count[] = Attr::where(['type_id'=>$v['type_id']])->count();
            $v['count'] = $count;
        }
        // $data['count']=$count;
        // dd($data);
        return view('hadmin/type/list',['data'=>$data]);
    }

    public function show()
    {
        $id = request()->input('type_id');
        // dd($id);
        $data = Attr::where(['type_id'=>$id])->get();
        // dd($data);
        return view('hadmin.attr.show',['data'=>$data]);
    }
}
