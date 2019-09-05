<a href="javascript:;" class="show">显示离校学生</a>
<table align="center" width="700" border="1" class="a"> 
    <tr align="center">
        <td>ID</td>
        <td>姓名</td>
        <td>年龄</td>
        <td>住址</td>
        <td>学生状态</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr align="center">
        <td>{{$v->s_id}}</td>
        <td>{{$v->s_name}}</td>
        <td>{{$v->s_age}}</td>
        <td>{{$v->s_address}}</td>
        <td>@if($v->s_status==0)在校 @else离校 @endif</td>
        <td><a href="/student/delete/{{$v->s_id}}">删除</a>
            <a href="/student/edit/{{$v->s_id}}">修改</a></td>
    </tr>
    @endforeach
</table>
<table align="center" width="700" border="1" class="b" style="display:none;"> 
    <tr align="center">
        <td>ID</td>
        <td>姓名</td>
        <td>年龄</td>
        <td>住址</td>
        <td>学生状态</td>
        <td>操作</td>
    </tr>
    @foreach($datas as $v)
    <tr align="center">
        <td>{{$v->s_id}}</td>
        <td>{{$v->s_name}}</td>
        <td>{{$v->s_age}}</td>
        <td>{{$v->s_address}}</td>
        <td>@if($v->s_status==0)在校 @else离校 @endif</td>
        <td></td>
    </tr>
    @endforeach
</table>

<script type="text/javascript" src="/index/js/jquery.min.js"></script>
<script type="text/javascript">
    
    $('.show').click(function() {
        // alert(1)
        var a = $(this).text();
        if (a=='显示离校学生') {
            $(this).text('显示在校学生');
            $('.a').hide();
            $('.b').show();
        }else{
            $(this).text('显示离校学生');
            $('.b').hide();
            $('.a').show();
        }
    });
</script>