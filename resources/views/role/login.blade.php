<form action="/role/logindo" method="post">
    @csrf
    <p>
        用户名：<input type="text" name="uname" />
    </p>
    <p>
        密码：<input type="password" name="upwd" />
    </p>
    <p>
        <input type="button" value="登录" class="login" />
    </p>
</form>
<script type="text/javascript" src="/index/js/jquery.min.js"></script>
<script type="text/javascript">
    $('.login').click(function() {
        var uname = $('[name="uname"]').val();
        var upwd  = $('[name="upwd"]').val();
        var _token = $('[name="_token"]').val();
        $.post(
            "/role/logindo",
            {uname:uname,upwd:upwd,_token:_token},
            function(res){
                alert(res.msg)
                if (res.code==1) {
                    location.href="/role/userlist";
                };
            },
            'json'
        );
    });
</script>