<!DOCTYPE html>
<html align="center">
<head>
    <title>菜单列表</title>
</head>
<body >
    <h2>创建菜单</h2>
    <form action="{{url('/agent/create_menu')}}" method="post" >
        <table border="1" align="center" >
        @csrf   
        <tr>
            <td>一级菜单名称</td>
            <td><input type="text" name="name1"></td>
        </tr>   
        <tr>
            <td>二级菜单名称</td>
            <td><input type="text" name="name2"></td>
        </tr>
        <tr>
            <td>菜单类型[click/view]</td>
            <td>
                <select name="type" id="">
                    <option value="1">click</option>
                    <option value="2">view</option>
                </select><br></td>
        </tr>
        <tr>
            <td>事件值</td>
            <td><input type="text" name="event_value"></td>
        </tr>
        <tr>
            <td><input type="submit" value="提交"></td>
        </tr>
        
    </table>
    </form>


    <h2>菜单列表</h2>
      <table border="1" align="center">
        <tr>
            <td>name1</td>
            <td>name2</td>
            <td>操作</td>
        </tr>
        @foreach($info as $v)
        <tr>
            <td>{{$v->name1}}</td>
            <td>{{$v->name2}}</td>
            <td><a href="{{url('agent/del_menu')}}?id={{$v->id}}">删除</a></td>
        </tr>
            @endforeach
    </table>
</body>
</html>