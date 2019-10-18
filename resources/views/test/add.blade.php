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
                <button  type="button" id="add" class="btn btn-primary block full-width m-b">添加</button>

            </form>
        </div>
    </div>

    <script type="text/javascript">
            $('#add').click(function() {
                var name = $("[name='name']").val();
                var age = $("[name='age']").val();
                var url="http://www.yuesong.com/api/user";
                // alert(name)
                $.ajax({
                    url:url,
                    type:"POST",
                    data:{name:name,age:age},
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



    
    


