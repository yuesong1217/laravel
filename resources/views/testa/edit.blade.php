<form action="/test/update/{{$data->id}}" method="post">
@csrf
    <p>
        文章标题：<input type="text" name="title" value="{{$data->title}}" />
    </p>
    <p>
        文章关键字：<input type="text" name="key" value="{{$data->key}}" />
    </p>
    <p>
        <button>确认修改</button>
    </p>
</form>