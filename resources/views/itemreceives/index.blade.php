@extends('layouts.app')



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
                <font size="2">order value: </font> <span class="badge"><font size="3">Rs.{{$sub_tot}}</font></span>&nbsp&nbsp
                supplier : <strong class="text-info"><big>{{$order->supplier->name}}</big></strong>
                <form action="/receives/{{$order->receive->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}
                  &nbsp&nbsp
                    <a href="/receives/{{$order->receive->id}}/edit" class="btn btn-warning btn-xs ">edit this GRN</a>&nbsp&nbsp
                    <input type="submit" name="delete" value="delete this GRN" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            
            
            </div>
            <div class="panel-body">
            
            
            @if(count($order->item_order)>0)
                <table class="table table-bordered table-hover" style="width: 80%" >
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align: center" ><big>ordered items details</big></th>
                            <th colspan="4"style="text-align: center"><big>GRN data</big></th>
                        </tr>

                        <tr>
                            <th style="width: 15%">item name</th>
                            <th style="width: 10%">total(Rs)</th>
                            <th style="width: 5%">rate(Rs)</th>
                            <th style="width: 8%">amount</th>

                            <th style="width: 8%">received amount</th>
                            <th style="width: 8%">rejected amount</th>
                             <th style="width: 8%">actual amount</th>
                              <th style="width: 15%">total(Rs)</th>
                               <th style="width: 15%"></th>
                        </tr>
                    </thead>

 

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
                               
                                if(count($order->receive->items)>0){                   
                           
                                    foreach( $order->receive->items as $item_receive){
                                        if($item_receive->pivot->item_id===$item_order->pivot->item_id){
                                            // {{-- mekata awwa kiyanne e item_order ekata adaalawa item_reeive ekak thibe kiyana eka --}}
                                            // <td>badu atha</td> 
                                           
                                            $item_receive_id=$item_receive->pivot->id;
                                            $item_receive_amount=$item_receive->pivot->amount;
                                            $item_receive_reject=$item_receive->pivot->rejected;
                                          
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
                                    <td><input id="amount" type="text" class="form-control" name="amount" ></td>
                                    <td><input id="rejected" type="text" class="form-control" name="rejected"></td>
                                     <input type="hidden" name="item_id" value="{{$item_order->pivot->item_id}}">
                                      <input type="hidden" name="receive_id" value="{{$order->receive->id}}">
                                    <td>{{$item_order->item_id}}</td>
                                    <td></td>
                                    
                                   <td>
                                        <input type="submit" name="delete" value="add" class="btn btn-primary btn-xs">
                                   </td>
                                </form>
                                
                            @else
                               
                                <form action="/itemreceives/{{$item_receive_id}}" class="pull-right" method="POST">
                                    {{ csrf_field() }}
                                    <td><input id="amount" type="text" class="form-control" name="amount" value="{{$item_receive_amount}}"></td>
                                    <td><input id="rejected" type="text" class="form-control" name="rejected" value="{{$item_receive_reject}}"></td>
                                    <td>{{$item_receive_amount-$item_receive_reject}}</td>
                                    <td>{{($item_receive_amount-$item_receive_reject)*$item_order->pivot->unit_price}}</td>
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="receive_id" value="{{$item_receive->pivot->receive_id}}">
                                    <input type="hidden" name="item_id" value="{{$item_receive->pivot->item_id}}">
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
                 
                {{-- {{$all_items->links()}} --}}
            @else
               no items 
            @endif      
                   
            </div>
        
            

        </div>
    </div>
    
</div>


@endsection 

@section('script')
<script>
$(document).ready(function(){
$('.form-control').keyup(function(){
       
      
        var amount=  $(this).parents('tr:first td:nth-child(5)')context.text();
         var amodunt=  $(this).parents('tr:first td:nth-child(4)').text();
     //   var actual_amount=amount-rejected;
        console.log(amount+" "+amodunt);
     // $(this).closest('tr').find("td:eq(6)").text(actual_amount);
    });
    });



</script>
@endsection


