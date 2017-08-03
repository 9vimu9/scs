@extends('layouts.app')

@section('head')
 <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}" >
@endsection

@section('content')

<?php
  $quotation_sub_total=0;
  if(count($sale->quotation->items)>0){
    foreach($sale->quotation->items as $quotation_item){
      $quotation_sub_total+=$quotation_item->pivot->total;
    }
    $quotation_sub_total=$sale->quotation->service_charge+$quotation_sub_total-($quotation_sub_total-$sale->quotation->advance)*$sale->quotation->discount/100;// NOTE: total price cal
  }
?>


<div class="container">
  {{ csrf_field() }}

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>sale <span class="label label-primary"><big>#{{$sale->id}}</big></span></big>
                &nbsp&nbsp&nbsp&nbsp
                for quotation : <strong class="text-info"><big><a href="/quotationitems/{{$sale->quotation->id}}">#{{$sale->quotation->id}}</a></big></strong>
                &nbsp&nbsp&nbsp&nbsp
                customer : <strong class="text-info"><big>{{$sale->quotation->customer->name}}</big></strong>

                <form action="/sales/{{$sale->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}
                    sale-discount+service charge : <span class="badge" id="sale_final_total"></span>

                    <a href="/reports/sale/{{$sale->id}}" class="btn btn-danger btn-xs">print</a>
                    <a href="/sales/{{$sale->id}}/edit" class="btn btn-warning btn-xs ">edit this sale</a>&nbsp&nbsp
                    <input type="submit" name="delete" value="delete this sale" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            </div>
            <div class="panel-body">
                {{-- {{die('fff'.count($sale->items))}} --}}
              {{-- {{die($sale_quotation)}} --}}
            @if(count($sale->quotation->items)>0)

                <table class="table table-bordered table-hover" id ="table" style="width: 100%" >
                    <thead>
                        <tr>
                            <th colspan="3" style="text-align: center" >item details</th>
                            <th colspan="2" style="text-align: center" ><big>quotation</big> &nbsp&nbsp    value:<span class="badge"><font size="4"> Rs.{{$quotation_sub_total}}</font></span></th>
                            <th colspan="3"style="text-align: center"><big>SALE ORDER</big> &nbsp&nbsp    value:<span class="badge" id="sale_tot"></span></th>
                        </tr>
                        <tr>
                            <th style="width: 20%">item name</th>
                            <th style="width: 10%">unit price</th>
                            <th style="width: 10%">stock</th>
                            <th style="width: 10%">total(Rs)</th>
                            <th style="width: 10%">amount(quotation)</th>
                            <th style="width: 10%">amount(sale)</th>
                            <th style="width: 12%">total(Rs)</th>
                            <th style="width: 10%"><button type="button"  id ="add_update_all"  class="btn btn-info btn-xs" >Add/Update all</button></th>
                        </tr>
                    </thead>
                    @foreach($sale->quotation->items as $sale_item)
                        <tr >
                            <?php
                                $quotation_item_id=0;
                                $quotation_item_amount=0;
                                $quotation_item_total=0;

                                if(count($sale->quotation->items)>0){
                                    foreach( $sale->quotation->items as $quotation_item){
                                        if($sale_item->pivot->item_id===$quotation_item->pivot->item_id){
                                            // {{-- mekata awwa kiyanne e quotation_item ekata adaalawa sale_item ekak thibe kiyana eka --}}
                                            // <td>badu atha</td>
                                            $quotation_item_id=$quotation_item->pivot->id;
                                            $quotation_item_amount=$quotation_item->pivot->amount;
                                            $quotation_item_total=$quotation_item->pivot->total;
                                        }
                                        else{
                                          //  $sale_item_amount=$quotation_item->pivot->amount;
                                            // <td>badu natha</td>
                                            // {{-- mekata awwa kiyanne e quotation_item eke me item_id elkata adaalawa item_reeive ekak thibe kiyana eka --}}
                                        }
                                    }
                                }
                                else{
                                    // {{-- mekata awwa kiyanne e order ekata adaalawa kisima item_reeive ekak naha kiyana eka --}}
                                    //<td>badu naaaaatha</td>
                                }
                            ?>
                            <td>{{$sale_item->name}}</td>
                            <td>{{$sale_item->pivot->price}}</td>
                            <td>get current quntity</td>
                            <td>{{$quotation_item_total}}</td>
                            <td>{{$quotation_item_amount}}</td>

                            <td><input  type="text" class="form-control" name="amount" value="{{$sale_item->amount}}"></td>
                            <td>{{$sale_item->total}}</td>
                              <td>
                                <button type="button"  id ="{{$sale_item->pivot->item_id}}"  class="add btn btn-primary btn-xs" name="sale_item_store" style="display:{{$quotation_item_id>0 ? "none" : "block"}};">Add</button>
                                <input type="hidden" id ="sale_item_{{$sale_item->pivot->item_id}}" value="{{$quotation_item_id}}">
                                <div id ="div_{{$sale_item->pivot->item_id}}" style="display:{{$quotation_item_id==0 ? "none" : "block"}};">
                                  <button type="button"  id ="{{$sale->id}}_{{$sale_item->pivot->item_id}}"  class="btn btn-warning btn-xs" name="sale_item_update" >Edit</button>
                                  <button type="button"  id ="{{$sale->id}}_{{$sale_item->pivot->item_id}}"  class="btn btn-danger btn-xs" name="sale_item_destroy" >Delete</button>
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
  sale_calculation();
  function sale_calculation(){
      var total = 0;
      var MyRows = $('table#table').find('tbody').find('tr');

      for (var i = 0; i < MyRows.length; i++) {
          var val=$(MyRows[i]).find('td:eq(5)').html();
          if(val.length>0){
              total += parseFloat(val);
          }
      }
      var discount={{$sale->discount}};
      var serviceCharge={{$sale->service_charge}};
      var advance={{$sale->advance}};
      var isFuneral={{$sale->quotation->sales_type}}// NOTE: 1 is funeral 0 is not
      var saleId={{$sale->id}};

      var sale_final_total=service_charge+total-(total-advance)*(discount)/100;
      $('#sale_final_total').html('<font size="5">Rs.'+sale_final_total+'</font>');
      $('#sale_tot').html('<font size="4">Rs.'+total+'</font>');
  }

  function validator(){
    var currentItemAmount=parseInt($(this).closest('tr').find('td:eq(2)').text());// NOTE: have to get current item amount in store
    var amount=parseInt($(this).closest('tr').find('input[name="amount"]').val());
    var unitPrice= parseFloat($(this).closest('tr').find('td:eq(1)').text());
    var halfDays=days-1;
    var itemTotalPrice;

    if(isFuneral==1 && halfDays>3){
      halfDays=3;
    }
    itemTotalPrice=(unitPrice+halfDays*(unitPrice/2))*amount;// NOTE: item total price calculation eaasy way

    if(amount<0 || currentItemAmount<amount){

       $(document).trigger("add-alerts", [
       {
           "message": "amount you enterd invalid",
           "priority": 'danger'
       }
       ]);

       $(this).focus();

      } else {
         $(this).closest('tr').find('td:eq(6)').text(itemTotalPrice);
         sale_calculation();
      }
  }

  var all_child_update=$('[name="sale_item_store"],[name="sale_item_update"]').click(function(){
      var clicked_button=$(this);
      var itemId=$(this).attr('id');


        $.ajax({
            type: 'post',
            url: '/'+$(this).attr('name'),
            data: {
                'id': $('#sale_item_'+itemId).val(),
                '_token': $('input[name=_token]').val(),
                'amount': $(this).closest('tr').find('input[name="amount"]').val(),
                'sale_id': saleId,
                'item_id': itemId
            },
            success: function(data) {

                  $(document).trigger("add-alerts", [
                   {
                   "message":'sucessfully updated',
                   "priority": 'success'
                   }
                   ]);
                   $('#sale_item_'+itemId).val(data.id);
                    if(clicked_button.attr('name')=="sale_item_store"){
                        clicked_button.hide();
                        $("#div_"+itemId).show();
                    }

            },
        });

      });

      $('#add_update_all').click(function(){
        all_child_update.click();
      });

      var all_child_destroy=$('[name="sale_item_destroy"]').click(function(){
          var clicked_button=$(this);

          var itemId=$(this).attr('id');
            $.ajax({
                type: 'post',
                url: '/'+$(this).attr('name'),
                data: {
                    'id': $('#sale_item_'+itemId).val(),
                      '_token': $('input[name=_token]').val()

                },
                success: function(data) {
                    if ((data.errors)) {
                        $(document).trigger("add-alerts", [
                       {
                       "message":"data not removed , please try again",
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

                      if(clicked_button.attr('name')=="item_sale_destroy"){

                        $("#"+itemId+".add").show();
                        $("#div_"+itemId).hide();
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
