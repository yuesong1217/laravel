<form action="">
    @csrf
</form>
@if(request()->session()->get('userhuo'))
            <a class="p1">欢迎，</a><b>{{session('userhuo')->uname}}</b>

            <p>
                <a href="javascript:;" class="logout">退出</a>
            </p>
        @else
        <p>
            <a href="javascript:;" class="login">登录</a>
        </p>
        @endif
        <a href="/role/useradd">添加用户</a><br />
        <a href="/role/list">货物列表</a><br />
        <a href="/role/guanli">出入库管理</a>
<table align="center" width="700">
    <tr align="center">
        <td>用户ID</td>
        <td>用户名</td>
        <td>用户身份</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr align="center">
        <td>{{$v->uid}}</td>
        <td>{{$v->uname}}</td>
        <td>{{$v->pid}}</td>
        <td><a href="javascript:;" uid="{{$v->uid}}" class="delete">禁用</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" uid="{{$v->uid}}"  class="update">升级为主管</a></td>
    </tr>
    @endforeach
</table>
<script type="text/javascript" src="/index/js/jquery.min.js"></script>
<script type="text/javascript">
    $('.delete').click(function() {
        var uid = $(this).attr('uid');
        var pid = $(this).parent().prev().text();
        var _token = $('[name="_token"]').val();
        // alert(pid)
        $.post(
            "/role/delete",
            {uid:uid,_token:_token},
            function(res){
                alert(res.msg);
                if (res.code==1) {
                    location.href="/role/userlist";
                };
            },
            'json'
        );
    });
    $('.logout').click(function() {
        location.href="/role/logout";
    });
    $('.update').click(function() {
        var uid = $(this).attr('uid');
        var pid = $(this).parent().prev().text();
        var _token = $('[name="_token"]').val();
        $.post(
            "/role/update",
            {uid:uid,pid:pid,_token:_token},
            function(res){
                alert(res.msg);
                if (res.code==1) {
                    location.href="/role/userlist";
                };
            },
            'json'
        );
    });
</script>