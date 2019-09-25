<table align="center" width="500" border="1"> 
    <tr align="center">
        <td>标签ID</td>
        <td>标签名</td>
        <td>操作</td>
    </tr>
    @foreach($tag as $v)
    <tr align="center">
        <td>{{$v['id']}}</td>
        <td>{{$v['name']}}</td>
        <td><a href="/likeyou/get_user_list/{{$v['id']}}">打标签</a>
            <a href="/likeyou/sendmsg/{{$v['id']}}">群发消息</a></td>
    </tr>
    @endforeach
</table>