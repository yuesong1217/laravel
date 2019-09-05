<form action="/student/add_do" method="post">
@csrf
    <p>
        姓名：<input type="text" name="s_name"  />
    </p>
    <p>
        年龄：<select name="s_age" id="">
            @for ($i=18; $i <= 28; $i++) { 
                <option value="{{$i}}">{{$i}}</option>';
            }
            @endfor
            
        </select>
    </p>
    <p>
        住址：<select name="s_address" id="">
            <option value="朝阳">朝阳</option>
            <option value="海淀">海淀</option>
            <option value="昌平">昌平</option>
            <option value="房山">房山</option>
        </select>
    </p>
    <p>
        学生状态：<input type="radio" checked name="s_status" value="0" />在校
                  <input type="radio" name="s_status" value="1" />离校
    </p>
    <p>
        <button>确认添加</button>
    </p>
</form>