@extends('layouts.hadmin')

@section('title')
登录
@endsection

@section('content')
    <script type="text/javascript">
        function GetQueryString(name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
                var r = window.location.search.substr(1).match(reg);
                if (r != null) return unescape(r[2]); return null;
            }
            var id=GetQueryString('id');
            $.ajax({
                    url:'http://www.yuesong.com/api/test/delete',
                    data:{id:id},
                    dataType:'json',
                    success:function(res){
                        // console.log(res.data);
                        // alert(res.data.id)
                        if (res.code==1) {
                            alert(res.msg);
                            location.href='show';
                        };
                    }
                });
    </script>
@endsection