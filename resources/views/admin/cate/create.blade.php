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
                    href="#">分类管理</a>&nbsp;-</span>&nbsp;添加分类
            </div>
        </div>
        <form action="/admin/cate/save" method="post" enctype="multipart/form-data">
        @csrf
        <div class="page ">

            <!-- 上传广告页面样式 -->
            <div class="banneradd bor">
                <div class="baTop">
                    <span>上传分类</span>
                </div>
                <div class="baBody">
                    <div class="bbD">
                        分类名称：<input type="text" class="input1" name="cate_name" />
                        @php echo($errors->first('cate_name')); @endphp
                    </div>
                    <div class="bbD">
                        分类等级：<select class="input3" name="pid">
                        <option value="0">顶级分类</option>
                        @foreach($data as $v)
                        <option value="{{$v->cate_id}}">{{str_repeat('--',$v->level*2)}}{{$v->cate_name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="bbD">
                        是否显示：<label><input type="radio" checked="checked" value="1" name="cate_show" />是</label> <label><input
                            type="radio" value="2" name="cate_show" />否</label>
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