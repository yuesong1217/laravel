<a href="/role/list">货物管理</a><br />
<a href="/role/userlist">用户管理</a>
<table align="center" width="700">
    <tr align="center">
        <td>用户ID</td>
        <td>货物ID</td>
        <td>操作时间</td>
        <td>操作类型</td>
    </tr>
    @foreach($data as $v)
    <tr align="center">
        <td>{{$v->uid}}</td>
        <td>{{$v->hid}}</td>
        <td><?php echo date("Y-m-d H:i:s",$v->time); ?></td>
        <td>{{$v->type}}</td>
    </tr>
    @endforeach
</table>