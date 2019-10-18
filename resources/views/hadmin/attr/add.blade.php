@extends('layouts.hadmin')

@section('title')

@endsection

@section('content')
    <form style="margin-top:50px;" action="{{url('hadmin/attr/add_do')}}" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">属性名称</label>
            <input type="text" name="attr_name" class="form-control cate_name" id="exampleInputEmail1" placeholder="类型名称" style="height:50px;"><b class="b"></b>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">商品类型</label>
            <select class="form-control" style="height:50px;" name="type_id">
              @foreach($type as $v)
              <option value="{{$v->type_id}}">{{$v->type_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">属性是否可选</label><br />
            参数:<input type="radio" name="attr_cate" value="1" class=""  placeholder="">
            规格:<input type="radio" name="attr_cate" value="2" class=""  placeholder=""><b class="b"></b>
          </div>
          <button type="" class="btn btn-default">添加</button>
    </form>
@endsection