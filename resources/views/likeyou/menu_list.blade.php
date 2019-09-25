<table border="1" align="center" width="500">
    <tr>
        <td>一级菜单</td>
        <td>二级菜单</td>
        <td>操作</td>
    </tr>
    @foreach($info as $v)
    <tr>
        <td>{{$v->name1}}</td>
        <td>{{$v->name2}}</td>
        <td><a href="delete_menu/{{$v->id}}">删除</a></td>
    </tr>
    @endforeach
</table>