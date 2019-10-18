@extends('layouts.hadmin')

@section('content')
<form action="" style="margin-top:50px;">
    <input type="text" name="goods_name" />
    <select name="cate_id" id="" >
        <option value="0">请选择商品分类</option>
        @foreach($cate as $v)
        <option value="{{$v->cate_id}}">{{str_repeat('--',$v->level*2)}}{{$v->cate_name}}</option>
        @endforeach
    </select>
    <button class="btn btn-default">查询</button>
</form>
    <table class="table table-bordered">
        <tr>
            <td>编号</td>
            <td>商品名称</td>
            <td>分类名称</td>
            <td>货号</td>
            <td>价格</td>
            <td>商品图片</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->goods_id}}</td>
            <td><span class="goods_name" goods_id="{{$v->goods_id}}">{{$v->goods_name}}</span><input type="text" style="display:none;" class="input" /></td>
            <td>{{$v->cate_name}}</td>
            <td>{{$v->sku_num}}</td>
            <td>{{$v->goods_price}}</td>
            <td><img src="{{$v->goods_img}}" width="100" alt="" /></td>
            <td><a href="{{url('hadmin/product/add')}}?goods_id={{$v->goods_id}}">进货</a></td>
        </tr>
        @endforeach
    </table>
    <script type="text/javascript">
        $('.goods_name').click(function() {
            // alert(1)\
            var _this = $(this);
            var goods_id = $(this).attr('goods_id');
            var name = $(this).text();
            var input = $(this).next();
            _this.hide();
            input.val(name);
            input.show();
            $('.input').blur(function() {
                var thisis = $(thisis);
                var goods_name = $(this).val();
                // alert(goods_id)
                // alert(1)
                $.ajax({
                    url:"http://www.yuesong.com/hadmin/goods/update",
                    data:{goods_id:goods_id,goods_name:goods_name},
                    dataType:'json',
                    method:"POST",
                    success:function(res){
                        if (res.code == 1) {
                            alert(res.msg)
                            $('.input').hide();
                            _this.text(goods_name);
                            _this.show();
                        }
                    }
                });
            });
            // alert(goods_name)
            // $.ajax({
            //     url
            // })
            
        });
    </script>
@endsection