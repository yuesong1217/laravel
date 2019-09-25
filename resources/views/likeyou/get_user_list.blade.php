<center>
<form action="/likeyou/createfans/{{$id}}" method="post">
<table align="center" width="500" border="1">
    <tr align="center">
        <td>选择</td>
        <td>用户openid</td>
        <td>昵称</td>
        <td>性别</td>
    </tr>
    @foreach($user as $k => $v)
    <tr align="center">
        <td><input type="checkbox" name="{{$k}}" value="{{$v['openid']}}" /></td>
        <td>{{$v['openid']}}</td>
        <td>{{$v['nickname']}}</td>
        <td>@if($v['sex']==1) 男 @else 女 @endif</td>
    </tr>
    @endforeach
</table>
<p></p>
<button>确认打标签</button>
</form>
</center>