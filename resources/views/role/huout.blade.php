<form action="/role/huout_do" method="post" enctype="multipart/form-data">
    @csrf
    <p>
        货物名称：<input type="text" name="hname" value="{{$data->hname}}" />
    </p>
    <p>
        货物数量：<input type="text" name="hnum" />
    </p>
    <p>
        <input type="button" value="确认出库" class="huout" />
    </p>
</form>
<script type="text/javascript" src="/index/js/jquery.min.js"></script>
<script type="text/javascript">
    $('.huout').click(function() {
        var hname = $('[name="hname"]').val();
        var hnum  = $('[name="hnum"]').val();
        var _token= $('[name="_token"]').val();
        var hid = {{$data->hid}};
        $.post(
            "/role/huout_do",
            {hname:hname,hid:hid,hnum:hnum,_token:_token},
            function(res){
                alert(res.msg);
                if (res.code==1) {
                    location.href="/role/list";
                };
            },
            'json'
        );
    });
</script>