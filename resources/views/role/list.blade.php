
<a href="/role/add">货物添加</a><br />
<a href="/role/guanli">出入库管理</a><br />
<a href="/role/userlist">用户管理</a>
<table align="center" width="700">
    <tr align="center">
        <td>ID</td>
        <td>货物名称</td>
        <td>货物图片</td>
        <td>当前库存</td>
        <td>入库时间</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr align="center">
        <td>{{$v->hid}}</td>
        <td>{{$v->hname}}</td>
        <td><img src="http://www.laupload.com/{{$v->hpic}}" width="100" alt="" /></td>
        <td>{{$v->hnum}}</td>
        <td><?php echo date("Y-m-d H:i:s",$v->htime); ?></td>
        <td><a href="/role/huout/{{$v->hid}}">出库</a></td>
    </tr>
    @endforeach
</table>