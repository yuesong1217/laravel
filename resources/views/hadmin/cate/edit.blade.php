@extends('layouts.hadmin')

@section('title')

@endsection

@section('content')
    <form style="margin-top:50px;" action="{{url('hadmin/cate/update')}}/{{$data->cate_id}}" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">分类名称</label>
            <input type="text" name="cate_name" value="{{$data->cate_name}}" class="form-control cate_name" id="exampleInputEmail1" placeholder="分类名称" style="height:50px;"><b class="b"></b>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">上传分类</label>
            <select class="form-control" style="height:50px;" name="pid">
              <option value="0">顶级分类</option>
              @foreach($cates as $v)
              <option value="{{$v->cate_id}}" @if($data->pid == $v->cate_id) selected @endif>{{str_repeat('--',$v->level*2)}}{{$v->cate_name}}</option>
              @endforeach
            </select>
          </div>
          <button type="" class="btn btn-default">添加</button>
    </form>
    <script type="text/javascript">
        $('.cate_name').blur(function() {
            // alert(1
            var cate_name = $("[name=cate_name]").val();
            var type = $('.btn-default').prop('type');
            
            if (cate_name == '') {
                // event.preventDefault();
                alert('分类名称不能为空');
                $('.btn-default').click(function() {
                    event.preventDefault();
                });
                // type = 'button';
                // alert(type);return;
            };
            $.ajax({
                url:'http://www.yuesong.com/hadmin/cate/checkname',
                data:{cate_name:cate_name},
                method:"POST",
                dataType:'json',
                success:function(res){
                    // alert(res)
                    if (res.code == 1) {
                        $('.b').text(res.msg);
                        $('.btn-default').click(function() {
                            event.preventDefault();
                        });
                    };
                }
            });
        });
    </script>
@endsection