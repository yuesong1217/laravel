<h2 align="center">竞猜列表</h2>
<form action="">
    @csrf
</form>
<table align="center" width="700" >
    <tr align="center">
        <td>ID</td>
        <td>球队名称</td>
        <td></td>
        <td>球队名称</td>
        <td>竞猜 </td>
        <td>比赛结果</td>
    </tr>
    @foreach($data as $v)
    <tr align="center">
        <td>{{$v->f_id}}</td>
        <td>{{$v->f_name}}</td>
        <td>VS</td>
        <td>{{$v->f_sname}}</td>
        <td><?php if (time() >= $v->f_time){ ?>
            <a href="/football/lookresult/{{$v->f_id}}" class="lookresult">查看结果</a>
           <?php }else if($v->f_result){ ?>
            <a href="/football/lookresult/{{$v->f_id}}" class="lookresult">查看结果</a>
           <?php }else{ ?>
            <a class="guess" href="/football/guess/{{$v->f_id}}">竞猜</a>
           <?php } ?>
        </td>
        <td><a class="result" href="/football/result/{{$v->f_id}}">设置比赛结果</a></td>
    </tr>
    @endforeach
</table>
<script type="text/javascript" src="/index/js/jquery.min.js"></script>
<script type="text/javascript">
    // $('.guess').click(function() {
    //     // alert(1)
    //     var f_id = $(this).attr('f_id');
    //     // alert(f_id)
    //     var guess = $(this).text();
    //     var _token = $('[name="_token"]').val();
    //     $.post(
    //         "/football/guess",
    //         {f_id:f_id,_token:_token},
    //         function(res){

    //         },
    //         'json'
    //     );
    // });
</script>