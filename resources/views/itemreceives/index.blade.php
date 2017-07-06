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


    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE GRN <span class="label label-primary"><big>#{{$order->receive->id}}</big></span></big>
                &nbsp&nbsp    
                for order : <strong class="text-info"><big><a href="/itemorders/{{$order->id}}">#{{$order->id}}</a></big></strong>
                &nbsp&nbsp&nbsp&nbsp
                <font size="2">order value: </font><font size="3"> <span class="badge">Rs.{{$sub_tot}}</span></font>&nbsp&nbsp
                supplier : <strong class="text-info"><big>{{$order->supplier->name}}</big></strong>
                <form action="/receives/{{$order->receive->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}
                   
                <font size="3">grn value : </font> <span class="badge" id="grn_tot"><font size="5">Rs.1234</font></span>&nbsp&nbsp
                  &nbsp&nbsp
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
                            <th colspan="4" style="text-align: center" ><big>ordered items details</big></th>
                            <th colspan="7"style="text-align: center"><big>GRN details</big></th>
                        </tr>

                        <tr>
                            <th style="width: 15%">item name</th>
                            <th style="width: 8%">total(Rs)</th>
                            <th style="width: 6%">rate(Rs)</th>
                            <th style="width: 9%">amount</th>

                            <th style="width: 9%">received amount</th>
                            <th style="width: 9%">rejected amount</th>
                            <th style="width: 5%">actual amount</th>
                            <th style="width: 8%">total(Rs)</th>
                            <th style="width: 3%">discount <span id="discount_column_header"></span>%</th>
                          
                            <th style="width: 11%">actual total(Rs)</th>
                            <th style="width: 12%"></th>
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
                            <form action="/itemreceives" class="form-inline" method="POST">
                                    {{ csrf_field() }}
                                    <td><input id="amount_{{++$counter_for_checkboxes}}" type="text" class="form-control input-sm" name="amount" ></td>
                                    <td><input id="rejected_{{$counter_for_checkboxes}}" type="text" class="form-control input-sm" name="rejected"></td>
                                    
                                    <input type="hidden" name="item_id" value="{{$item_order->pivot->item_id}}">
                                    <input type="hidden" name="receive_id" value="{{$order->receive->id}}">
                                    
                                    <td>{{$item_order->item_id}}</td>
                                    <td></td>
                                     
                                    <td>
                                        <div class="material-switch pull-right">
                                            <input id="precentage_{{$counter_for_checkboxes}}" name="precentage" type="checkbox" />
                                            <label for="precentage_{{$counter_for_checkboxes}}" class="label-danger"></label>
                                        </div>
                                    </td>
                                   
                                    <td></td>
                                    
                                   <td>
                                        <input type="submit" name="delete" value="add" class="btn btn-primary btn-xs">
                                   </td>
                                </form>
                                
                            @else
                               
                                <form action="/itemreceives/{{$item_receive_id}}" class="pull-right" method="POST">
                                    {{ csrf_field() }}
                                    <td><input id="amount_{{++$counter_for_checkboxes}}" type="text" class="form-control" name="amount" value="{{$item_receive_amount}}"></td>
                                    <td><input id="rejected_{{$counter_for_checkboxes}}" type="text" class="form-control" name="rejected" value="{{$item_receive_reject}}"></td>
                                    <td>{{$item_receive_amount-$item_receive_reject}}</td>
                                    <td>{{($item_receive_amount-$item_receive_reject)*$item_order->pivot->unit_price}}</td>
                                  
                                    <td>
                                        <div class="material-switch pull-right">
                                            <input id="precentage_{{$counter_for_checkboxes}}" name="precentage" type="checkbox" {{ $item_receive_precentage > 0.00 ? "checked" : "" }}/>
                                            <label for="precentage_{{$counter_for_checkboxes}}" class="label-danger"></label>
                                        </div>
                                    </td>
                                    
                                    
                                    <td>{{(($item_receive_amount-$item_receive_reject)*$item_order->pivot->unit_price)*((100-$item_receive_precentage)/100)}}</td>
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="receive_id" value="{{$order->receive->id}}">
                                    <input type="hidden" name="item_id" value="{{$item_order->pivot->item_id}}">
                                   <td>
                                    <input type="submit" name="edit" value="update" class="btn btn-warning btn-xs">
                                   
                                </form>
                                 <form action="/itemreceives/{{$item_receive_id}}" class="pull-right" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                   </td>
                                </form>
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

    GetColumnData(1,"discount","meta","#discount_column_header");

    function grn_calculation(){

        var total = 0;
        var MyRows = $('table#table').find('tbody').find('tr');
        
        for (var i = 0; i < MyRows.length; i++) {
            var val=$(MyRows[i]).find('td:eq(9)').html();
            if(val.length>0){
                total += parseFloat(val);
            }
            console.log(val);
        }
        $('#grn_tot').html('<font size="5">Rs.'+total+'</font>');
    }

    grn_calculation();

        var ordered_amount;
        var amount;
        var rejected;

    var input_event=  $('.form-control').keyup(function(){

        ordered_amount=$(this).closest('tr').find('td:eq(3)').text();
        amount=$(this).closest('tr').find('input[name="amount"]').val();
        rejected=$(this).closest('tr').find('input[name="rejected"]').val();

        var actual_amount=amount-rejected;
        var unit_price= $(this).closest('tr').find('td:eq(2)').text();
        var total=actual_amount*unit_price;
        $(this).closest('tr').find('td:eq(6)').text(actual_amount);
        $(this).closest('tr').find('td:eq(7)').text(total);

        check_event.change();
        
   
    });

   $('.form-control').change(function(){
        ordered_amount=$(this).closest('tr').find('td:eq(3)').text();
        amount=$(this).closest('tr').find('input[name="amount"]').val();
        rejected=$(this).closest('tr').find('input[name="rejected"]').val();
        
        if(ordered_amount<amount){
          
            $(document).trigger("add-alerts", [
            {
                "message": "your amount larger than ordered amount",
                "priority": 'danger'
            }
            ]);
            $(this).val(" ");
            $(this).focus();

        }
        else if(amount-rejected<0){
         
             $(document).trigger("add-alerts", [
            {
                "message": "your received amount smaller than rejected amount",
                "priority": 'danger'
            }
            ]);
            $(this).val(" ");
            $(this).focus();

        }

        input_event.keyup();

        });

   var check_event= $('input[name="precentage"]').change(
       function(){

            var total =$(this).closest('tr').find('td:eq(7)').text();
            var real_total;

            if($(this).is(':checked')){
                var discount=parseFloat($('#discount_column_header').html());
                real_total=total*(100-discount)/100;
                
            }
            else{
                real_total=total;
            }
           
            $(this).closest('tr').find('td:eq(9)').text(real_total);
            grn_calculation();
        });

    














});
</script>
@endsection


