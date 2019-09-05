<form action="" method="" align="center">
    <p>
        用户名：<input type="text" name="name" />
    </p>
    <p>
        密码：<input type="password" name="pwd" />
    </p>
    <p>
        <button type="button" class="sub">登录</button>
    </p>
</form>
<script type="text/javascript" src="/index/js/jquery.min.js"></script>
<script type="text/javascript">
    $('.sub').click(function() {
        window.location.href="wechat/login";
    });
</script>