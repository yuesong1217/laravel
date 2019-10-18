@extends('layouts.hadmin')

@section('title')

@endsection

@section('content')
<form action="" class="form" style="margin-top:50px;">
    商品类型：<select name="type_name" class="select" id="">
        <option value="">请选择商品类型</option>
    @foreach($type as $v)
        <option value="{{$v->type_id}}">{{$v->type_name}}</option>
    @endforeach
    </select>
</form>
    <table class="table table-bordered">
        <tr align="center">
            <td>编号</td>
            <td>属性名称</td>
            <td>商品类型</td>
        </tr>
        <tbody class="list">
        @foreach($data as $v)
        
        <tr align="center" class="a">
            <td>{{$v->attr_id}}</td>
            <td>{{$v->attr_name}}</td>
            <td>{{$v->type_name}}</td>
        </tr>
        
        @endforeach
        </tbody>
    </table>
    <script type="text/javascript">
        $('.select').change(function() {
            // alert(1
            // alert($(this).val())
            var type_id = $(this).val();
            // alert(type_name)
            $.ajax({
                url:"http://www.yuesong.com/hadmin/attr/search",
                data:{type_id:type_id},
                dataType:'json',
                method:"POST",
                success:function(res){
                    // console.log(res);
                    $('.list').empty();
                    $.each(res.data, function(k, v) {
                        var tr = $('<tr align="center"></tr>');
                        tr.append('<td>'+v.attr_id+'</td>');
                        tr.append('<td>'+v.attr_name+'</td>');
                        tr.append('<td>'+v.type_name+'</td>');
                        $('.list').append(tr);
                    });
                }
            })

        });
    </script>
@endsection