<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<form action="/exam/update/{{$data->url_id}}" method="post" enctype="multipart/form-data">

    @csrf
    @if ($errors->any())     <div class="alert alert-danger">         <ul>             @foreach ($errors->all() as $error)                 <li>{{ $error }}</li>             @endforeach         </ul>     </div> @endif
    <p>
        网站名称：<input type="text" value="{{$data->url_name}}" name="url_name" class="url_name" />
    </p>
    <p>
        网站网址：<input type="text" value="{{$data->url_address}}" name="url_address" class="url_address" />
    </p>
    <p>
        链接类型：@if($data->url_type==1)<label> <input type="radio" checked  value="1" name="url_type" />LOGO链接</label> <label><input
                            type="radio" value="2" name="url_type" />文字链接</label>@else<label> <input type="radio" value="1" name="url_type" />LOGO链接</label> <label><input
                            type="radio" value="2" checked name="url_type" />文字链接</label>@endif
    </p>
    <p>
        图片Logo：<input type="file"  name="url_logo" /><img src="http://www.laupload.com/{{$data->url_logo}}" alt="" />
    </p>
    <p>
        网站联系人：<input type="text"  value="{{$data->url_friend}}" name="url_friend" />
    </p>
    <p>
        网站介绍：<textarea name="url_desc" id="" cols="30" rows="10">{{$data->url_desc}}</textarea>
    </p>
    <p>
        是否显示：@if($data->url_show==1)<label> <input type="radio" checked  value="1" name="url_show" />是</label> <label><input
                            type="radio" value="2" name="url_show" />否</label>@else<label> <input type="radio" value="1" name="url_show" />是</label> <label><input
                            type="radio" value="2" checked name="url_show" />否</label>@endif
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