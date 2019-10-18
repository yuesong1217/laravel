@extends('layouts.hadmin')

@section('title')
登录
@endsection

@section('content')
<form action="" class="form" style="margin-top:50px;margin-left:300px;" > 
    <input type="text" class="input" name="city" /><button type="button"  class="btn btn-primary">查询</button>
</form>
<ul class="ul weather">
    
</ul>
    <table class="table" style="margin-top:50px;">
        <tr>
            <td>商品id</td>
            <td>商品名称</td>
            <td>商品价格</td>
            <td>商品图片</td>
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
        var url = 'http://www.yuesong.com/api/goods';
        $.ajax({
            url:url,
            dataType:'json',
            success:function(res){
                // console.log(res)
                showData(res)
            }
        });

        $('.btn-primary').click(function() {
            var city = $('[name="city"]').val();
            // alert(city
            $.ajax({
                url:"http://www.yuesong.com/api/weather",
                data:{city:city},
                dataType:'json',
                method:"POST",
                success:function(res){
                    // console.log(res)
                    $('.weather').empty();
                    $('.weather').append('<li>'+res.weather.result.citynm+'</li>')
                    $('.weather').append('<li>'+res.weather.result.wind+'</li>')
                    $('.weather').append('<li>'+res.weather.result.weather+'</li>')
                }
            });
        });

        function showData(res)
        {
            $('.list').empty();
            $.each(res.data.data,function(k,v){
                var tr = $('<tr></tr>');
                tr.append('<td>'+v.goods_id+'</td>');
                tr.append('<td>'+v.goods_name+'</td>');
                tr.append('<td>'+v.goods_price+'</td>');
                tr.append('<td><img src='+v.goods_img+' width="120"></td>');
                $('.list').append(tr);
            })
            
            $('.pagination').empty();
            var max_page = res.data.last_page;
            for (var i = 1; i <= max_page; i++) {
                var li = "<li><a href='javascript:;'>"+i+"</a></li>"
                $('.pagination').append(li)
            };
            $('li').click(function() {
                var page = $(this).text();
                $.ajax({
                    url:url,
                    data:{page:page},
                    dataType:'json',
                    success:function(res){
                        showData(res);
                    }
                });
            });
            
        }
    </script>
@endsection