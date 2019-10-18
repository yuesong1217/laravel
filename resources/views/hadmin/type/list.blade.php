@extends('layouts.hadmin')

@section('title')

@endsection

@section('content')
    <table class="table table-bordered" style="margin-top:50px;">
        <tr>
            <td>商品类型名称</td>
            <td>属性数</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k => $v)
        <tr>
            <td>{{$v->type_name}}</td>
            <td>{{$v->count[$k]}}</td>
            <td><a href="http://www.yuesong.com/hadmin/attr/show?type_id={{$v->type_id}}" class="type" type_id="{$v->type_id}">属性列表</a></td>
        </tr>
        @endforeach
    </table>

@endsection