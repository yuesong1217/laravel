<table border="1" width="1000" align="center">
    <tr>
        <td>ID</td>
        <td>文章标题</td>
        <td>文章关键字</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->title}}</td>
        <td>{{$v->key}}</td>
        <td><a href="/test/delete/{{$v->id}}">删除</a>
            <a href="/test/edit/{{$v->id}}">修改</a></td>
    </tr>
    @endforeach
</table>