<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/hadmin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/hadmin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/hadmin/css/animate.css" rel="stylesheet">
    <link href="/hadmin/css/style.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">h</h1>

            </div>
            <h3>欢迎使用 hAdmin</h3>

            <form class="m-t" role="form" action="login_do" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="pwd" class="form-control" placeholder="密码" required="">
                </div>
                <div class="form-group">
                    <input type="text" name="code" class="form-control" placeholder="微信验证码" required="">
                    <button type="button" class="getcode">获取验证码</button>
                </div>
                <button  class="btn btn-primary block full-width m-b">登 录</button>
                <img src="/hadmin/img/0.jpeg" alt="" width="500" style="margin-left:-100px;" />


                <p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>
                </p>

            </form>
        </div>
    </div>

    <!-- 全局js -->
    <script src="/hadmin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/hadmin/js/bootstrap.min.js?v=3.3.6"></script>
    <script type="text/javascript">
        $('.getcode').click(function() {
            // alert(1)
            // var code = $("[name='code']").val();
            var username = $("[name='username']").val();
            // alert(code);
            $.post(
                "{{url('hadmin/getCode')}}",
                {username:username},
                function(res){
                    alert(res.msg)
                },
                'json'
            );
        });
    </script>

    
    

</body>

</html>
