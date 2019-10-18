@extends('layouts.hadmin')

@section('title')
登录
@endsection

@section('content')
<form action="" class="form" style="margin-top:50px;margin-left:300px;" > 
    <input type="text" class="input" name="name" /><button type="button"  class="btn btn-primary">搜索</button>
</form>
    <table class="table" style="margin-top:50px;">
        <tr>
            <td>用户id</td>
            <td>用户姓名</td>
            <td>用户年龄</td>
            <td>操作</td>
        </tr>
        <tbody class="list">
            
        </tbody>
    </table>
    <nav aria-label="Page navigation">
  <ul class="pagination">
    
    <!-- <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li> -->
    
  </ul>
</nav>
    <script type="text/javascript">
        var url="http://www.yuesong.com/api/user";
            $.ajax({
                    url:url,
                    dataType:'json',
                    success:function(res){
                        // console.log(res)
                        showData(res);
                    }
                });
    $('.btn-primary').click(function() {
        // alert(1)
        var search_name  = $("[name='name']").val(); 

        $.ajax({
                    url:url,
                    data:{search_name:search_name},
                    dataType:'json',
                    success:function(res){
                        // console.log(res)
                        showData(res);
                            
                    }
                });
    });

    function showData(res)
    {
        $('.list').empty();
        $.each(res.data.data,function(k,v){
                                            // console.log(v)
                                            
            var tr = $('<tr></tr>');
            tr.append('<td>'+v.id+'</td>');
            tr.append('<td>'+v.name+'</td>');
            tr.append('<td>'+v.age+'</td>');
            tr.append('<td><a href="find?id='+v.id+'" class="btn btn-success">修改</a>||<a class="del btn btn-danger"  pid="'+v.id+'">删除</a></td>');
                                            // $('.tr').remove();
            $('.list').append(tr);
                                            
            $('.del').click(function() {
                var id = $(this).attr('pid');
                                                // alert(id)
                $.ajax({
                    url:url+'/'+id,
                    type:'POST',
                    data:{"_method":"DELETE"},
                    dataType:'json',
                    success:function(res){
                        if (res.code==1) {
                            alert(res.msg);
                            location.href="show"
                        };
                    }
                })
            });
        })
                            $('.pagination').empty();
                            var max_page = res.data.last_page;
                            // console.log(res.data.last_page);
                            for (var i = 1; i <= max_page; i++) {
                                var li = '<li><a href="javascript:;">'+i+'</a></li>';
                                $('.pagination').append(li);
                            };
                            $('li').click(function() {
                                var page = $(this).text();
                                var search_name  = $("[name='name']").val(); 
                                // alert(i)
                                $.ajax({
                                    url:url,
                                    data:{search_name:search_name,page:page},
                                    dataType:'json',
                                    success:function(res){
                                        // console.log(res)
                                            showData(res);
                                    }
                                });
                            });
    }
    
        
        
    </script>
    <script type="text/javascript">

    </script>
@endsection