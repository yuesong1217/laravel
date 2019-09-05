<form>
    @csrf
    <p>
        用户名：<input type="text" name="u_name"  />
    </p>
    <p>
        密码：<input type="password" name="u_pwd" />
    </p>
    <p>
        <input type="button" value="登录" class="login" />
    </p>
</form>
<script type="text/javascript" src="/index/js/jquery.min.js"></script>
<script type="text/javascript">
    $('.login').click(function() {
        var u_name=$("[name='u_name']").val();
        var u_pwd=$("[name='u_pwd']").val();
        var _token=$("[name='_token']").val();
        $.post(
            "/article/logindo",
            {u_name:u_name,u_pwd:u_pwd,_token:_token},
            function(res){
                alert(res.msg);
                if (res.code==1) {
                    location.href="/article/index";
                };
            },
            'json'
        );
        // alert(_token)
    });
</script>