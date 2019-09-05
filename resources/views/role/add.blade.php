<form action="/role/add_do" method="post" enctype="multipart/form-data">
    @csrf
    <p>
        货物名称：<input type="text" name="hname" />
    </p>
    <p>
        货物图片：<input type="file" name="hpic" />
    </p>
    <p>
        货物数量：<input type="text" name="hnum" />
    </p>
    <p>
        <button>添加</button>
    </p>
</form>