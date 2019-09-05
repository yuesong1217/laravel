
@if(request()->session()->get('userarticle'))
            <a class="p1">欢迎，</a><b>{{session('userarticle')->u_name}}</b>

            <p>
                <a href="javascript:;" class="logout">退出</a>
            </p>
        @else
        <p>
            <a href="javascript:;" class="login">登录</a>
        </p>
        @endif
        <form>@csrf</form>

<table align="center" width="1000" border="1">
    <tr align="center">
        <td>文章ID</td>
        <td>文章标题</td>
        <td>文章作者</td>
        <td>添加时间</td>
        <td>点赞数量</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr align="center">
        <td>{{$v->a_id}}</td>
        <td>{{$v->a_title}}</td>
        <td>{{$v->a_author}}</td>
        <td><?php echo date("Y-m-d H:i:s",$v->a_time); ?></td>
        <td class="count">{{$v->count}}</td>
        <td><a href="javascript:;"  a_id="{{$v->a_id}}" class="like">点赞</a></td>
    </tr>
    @endforeach
</table>
<script type="text/javascript" src="/index/js/jquery.min.js"></script>
<script type="text/javascript">
    $('.login').click(function() {
        // alert(1)
        location.href="/article/login";
    });
    $('.logout').click(function() {
        location.href="/article/logout";
    });
    $('.like').click(function() {
        var like = $(this).text();
        var a_id = $(this).attr('a_id');
        var _token=$("[name='_token']").val();
        var u_id = {{session('userarticle')->u_id}};
        $.post(
            "/article/likes",
            {a_id:a_id,_token:_token,u_id:u_id},
            function(res){
                alert(res.msg);
                if (res.code==0) {
                    location.href="/article/login";
                };
                if (res.code==1) {
                    $('.a').text('取消点赞');
                    $('.count').text(res.count);
                };
            },
            'json'
        );
        
    });
</script>