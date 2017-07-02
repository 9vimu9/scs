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
            <div class="panel-heading"><big>CREATE ORDER <span class="label label-primary"><big>#{{$order->id}}</big></span></big>
                &nbsp&nbsp&nbsp&nbsp 
                supplier : <strong class="text-info"><big>{{$order->supplier->name}}</big></strong>&nbsp&nbsp
                contact : <strong>{{$order->supplier->tel}}</strong>&nbsp&nbsp
                
                <form action="/orders/{{$order->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}
                   <font size="4">sub total: </font> <span class="badge"><font size="4">Rs.{{$sub_tot}}</font></span>&nbsp&nbsp
                    <a href="/orders/{{$order->id}}/edit" class="btn btn-warning btn-xs ">edit this order</a>&nbsp&nbsp
                    <input type="submit" name="delete" value="delete this order" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            
            
            </div>
            <div class="panel-body">
                
            
            @if(count($order->item_order)>0)
                <table class="table table-striped table-hover" style="width: 95%" >
                    <thead>
                        <tr>
                            <th style="width: 25%">item name</th>
                            <th style="width: 15%">amount</th>
                            <th style="width: 12%">rate(Rs)</th>
                            <th style="width: 15%">total(Rs)</th>
                            <th style="width: 15%">created</th>
                            <th style="width: 20%">last updated</th>
                            <th style="width: 15%"> <a href="/itemorders/create/{{$order->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a></th>
                        </tr>
                    </thead>
                    @foreach($order->items as $item_order)
                        <tr>
                            <td>{{$item_order->name}}</td>
                            <td>{{$item_order->pivot->amount}}</td>
                            <td>{{$item_order->pivot->unit_price}}</td>
                            <td>{{($item_order->pivot->amount)*($item_order->pivot->unit_price)}}</td>
                            <td>{{$item_order->pivot->created_at->format('Y-m-d_H:m')}}</td>
                            <td>{{$item_order->pivot->updated_at->format('Y-m-d_H:m')}}</td>
                            <td> 
                                <form action="/itemorders/{{$item_order->pivot->id}}" class="form-inline" method="POST">
                                    {{ csrf_field() }}
                                    <a href="/itemorders/{{$item_order->pivot->id}}/edit" class="btn btn-warning btn-xs">edit</a>&nbsp&nbsp
                                    <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                  
                </table>
                 
                {{-- {{$all_items->links()}} --}}
            @else
                <a href="/itemorders/create/{{$order->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a>
                
            @endif      
                   
            </div>
        
            

        </div>
    </div>
    
</div>


@endsection 


