@extends('layouts.hadmin')

@section('title')

@endsection

@section('content')
    <table class="table table-bordered" style="margin-top:50px;">
        <tr align="center">
            <td>编号</td>
            <td>属性名称</td>
        </tr>
        @foreach($data as $v)
        <tr align="center">
            <td>{{$v->attr_id}}</td>
            <td>{{$v->attr_name}}</td>
        </tr>
        @endforeach
    </table>
@endsection