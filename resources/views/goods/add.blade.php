@extends('layouts.hadmin')

@section('title')
商品添加
@endsection

@section('content')

        <div class="form-group">
            <input type="text" name="goods_name" class="form-control" placeholder="商品名称">
        </div>
        <div class="form-group">
            <input type="file" name="goods_img" class="form-control" placeholder="商品图片">
        </div>
        <div class="form-group">
            <input type="text" name="goods_price" class="form-control" placeholder="商品价格" >
        </div>
        <button  type="button" id="add" class="btn btn-primary block full-width m-b">添加</button>

            
        </div>
    </div>

    <script type="text/javascript">
        $('#add').click(function() {
            var url="http://www.yuesong.com/api/goods";
            var fd = new FormData();
            var goods_name = $("[name='goods_name']").val();
            var goods_price = $("[name='goods_price']").val();
            var goods_img = $("[name='goods_img']")[0].files[0];
            // console.log(goods_img);return;
            fd.append('goods_img',goods_img);
            fd.append('goods_name',goods_name);
            fd.append('goods_price',goods_price);
            // alert(goods_img)

            $.ajax({
                url:url,
                data:fd,
                method:"POST",
                contentType:false,
                processData:false,
                dataType:'json',
                success:function(res){
                    alert(res.msg);
                    if (res.code==1) {
                        location.href='show';
                    };
                }
            });
            
        });
    </script>
@endsection



    
    


