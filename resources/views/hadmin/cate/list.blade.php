@extends('layouts.hadmin')

@section('title')

@endsection

@section('content')
   <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<div  class="banShow">
<table  border="1" cellspacing="0" cellpadding="0" width="1000" align="center" height="300" style="margin-top:50px;">
      <colgroup>
        <col width="150">
        <col width="200">
        <col>
      </colgroup>
      <thead>
        <tr align="center">
          <th></th>
          <th>分类名称</th>
          <th>是否显示</th>
          <th>操作</th>
        </tr> 
      </thead>
      <tbody>

      @foreach($cate as $v)
        <tr pid="{{$v->pid}}" cid="{{$v->cate_id}}" align="center">
          <td><a class="arui" href="javascript:void(0);">+</a></td>
          <td>{{$v->cate_name}}</td>
          <td>@if($v->is_show==1)是@else否@endif</td>
          <td><a href="/hadmin/cate/edit/{{$v->cate_id}}"><img class="operation"
                                    src="/admin/img/update.png"></a> <a href="/hadmin/cate/delete/{{$v->cate_id}}"><img class="operation delban"
                                src="/admin/img/delete.png"></a></td>
        </tr>
      @endforeach
    </table>
    </div>
    <script type="text/javascript">
        $('tr:gt(0)').each(function(){
            var _this = $(this);
            var pid = _this.attr('pid');
            if (pid!=0) {
                _this.hide();
            };
        });

        $('.arui').click(function(){
            var _this = $(this);
            var aruiText = _this.text();
            if (aruiText=='+') {
                _this.text('-');
                var cid = _this.parents('tr').attr('cid');
                 $('tr').each(function(){
                    if ($(this).attr('pid')==cid) {
                    $(this).show();
                    };
                 })
            }else{
                _this.text('+');
                var cid = _this.parents('tr').attr('cid');
                hideTr(cid);
            }
       

        
    });

        function hideTr(cid){
            $('tr').each(function(){
                if ($(this).attr('pid')==cid) {
                    $(this).hide();

                    $(this).find('.arui').text('+');
                    hideTr($(this).attr('cid'));
                };
            })
        }
    </script>
@endsection