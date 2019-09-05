<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
    <div id="pageAll">
        <div class="pageTop">
            <div class="page">
                <img src="/admin/img/coin02.png" /><span><a href="{{route('main')}}">首页</a>&nbsp;-&nbsp;<a
                    href="#">品牌管理</a>&nbsp;-</span>&nbsp;添加品牌
            </div>
        </div>
        <form action="{{url('admin/brand/update/'.$data->brand_id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="page ">
            <!-- 上传广告页面样式 -->
            <div class="banneradd bor">
                <div class="baTop">
                    <span>上传品牌</span>
                </div>
                <div class="baBody">
                    <div class="bbD">
                        品牌名称：<input type="text" value="{{$data->brand_name}}" class="input1" name="brand_name" />
                    </div>
                    <div class="bbD">
                        品牌Logo：
                        <div class="bbDd">
                            <div class="bbDImg">+</div>
                            <input type="file" class="file"  name="brand_logo" />
                            <img src="http://www.laupload.com/{{$data->brand_logo}}" alt="" />
                        </div>
                    </div>
                    <div class="bbD">
                        是否显示：@if($data->brand_show==1)<label> <input type="radio" checked  value="1" name="brand_show" />是</label> <label><input
                            type="radio" value="2" name="brand_show" />否</label>@else<label> <input type="radio" value="1" name="brand_show" />是</label> <label><input
                            type="radio" value="2" checked name="brand_show" />否</label>@endif
                    </div>
                    <div class="bbD">
                        <p class="bbDP">
                            <button class="btn_ok btn_yes" href="#">提交</button>
                            <a class="btn_ok btn_no" href="#">取消</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- 上传广告页面样式end -->
        </div>
    </div>
    </form>
</body>
</html>