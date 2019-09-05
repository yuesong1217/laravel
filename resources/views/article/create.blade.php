<form action="/article/save" method="post">
@csrf
    <p>
        文章标题：<input type="text" name="a_title" />
    </p>
    <p>
        文章作者：<input type="text" name="a_author" />
    </p>
    <p>
        文章内容：<textarea name="a_desc" id="" cols="30" rows="10"></textarea>
    </p>
    <p>
        <button>确认添加</button>
    </p>
</form>