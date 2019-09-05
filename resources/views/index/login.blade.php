@extends('layouts.shop')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="/login/logindo" method="post" class="reg-login">
     @csrf
      <h3>还没有三级分销账号？点此<a class="orange" href="/reg">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" class="user_email" name="user_email" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="text" class="user_pwd" name="user_pwd" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <a href="javascript:;" class="login">登录</a>
      </div>
      <script src="/index/js/jquery.min.js"></script>
      <script type="text/javascript">
          $('.login').click(function() {
            // alert(1);
            var user_email = $('.user_email').val();
            var _token = $('[name="_token"]').val();
            var user_pwd = $('.user_pwd').val();
            $.post(
              "/login/logindo",
              {user_email:user_email,user_pwd:user_pwd,_token:_token},
              function(res)
              {
                alert(res.msg);
                if (res.code==1) {
                  location.href='/';
                };
              },
              'json'
            );
          });
      </script>
     </form>
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