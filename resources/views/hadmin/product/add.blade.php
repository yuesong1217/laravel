@extends('layouts.hadmin')

@section('content')
<h3>货品添加</h3>
<form action="{{url('hadmin/product/add_do')}}" method="post">
<input type="hidden" name="goods_id" value="{{$goodsdata->goods_id}}" />
<table width="100%" id="table_list" class='table table-bordered'>
    <tbody>
    <tr>
      <th colspan="20" scope="col">商品名称：{{$goodsdata->goods_name}}&nbsp;&nbsp;&nbsp;&nbsp;货号：{{$goodsdata->sku_num}}</th>
    </tr>

    <tr>
      <!-- start for specifications -->
      @foreach($color as $k => $v)
      <td scope="col"><div align="center"><strong>{{$k}}</strong></div></td>
      @endforeach
      <!-- <td scope="col"><div align="center"><strong>颜色</strong></div></td> -->
            <!-- end for specifications -->
      <td class="label_2">货号</td>
      <td class="label_2">库存</td>
      <td class="label_2">&nbsp;</td>
    </tr>
    
    <tr id="attr_row">
    @foreach($color as $k => $v)
        <!-- start for specifications_value -->
        <td align="center" style="background-color: rgb(255, 255, 255);">
            <select name="attr_list[]">
                <option value="0" selected="">请选择...</option>
                @foreach($v as $key=>$value)
                <option value="{{$value['val_id']}}">{{$value['attr_val']}}</option>
                @endforeach
            </select>
        </td>
         @endforeach
        <!-- <td align="center" style="background-color: rgb(255, 255, 255);">
            <select name="attr[214][]">
                <option value="" selected="">请选择...</option>
                <option value="土豪金">土豪金</option>
                <option value="太空灰">太空灰</option>
            </select>
        </td> -->
        <!-- end for specifications_value -->
        <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_sn[]" value="" size="20"></td>
        <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_num[]" value="0" size="10"></td>
        <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button" value="+" ></td>
    </tr>

    <tr>
      <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
        <input type="submit" class="" value=" 添加 ">
      </td>
    </tr>
  </tbody>
</table>
</form>
<script type="text/javascript">
    $(document).on('click','.button',function() {
        // alert(1)
        var sign = $(this).val();
        // alert(sign)
        if (sign == "+") {
            // alert(1)
            $(this).val("-");
            var tr = $(this).parent().parent().clone();
            $(this).parent().parent().after(tr);
            $(this).val("+");
        }else{
            $(this).parent().parent().remove();
        }
    });

</script>
@endsection