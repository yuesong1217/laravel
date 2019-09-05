@extends('layouts.shop')
@section('content')
<div class="head-top">
      <img src="/index/images/head.jpg" />
      <dl>
       <dt><a href="user.html"><img src="/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">三级分销终身荣誉会员</h1>
        <ul>
         <li><a href="/lists/0"><strong>{{$count}}</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
     @if(request()->session()->get('userindex'))
     <b class="">欢迎，</b>
     {{session('userindex')->user_email}}
     @elseif(!request()->session()->get('userindex'))
      <li><a href="/login">登录</a></li>
      @endif
      <li><a href="/reg" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
     @foreach($goods_commen as $v)
      <img src="http://www.laupload.com/{{$v->goods_img}}" />
      @endforeach
     </div><!--sliderA/-->
     <ul class="pronav">
     @foreach($topcate as $v)
      <li><a href="/lists/{{$v->cate_id}}">{{$v->cate_name}}</a></li>
      @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
      <div class="index-pro1">
     @foreach($goods_hot as $v)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="/goods/{{$v->goods_id}}"><img src="http://www.laupload.com/{{$v->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="/goods/{{$v->goods_id}}">{{$v->goods_name}}</a></dd>
        <dd class="ip-price"><strong>{{$v->goods_sprice}}元</strong> </dd>
       </dl>
      </div>
      @endforeach
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     
     <div class="prolist">
     @foreach($goods_best as $v)
      <dl>
       <dt><a href="/goods/{{$v->goods_id}}"><img src="http://www.laupload.com/{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="/goods/{{$v->goods_id}}">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>{{$v->goods_sprice}}</strong> </div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="/lists/0">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car/index">
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
     </div>
     @endsection