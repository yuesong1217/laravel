<h2 align="center">竞猜结果</h2>
<h3 align="center">对阵结果：
@if($data->result==3)
{{$data->f_name}}平{{$data->f_sname}} 
@elseif($data->result==1)
{{$data->f_name}}胜{{$data->f_sname}} 
@else
{{$data->f_name}}负{{$data->f_sname}}
@endif
</h3>
<h3 align="center">您的竞猜：
@if($data->f_result==3)
{{$data->f_name}}平{{$data->f_sname}} 
@elseif($data->f_result==1)
{{$data->f_name}}胜{{$data->f_sname}} 
@else
{{$data->f_name}}负{{$data->f_sname}}
@endif
</h3>
<h3 align="center">结果：
    @if($data->f_result==$data->result)
    恭喜您，猜中了！
    @else
    很遗憾，没猜中！
    @endif
</h3>