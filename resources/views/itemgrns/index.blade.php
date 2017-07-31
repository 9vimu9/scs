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
            <div class="panel-heading"><big>GRN <span class="label label-primary"><big>#{{$order->grn->id}}</big></span></big>
                &nbsp&nbsp&nbsp&nbsp
                for order : <strong class="text-info"><big><a href="/itemorders/{{$order->id}}">#{{$order->id}}</a></big></strong>
                &nbsp&nbsp&nbsp&nbsp
                supplier : <strong class="text-info"><big>{{$order->supplier->name}}</big></strong>
                &nbsp&nbsp&nbsp&nbsp
                discount : <strong class="text-info"><big>{{$order->grn->discount>0 ? $order->grn->discount.'%' : "NO" }}</big></strong>

                <form action="/grns/{{$order->grn->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}
                      &nbsp&nbsp   GRN-discount : <span class="badge" id="final_tot"></span>

                    <a href="/reports/grn/{{$order->grn->id}}" class="btn btn-danger btn-xs">print</a>
                    <a href="/grns/{{$order->grn->id}}/edit" class="btn btn-warning btn-xs ">edit this GRN</a>&nbsp&nbsp
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
                            <th colspan="3"style="text-align: center"><big>GRN details</big> &nbsp&nbsp    value:<span class="badge" id="grn_tot"></span></th>
                        </tr>

                        <tr>
                            <th style="width: 20%">item name</th>
                            <th style="width: 10%">total(Rs)</th>
                            <th style="width: 10%">rate(Rs)</th>
                            <th style="width: 10%">ordered amount</th>
                            <th style="width: 10%">receved</th>
                            <th style="width: 12%">total(Rs)</th>
                            <th style="width: 10%"><button type="button"  id ="add_update_all"  class="btn btn-info btn-xs" >Add/Update all</button></th>
                        </tr>
                    </thead>

                    @foreach($order->items as $item_order)
                        <tr >
                            <td>{{$item_order->name}}</td>
                            <td>{{($item_order->pivot->amount)*($item_order->pivot->unit_price)}}</td>
                            <td>{{$item_order->pivot->unit_price}}</td>
                            <td>{{$item_order->pivot->amount}}</td>

                            <?php
                                $item_grn_id=0;
                                $item_grn_amount=0;
                                $item_grn_precentage=0;

                                if(count($order->grn->items)>0){
                                    foreach( $order->grn->items as $item_grn){
                                        if($item_grn->pivot->item_id===$item_order->pivot->item_id){
                                            // {{-- mekata awwa kiyanne e item_order ekata adaalawa item_reeive ekak thibe kiyana eka --}}
                                            // <td>badu atha</td>

                                            $item_grn_id=$item_grn->pivot->id;
                                            $item_grn_amount=$item_grn->pivot->amount;
                                            $item_grn_precentage=$item_grn->pivot->precentage;

                                        }
                                        else{
                                          //  $item_grn_amount=$item_order->pivot->amount;
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

                              <td><input  type="text" class="form-control" name="amount" value="{{$item_grn_amount}}"></td>
                              <td>{{$item_grn_amount*$item_order->pivot->unit_price}}</td>
                              <td>
                                <button type="button"  id ="{{$order->grn->id}}_{{$item_order->pivot->item_id}}"  class="add btn btn-primary btn-xs" name="item_grn_store" style="display:{{$item_grn_id>0 ? "none" : "block"}};">Add</button>
                                <input type="hidden" id ="item_grn_{{$order->grn->id}}_{{$item_order->pivot->item_id}}" value="{{$item_grn_id}}">
                                <div id ="div_{{$order->grn->id}}_{{$item_order->pivot->item_id}}" style="display:{{$item_grn_id==0 ? "none" : "block"}};">
                                  <button type="button"  id ="{{$order->grn->id}}_{{$item_order->pivot->item_id}}"  class="btn btn-warning btn-xs" name="item_grn_update" >Edit</button>
                                  <button type="button"  id ="{{$order->grn->id}}_{{$item_order->pivot->item_id}}"  class="btn btn-danger btn-xs" name="item_grn_destroy" >Delete</button>
                                </div>

                              </td>
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


  $('.form-control').keyup(validator).change(validator).blur(validator)
  grn_calculation();
  function grn_calculation(){
      var total = 0;
      var MyRows = $('table#table').find('tbody').find('tr');

      for (var i = 0; i < MyRows.length; i++) {
          var val=$(MyRows[i]).find('td:eq(5)').html();
          if(val.length>0){
              total += parseFloat(val);
          }
      }
      var discount={{$order->grn->discount}};
      var final_tot=total-total*(discount)/100;
      $('#final_tot').html('<font size="5">Rs.'+final_tot+'</font>');
      $('#grn_tot').html('<font size="4">Rs.'+total+'</font>');
  }

  function validator(){
    var ordered_amount=parseInt($(this).closest('tr').find('td:eq(3)').text());
    var amount=parseInt($(this).closest('tr').find('input[name="amount"]').val());
    var unit_price= $(this).closest('tr').find('td:eq(2)').text();
    var total=amount*unit_price;


    if(ordered_amount<amount){

       $(document).trigger("add-alerts", [
       {
           "message": "your amount larger than ordered amount",
           "priority": 'danger'
       }
       ]);

       $(this).focus();

     }else if(amount<0){

      $(document).trigger("add-alerts", [
         {
             "message": "amount cant be minus",
             "priority": 'danger'
         }
       ]);

       $(this).focus();

      } else {
         $(this).closest('tr').find('td:eq(5)').text(total);
         grn_calculation();
      }
  }

  var all_child_update=$('[name="item_grn_store"],[name="item_grn_update"]').click(function(){
      var clicked_button=$(this);
      var row_id=$(this).attr('id');
      var grn_id=row_id.split('_')[0];
      var item_id=row_id.split('_')[1];

        $.ajax({
            type: 'post',
            url: '/'+$(this).attr('name'),
            data: {
                'id': $('#item_grn_'+row_id).val(),
                '_token': $('input[name=_token]').val(),
                'amount': $(this).closest('tr').find('input[name="amount"]').val(),
                'grn_id': grn_id,
                'item_id': item_id
            },
            success: function(data) {

                  $(document).trigger("add-alerts", [
                   {
                   "message":'sucessfully updated',
                   "priority": 'success'
                   }
                   ]);
                   $('#item_grn_'+row_id).val(data.id);
                    if(clicked_button.attr('name')=="item_grn_store"){
                        clicked_button.hide();
                        $("#div_"+row_id).show();
                    }

            },
        });

      });

      $('#add_update_all').click(function(){
        all_child_update.click();
      });

      var all_child_destroy=$('[name="item_grn_destroy"]').click(function(){
          var clicked_button=$(this);

          var row_id=$(this).attr('id');

          var grn_id=row_id.split('_')[0];
          var item_id=row_id.split('_')[1];

            $.ajax({
                type: 'post',
                url: '/'+$(this).attr('name'),
                data: {
                    'id': $('#item_grn_'+row_id).val(),
                      '_token': $('input[name=_token]').val()

                },
                success: function(data) {
                    if ((data.errors)) {



                        $(document).trigger("add-alerts", [
                       {
                       "message":"data not removed well please try again",
                       "priority": 'danger'
                       }
                       ]);
                    } else {
                      $(document).trigger("add-alerts", [
                     {
                     "message":'sucessfully removed',
                     "priority": 'success'
                     }
                     ]);

                      if(clicked_button.attr('name')=="item_grn_destroy"){

                        $("#"+row_id+".add").show();
                        $("#div_"+row_id).hide();
                        clicked_button.closest('tr').find('input[name="amount"]').val(" ");

                    //    selected_span.toggle();
                      }
                    }
                },
            });

          });

});




</script>
@endsection
