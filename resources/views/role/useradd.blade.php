<form action="/role/useradd_do" method="post">
@csrf
    <p>
        用户名：<input type="text" name="uname" />
    </p>
    <p>
        密码：<input type="password" name="upwd" />
    </p>
    <p>
        用户身份：<select name="pid" id="">
            <option value="主管">主管</option>
            <option value="库管员">库管员</option>
        </select>
    </p>
    <button>添加</button>
</form>