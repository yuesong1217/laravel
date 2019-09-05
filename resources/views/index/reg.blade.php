@extends('layouts.shop')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <!-- <form action="/reg/regdo" method="post" class="reg-login"> -->
      <h3>已经有账号了？点此<a class="orange" href="/login">登陆</a></h3>
      <div class="lrBox">
      @csrf
       <div class="lrList"><input type="text" name="user_email" placeholder="输入手机号码或者邮箱号" class="a" /></div>
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" class="b" /> <a class="c" href="javascript:;">获取验证码</a></div>
       <div class="lrList"><input type="text" name="user_pwd" placeholder="设置新密码（6-18位数字或字母）" class="d" /></div>
       <div class="lrList"><input type="text" name="user_repwd" placeholder="再次输入密码" class="e" /></div>
       <a class="reg" href="javascript:;">立即注册</a>
      </div><!--lrBox/-->
    <script src="/index/js/jquery.min.js"></script>
      <script type="text/javascript">
            $('.c').click(function() {
                var email = $('.a').val();
                // alert(email);
                var _token=$('[name="_token"]').val();
                // alert(_token)
                // if (email=='') {
                //     alert('请填写邮箱或者手机号');return false;
                // };
                $.post(
                    "/reg/sendemail",
                    {email:email,_token,_token},
                    function(res){
                        alert(res.msg);
                        if (res.code==1) {
                            // window.location.href="/login";
                        };
                    },
                    'json'
                );
               
            });
            $('.reg').click(function() {
                // alert(1);
                var user_email = $('.a').val();
                // alert(email);
                var code = $('.b').val();
                var _token=$('[name="_token"]').val();
                var user_pwd = $('.d').val();
                var user_repwd = $('.e').val();
                // var _token = $('')
                $.post(
                    "/reg/regdo",
                    {user_email:user_email,code:code,user_pwd:user_pwd,user_repwd:user_repwd,_token:_token},
                    function(res){
                        alert(res.msg);
                    },
                    'json'
                );
            });
      </script>
      <div class="lrSub">
       
      </div>
     <!-- </form>reg-login/ -->
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
@endsection
