
    <h2 align="center">添加竞猜球队</h2>
<form action="" align="center">
@csrf
   <p> <input type="text" name="f_name" /> VS <input type="text" name="f_sname" /></p>
   <p>
       结束竞猜时间：<input type="text" name="f_time" />
   </p>
    <p>
        <input type="button" value="添加" class="add" />
    </p>
</form>
<script type="text/javascript" src="/index/js/jquery.min.js"></script>
<script type="text/javascript">
    $('.add').click(function() {
        var f_name = $('[name="f_name"]').val();
        var f_sname = $('[name="f_sname"]').val();
        var f_time = $('[name="f_time"]').val();
        var _token= $('[name="_token"]').val();
        if (f_name==f_sname) {
            alert('两支球队名称不可相同');return false;
        };
        // alert(_token)
        $.post(
            "/football/add_do",
            {f_name:f_name,f_sname:f_sname,f_time:f_time,_token:_token},
            function(res){
                alert(res.msg);
                if (res.code==1) {
                    location.href="/football/list"
                };
            },
            'json'
        );
    });
</script>