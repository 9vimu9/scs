@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>Goods receive notes</big>
                <a href="/receives/create" class="pull-right btn btn-primary btn-sm">add grn</a>
            </div>
                <div class="panel-body">
                    @if(count($receives)>0)
                     <table class="table table-striped table-hover" style="width: 75%" >
                    <thead>
                        <tr>
                            <th style="width: 15%">grn</th>
                            <th style="width: 25%">order</th>
                            <th style="width: 20%">date</th>
                            <th style="width: 15%">quantity</th>
                            <th style="width: 20%">total(Rs)</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                        @foreach($orders as $order)
                            <tr>
                                <td> <big>{{$order->id}}</big></td>
                                <td> {{$order->supplier->name}}</td>
                                <td> {{$order->date}}</td>
                               
                                 @if(count($order->item_order)>0)
                                  <?php
                                        $tot=0;
                                        $amount=0;

                                    foreach($order->item_order as $items){
                                        
                                       
                                        $tot+=$items->amount*$items->unit_price;
                                         $amount+=$items->amount;
                                        
                                       // {{$items}}
                                   }
                                   ?>
                                    
                                
                               <td> {{$amount}}</td>
                                <td>{{$tot}}</td>
                                
                                 @else
                                 <td>0</td>
                                <td>0</td>
                                 @endif

                                <td> <a href="/itemorders/{{$order->id}}" class="btn btn-warning btn-xs">edit</a> </td>
                            </tr>
                                
                    @endforeach
                    </table>
                        {{$orders->links()}}
                    @else
                    no orders<br>click add order button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
