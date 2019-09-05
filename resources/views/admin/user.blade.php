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

<body>

	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="">首页</a>&nbsp;-&nbsp;-</span>&nbsp;管理员管理
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form action="{{route('user_do')}}" method="post" enctype="multipart/form-data">

                        @csrf
						<div class="cfD">
						@if ($errors->any())     <div class="alert alert-danger">         <ul>             @foreach ($errors->all() as $error)                 <li>{{ $error }}</li>             @endforeach         </ul>     </div> @endif

							<input class="userinput" type="text" id="user" name="crm_user" placeholder="输入用户名" />&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
							<input class="userinput vpr" type="password" id="pwd" name="crm_pwd" placeholder="输入用户密码" />
							<input type="file" class="userinput" id="file" name="headimg" />
							<button class="userbtn">添加</button>
						</div>


					</form>
					
				</div>
				<script>
					// $('.userbtn').click(function(){
					//     event.preventDefault();

					// 	var user=$('[name="user"]').val();
					// 	if(user==''){
					// 	    alert('用户名不能为空');return;
     //                    }
     //                    var pwd=$('[name="pwd"]').val();
     //                    if (pwd==''){
     //                        alert('密码不能为空');return;
     //                    }
     //                    var _token=$('[name="_token"]').val();
     //                    var headimg=$('[name="headimg"]').val();
     //                    alert(headimg)
					// 	$.post(
					// 			"{{route('user_do')}}",
					// 			{user:user,pwd:pwd,_token:_token,headimg:headimg},
					// 			function(res){
					// 			    alert(res.msg);
					// 				if (res.code==1){
     //                                    window.location.reload();
     //                                }
					// 			},
					// 			'json'
					// 	);
					// });
				</script>
				<!-- user 表格 显示 -->

				<div class="conShow">
				<form action="" method="get">
						<input type="text" name="crm_user" value="{{$crm_user}}" /><button>搜索</button>
					</form>
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="400px" class="tdColor">用户名</td>
							<td width="630px" class="tdColor">添加时间</td>
							<td class="tdColor">用户头像</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
                        @foreach ($data as $v)
                        <tr height="40px">
							<td>{{$v->crm_id}}</td>
							<td>{{$v->crm_user}}</td>
							<td>{{date('Y-m-d H:i:s',$v->crm_time)}}</td>
							<td><img width="100" src="http://www.laupload.com/{{$v->headimg}}" alt="" /></td>
							<td><a href="{{url('admin/user/edit/'.$v->crm_id)}}"><img class="operation"
									src="/admin/img/update.png"></a> <a  href="{{url('admin/user/delete/'.$v->crm_id)}}"><img class="operation delban"
								src="/admin/img/delete.png"></a></td>
						</tr>
                            @endforeach
					</table>
					<div>{{ $data->appends($search)->links() }}</div>
				</div>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="/admin/img/shanchu.png" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a href="#" class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
// 广告弹出框
// $(".delban").click(function(){
//   $(".banDel").show();
// });
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end
</script>
</html>