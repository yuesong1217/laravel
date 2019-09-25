<h2 align="center">创建菜单</h2>
<center>
<form action="{{url('likeyou/menu_do')}}" method="post" align="center">  
@csrf
    <p>
        一级菜单：<input type="text" name="name1" />
    </p>
    <p>
        二级菜单：<input type="text" name="name2" />
    </p>
    <p>
        事件类型：<select name="type" id="">
            <option value="1">click</option>
            <option value="2">view</option>
        </select>
    </p>
    <p>
        事件值：<input type="text" name="event_value" />
    </p>
    <p>
        <button>添加</button>
    </p>
</form>
</center>