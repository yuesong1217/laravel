<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告-有点</title>
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="/admin/js/page.js" ></script> -->
</head>

<body>
    <div id="pageAll">
        <div class="pageTop">
            <div class="page">
                <img src="/admin/img/coin02.png" /><span><a href="{{route('main')}}">首页</a>&nbsp;-&nbsp;<a
                    href="#">品牌管理</a>&nbsp;-</span>&nbsp;品牌列表
            </div>
        </div>
        <div class="page">
            <!-- banner页面样式 -->
            <div class="banner">
                <div class="add">
                    <a class="addA" href="{{route('create')}}">上传网站链接&nbsp;&nbsp;+</a>
                </div>
                <!-- banner 表格 显示 -->
                <form action="" method="">
                    <input type="text" name="url_name" value="{{$url_name}}" /><button>搜索</button>
                </form>
                <div class="banShow">
                    <table border="1" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="315px" class="tdColor">图片Logo</td>
                            <td width="308px" class="tdColor">网站名称</td>
                            <td width="215px" class="tdColor">是否显示</td>
                            <td width="180px" class="tdColor">链接类型</td>
                            <td width="125px" class="tdColor">操作</td>
                        </tr>
                        @foreach($data as $v)
                        <tr>
                            <td><div class="bsImg">
                                    <img src="http://www.laupload.com/{{$v->url_logo}}">
                                </div></td>
                            <td>{{$v->url_name}}</td>
                            <td>@if($v->url_show==1)是 @else否 @endif</td>
                            <td>@if($v->url_type==1)LOGO链接 @else文字链接 @endif</td>
                            <td><a href="/exam/edit/{{$v->url_id}}">修改</a> <a href="/exam/delete/{{$v->url_id}}" class="a" url_id="{{$v->url_id}}">删除</a></td>
                        </tr>
                        @endforeach
                    </table>
                    <script type="text/javascript">
                        $('.a').click(function() {
                            var url_id=$(this).attr('url_id');
                            // alert(url_id)
                            $.post(
                                "/exam/delete/"+url_id,
                                // {url_id:url_id},
                                function(res){
                                    alert(res.msg);
                                    if (res.code==1) {
                                        // location.href="/exam/index";
                                    };
                                },
                                'json'
                            )
                            // alert(url_id);
                        });
                    </script>
                    <div class="paging">{{$data->appends($url_name)->links()}}</div>
                </div>
                <!-- banner 表格 显示 end-->
            </div>
            <!-- banner页面样式end -->
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
                <a href="#" class="ok yes" onclick="del()">确定</a><a class="ok no">取消</a>
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

function del(){
    var input=document.getElementsByName("check[]");
    for(var i=input.length-1; i>=0;i--){
       if(input[i].checked==true){
           //获取td节点
           var td=input[i].parentNode;
          //获取tr节点
          var tr=td.parentNode;
          //获取table
          var table=tr.parentNode;
          //移除子节点
          table.removeChild(tr);
        }
    }     
}
</script>
</html>