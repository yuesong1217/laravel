<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<!-- <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" /> -->
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <script type="text/javascript" src="/admin/js/page.js" ></script> -->
</head>
<div class="page">
            <!-- user页面样式 -->
            <div class="connoisseur">
                <div class="conform">
                    <form action="{{url('admin/user/update/'.$data->crm_id)}}" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="cfD">

                            <input class="userinput" type="text" id="user" name="crm_user" placeholder="输入用户名" value="{{$data->crm_user}}" />&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
                            <input class="userinput vpr" type="password" id="pwd" name="crm_pwd" value="{{$data->crm_pwd}}"  placeholder="输入用户密码" />
                            <input type="file" class="userinput" id="file" name="headimg" />
                            <input type="hidden" name="oldimg" value="{{$data->headimg}}" />
                            
                            <button class="userbtn">修改</button>
                            <img src="http://www.laupload.com/{{$data->headimg}}" width="100" style="display:block;margin-left:600px;margin-top:10px" alt="" />
                        </div>

                    </form>
                    
                </div>