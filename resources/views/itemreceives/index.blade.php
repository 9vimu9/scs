@extends('layouts.app')

@section('head')


 <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}" >

@endsection

@section('content')

<?php $sub_tot=0;?>
@if(count($order->item_order)>0)
    @foreach($order->items as $item_order)
        <?php
            $sub_tot+=$item_order->pivot->amount*$item_order->pivot->unit_price;
        ?>
    @endforeach
@endif



<div class="container">
  {{ csrf_field() }}

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>GRN <span class="label label-primary"><big>#{{$order->receive->id}}</big></span></big>
                &nbsp&nbsp&nbsp&nbsp
                for order : <strong class="text-info"><big><a href="/itemorders/{{$order->id}}">#{{$order->id}}</a></big></strong>
                &nbsp&nbsp&nbsp&nbsp
                supplier : <strong class="text-info"><big>{{$order->supplier->name}}</big></strong>
                &nbsp&nbsp&nbsp&nbsp
                discount : <strong class="text-info"><big>{{$order->receive->discount>0 ? $order->receive->discount.'%' : "NO" }}</big></strong>
                &nbsp&nbsp&nbsp&nbsp
                VAT included ?  <strong class="text-info"><big>{{$order->receive->vat>0 ? "YES(".$order->receive->vat."%)" : "NO" }}</big></strong>
                <form action="/receives/{{$order->receive->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}
                      &nbsp&nbsp   GRN+VAT-discount : <span class="badge" id="final_tot"></span>

                    <a href="/reports/grn/{{$order->receive->id}}" class="btn btn-danger btn-xs">print</a>
                    <a href="/receives/{{$order->receive->id}}/edit" class="btn btn-warning btn-xs ">edit this GRN</a>&nbsp&nbsp
                    <input type="submit" name="delete" value="delete this GRN" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>


            </div>
            <div class="panel-body">


            @if(count($order->item_order)>0)
                <table class="table table-bordered table-hover" id ="table" style="width: 100%" >
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align: center" ><big>ordered items details</big> &nbsp&nbsp    value:<span class="badge"><font size="4"> Rs.{{$sub_tot}}</font></span></th>
                            <th colspan="7"style="text-align: center"><big>GRN details</big> &nbsp&nbsp    value:<span class="badge" id="grn_tot"></span></th>
                        </tr>

                        <tr>
                            <th style="width: 20%">item name</th>
                            <th style="width: 10%">total(Rs)</th>
                            <th style="width: 10%">rate(Rs)</th>
                            <th style="width: 10%">amount</th>

                            <th style="width: 10%">received amount</th>
                            <th style="width: 10%">rejected amount</th>
                            <th style="width: 10%">actual amount</th>
                            <th style="width: 15%">total(Rs)</th>
                            <th style="width: 12%"><button type="button"  id ="add_update_all"  class="btn btn-info btn-xs" >Add/Update all</button></th>
                        </tr>
                    </thead>


                        <?php $counter_for_checkboxes=0;?>

                    @foreach($order->items as $item_order)



                        <tr >
                            <td>{{$item_order->name}}</td>
                            <td>{{($item_order->pivot->amount)*($item_order->pivot->unit_price)}}</td>
                            <td>{{$item_order->pivot->unit_price}}</td>
                            <td>{{$item_order->pivot->amount}}</td>

                            <?php


                                $item_receive_id=0;
                                $item_receive_amount=0;
                                $item_receive_reject=0;
                                $item_receive_precentage=0;


                                if(count($order->receive->items)>0){

                                    foreach( $order->receive->items as $item_receive){
                                        if($item_receive->pivot->item_id===$item_order->pivot->item_id){
                                            // {{-- mekata awwa kiyanne e item_order ekata adaalawa item_reeive ekak thibe kiyana eka --}}
                                            // <td>badu atha</td>

                                            $item_receive_id=$item_receive->pivot->id;
                                            $item_receive_amount=$item_receive->pivot->amount;
                                            $item_receive_reject=$item_receive->pivot->rejected;
                                            $item_receive_precentage=$item_receive->pivot->precentage;

                                        }
                                        else{
                                            // <td>badu natha</td>
                                            // {{-- mekata awwa kiyanne e item_order eke me item_id elkata adaalawa item_reeive ekak thibe kiyana eka --}}

                                        }
                                    }
                                }
                                else{
                                    // {{-- mekata awwa kiyanne e order ekata adaalawa kisima item_reeive ekak naha kiyana eka --}}
                                    //<td>badu naaaaatha</td>

                                }
                            ?>

                            @if($item_receive_id===0)

                              {{ csrf_field() }}
                              <td><input id="amount_{{++$counter_for_checkboxes}}" type="text" class="form-control input-sm" name="amount" value="{{$item_order->pivot->amount}}"></td>
                              <td><input id="rejected_{{$counter_for_checkboxes}}" type="text" class="form-control input-sm" name="rejected" value="0"></td>
                              <td></td>
                              <td></td>
                              <td>
                                   <button type="button"  id ="{{$order->receive->id}}_{{$item_order->pivot->item_id}}"  class="btn btn-primary btn-xs" name="store">Add</button>
                              </td>
                            @else
                              <td><input id="amount_{{++$counter_for_checkboxes}}" type="text" class="form-control" name="amount" value="{{$item_receive_amount}}"></td>
                              <td><input id="rejected_{{$counter_for_checkboxes}}" type="text" class="form-control" name="rejected" value="{{$item_receive_reject}}"></td>
                              <td>{{$item_receive_amount-$item_receive_reject}}</td>
                              <td>{{($item_receive_amount-$item_receive_reject)*$item_order->pivot->unit_price}}</td>
                              <td>
                                <button type="button"  id ="{{$order->receive->id}}_{{$item_order->pivot->item_id}}"  class="btn btn-warning btn-xs" name="update">Edit</button>
                                <button type="button"  id ="{{$order->receive->id}}_{{$item_order->pivot->item_id}}"  class="btn btn-danger btn-xs" name="destroy">Delte</button>

                              </td>

                            @endif


                        </tr>
                    @endforeach

                </table>


            @else
               no items
            @endif

            </div>



        </div>
    </div>

</div>


@endsection

@section('script')
@include('layouts.suggest')
<script>

$(document).ready(function(){


  var d=$('.form-control').keyup(validator).change(validator)
  d.change();

  function grn_calculation(){

      var total = 0;
      var MyRows = $('table#table').find('tbody').find('tr');

      for (var i = 0; i < MyRows.length; i++) {
          var val=$(MyRows[i]).find('td:eq(7)').html();
          if(val.length>0){
              total += parseFloat(val);
          }
          console.log(val);
      }
      var vat={{$order->receive->vat}};
      var discount={{$order->receive->discount}};
      var final_tot=total+total*(vat-discount)/100;
      $('#final_tot').html('<font size="5">Rs.'+final_tot+'</font>');
      $('#grn_tot').html('<font size="4">Rs.'+total+'</font>');
  }

  function validator(){
    var ordered_amount=$(this).closest('tr').find('td:eq(3)').text();
    var amount=$(this).closest('tr').find('input[name="amount"]').val();
    var rejected=$(this).closest('tr').find('input[name="rejected"]').val();

    var actual_amount=amount-rejected;
    var unit_price= $(this).closest('tr').find('td:eq(2)').text();
    var total=actual_amount*unit_price;


    if(ordered_amount<amount){

       $(document).trigger("add-alerts", [
       {
           "message": "your amount larger than ordered amount",
           "priority": 'danger'
       }
       ]);
       $(this).val(" ");
       $(this).focus();

     } else if(amount-rejected<0){

        $(document).trigger("add-alerts", [
           {
               "message": "your received amount smaller than rejected amount",
               "priority": 'danger'
           }
         ]);
         $(this).val(" ");
         $(this).focus();

       } else {

     $(this).closest('tr').find('td:eq(6)').text(actual_amount);
     $(this).closest('tr').find('td:eq(7)').text(total);
     grn_calculation();
    }
  }



  var all_child_store=$('[name="store"]').click(function(){
    var receive_id=$(this).attr('id').split('_')[0];
    var item_id=$(this).attr('id').split('_')[1];
      $.ajax({
          type: 'post',
          url: '/item_receive_store',
          data: {
              '_token': $('input[name=_token]').val(),
              'amount': $(this).closest('tr').find('input[name="amount"]').val(),
              'rejected': $(this).closest('tr').find('input[name="rejected"]').val(),
              'receive_id': receive_id,
              'item_id': item_id
          },
          success: function(data) {
              if ((data.errors)) {



                  $(document).trigger("add-alerts", [
                 {
                 "message":data.errors.rejected+"<br>"+data.errors.amount,
                 "priority": 'danger'
                 }
                 ]);
              } else {
                $(document).trigger("add-alerts", [
               {
               "message":'sucessfully updated',
               "priority": 'success'
               }
               ]);
              }
          },
      });

    });

});




</script>
@endsection
