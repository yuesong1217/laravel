<h2 align="center">比赛结果</h2>
<form action="/football/result_do/{{$data->f_id}}" align="center" method="post">
@csrf
    <p><input type="text" name="f_name" value="{{$data->f_name}}" />VS <input type="text" name="f_sname" value="{{$data->f_sname}}" /></p>
    <p><input type="radio" name="result" value="1" checked />胜
    <input type="radio" name="result" value="3" />平
    <input type="radio" name="result" value="2" />负</p>
    <button>提交</button>
</form>