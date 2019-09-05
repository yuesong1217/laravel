<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<form action="{{route('save')}}" method="post" enctype="multipart/form-data">

    @csrf
    @if ($errors->any())     <div class="alert alert-danger">         <ul>             @foreach ($errors->all() as $error)                 <li>{{ $error }}</li>             @endforeach         </ul>     </div> @endif
    <p>
        网站名称：<input type="text" name="url_name" class="url_name" />
    </p>
    <p>
        网站网址：<input type="text" name="url_address" class="url_address" />
    </p>
    <p>
        链接类型：<input type="radio" name="url_type" value="1" checked />Logo链接
                  <input type="radio" name="url_type" value="2" />文字链接
    </p>
    <p>
        图片Logo：<input type="file"  name="url_logo" />
    </p>
    <p>
        网站联系人：<input type="text" name="url_friend" />
    </p>
    <p>
        网站介绍：<textarea name="url_desc" id="" cols="30" rows="10"></textarea>
    </p>
    <p>
        是否显示：<input type="radio" name="url_show" value="1" checked />是
                  <input type="radio" name="url_show" value="2" />否
    </p>
    <p>
        <button class="a">添加</button>
    </p>
</form>
<script type="text/javascript">
    $('.a').click(function() {
        // alert(123);
        var url_name=$('.url_name').val();
        var _token=$('[name="_token"]').val();
        var reg_name=/^\w{1,50}$/i
        var reg_address=/[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+\.?/
        // alert(url_name);
        var url_address=$('.url_address').val();
        if (url_name=='') {
            alert('网站名称不能为空！');return false;
        };
        if (url_address=='') {
            alert('网站地址不能为空！');return false;
        };
        if (!reg_name.test(url_name)) {
            alert('网站名称必须为字母、数字、下划线！');return false;
        };
        if (!reg_address.test(url_address)) {
            alert('网站地址必须为正确的url地址！');return false;
        };
        $.post(
            "{{route('save')}}",
            {url_name:url_name,url_address:url_address,_token:_token},
            function(res){
                alert(res.msg);
                if (res.code==0) {
                    // alert('用户名已存在');
                    
                };
            },
            'json'
        )
        // return false;
    });
</script>