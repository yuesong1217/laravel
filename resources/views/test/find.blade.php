@extends('layouts.hadmin')

@section('title')
登录
@endsection

@section('content')

            <form class="m-t" role="form" >
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="姓名">
                </div>
                <div class="form-group">
                    <input type="text" name="age" class="form-control" placeholder="年龄" >
                </div>
                <button  type="button" id="add" class="btn btn-primary block full-width m-b">修改</button>

            </form>
        </div>
    </div>

    <script type="text/javascript">
             function GetQueryString(name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
                var r = window.location.search.substr(1).match(reg);
                if (r != null) return unescape(r[2]); return null;
            }
                var id=GetQueryString('id');
                var url="http://www.yuesong.com/api/user";
                // alert(id)
                $.ajax({
                    url:url+'/'+id,
                    dataType:'json',
                    success:function(res){
                        // console.log(res.data);
                        // alert(res.data.id)
                        $('[name="name"]').val(res.data.name);
                        $('[name="age"]').val(res.data.age);
                    }
                });
                $('#add').click(function() {
                    var id=GetQueryString('id');
                    var name = $("[name='name']").val();
                    var age = $("[name='age']").val();
                // alert(name)
                    $.ajax({
                        url:url+'/'+id,
                        type:'post',
                        data:{name:name,age:age,'_method':'put'},
                        dataType:'json',
                        success:function(res){
                            if (res.code = 1) {
                                alert(res.msg)
                                location.href='show';
                            };
                        }
                    });
                });
    </script>
@endsection



    
    


