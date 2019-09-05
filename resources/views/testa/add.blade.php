<form action="/test/add_do" method="post">
@csrf
    <p>
        文章标题：<input type="text" name="title" />
    </p>
    <p>
        文章关键字：<input type="text" name="key" />
    </p>
    <p>
        <button>确认添加</button>
    </p>
</form>