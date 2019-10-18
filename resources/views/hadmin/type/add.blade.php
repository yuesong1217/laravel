@extends('layouts.hadmin')

@section('title')

@endsection

@section('content')
    <form style="margin-top:50px;" action="{{url('hadmin/type/add_do')}}" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">类型名称</label>
            <input type="text" name="type_name" class="form-control cate_name" id="exampleInputEmail1" placeholder="类型名称" style="height:50px;"><b class="b"></b>
          </div>
          <button type="" class="btn btn-default">添加</button>
    </form>
@endsection