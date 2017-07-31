@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>ORDERS </big>
                <a href="/orders/create" class="pull-right btn btn-primary btn-sm">add order</a>
            </div>
                <div class="panel-body">
                    @if(count($orders)>0)
                     <table class="table table-striped table-hover" style="width: 85%" >
                    <thead>
                        <tr>
                            <th style="width: 10%">order</th>
                            <th style="width: 20%">supplier</th>
                            <th style="width: 15%">date</th>
                            <th style="width: 10%">quantity</th>
                            <th style="width: 12%">total(Rs)</th>
                            <th style="width: 15%">created</th>
                            <th style="width: 18%">last updated</th>
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
                                <td>{{$order->created_at->format('Y-m-d_H:m')}}</td>
                                <td>{{$order->updated_at->format('Y-m-d_H:m')}}</td>
                                <td> <a href="/itemorders/{{$order->id}}" class="btn btn-warning btn-xs">edit</a> </td>
                            </tr>

                    @endforeach
                    </table>
                      
                    @else
                    no orders<br>click add order button

                    @endif
                </div>

        </div>

    </div>
</div>

@endsection
