<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
<!-- <link rel="stylesheet" type="text/css" href="/admin/css/css.css" /> -->
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
    <div id="pageAll">
        <div class="pageTop">
            <div class="page">
                <img src="/admin/img/coin02.png" /><span><a href="{{route('main')}}">首页</a>&nbsp;-&nbsp;<a
                    href="#">商品管理</a>&nbsp;-</span>&nbsp;添加商品
            </div>
        </div>
    <form action="/admin/goods/add_do" method="post" enctype="multipart/form-data">
        @csrf
        <p>
            商品名称：<input type="text" name="goods_name" />
        </p>
        <p>
            本店价格：<input type="text" name="goods_sprice" />
        </p>
        <p>
            商品分类：<select name="cate_id" id="">
            @foreach($cate as $v)
                <option value="{{$v->cate_id}}">{{str_repeat('--',$v->level*2)}}{{$v->cate_name}}</option>
            @endforeach
            </select>
        </p>
        <p>
            商品品牌：<select name="brand_id" id="">
            @foreach($brand as $v)
                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
            @endforeach
            </select>
        </p>
        <p>
            封面图片：<input type="file" name="goods_img" />
        </p>
        <p>
            是否上架：<input type="radio" name="goods_up" checked value="1" />是
                      <input type="radio" name="goods_up" value="2" />否
        </p>
        <p>
            是否新品：<input type="radio" name="goods_new" checked value="1" />是
                      <input type="radio" name="goods_new" value="2" />否
        </p>
        <p>
            是否热卖：<input type="radio" name="goods_hot" checked value="1" />是
                      <input type="radio" name="goods_hot" value="2" />否
        </p>
        <p>
            是否精品：<input type="radio" name="goods_best" checked value="1" />是
                      <input type="radio" name="goods_best" value="2" />否
        </p>
        <p>
            商品库存：<input type="number" name="goods_num" />
        </p>
        <p>
            商品积分：<input type="number" name="goods_score" />
        </p>
        <p>
            商品简介：<textarea name="goods_desc" id="" cols="30" rows="10"></textarea>
        </p>
        <p>
            <button>确认添加</button>
        </p>
    </form>
</body>
</html>