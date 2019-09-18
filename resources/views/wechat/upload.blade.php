<center>
<form action="/wechat/upload_do" method="post" enctype="multipart/form-data">
    @csrf
    <p>类型：
    <select name="type" id="">
        <option value="image">图片</option>
        <option value="video">视频</option>
        <option value="voice">语音</option>
        <option value="thumb">缩略图</option>
    </select>
    </p>
    <p>
        <input type="file" name="file_name" />
    </p>
    <p>
        <button>确认上传</button>
    </p>
    
</form>
</center>