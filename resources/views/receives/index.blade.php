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
                {{($receives)}}
                    @if(count($receives)>0)
                     <table class="table table-striped table-hover" style="width: 75%" >
                    <thead>
                        <tr>
                            <th style="width: 10%">grn #</th>
                            <th style="width: 10%">order #</th>
                            <th style="width: 15%">date</th>
                            <th style="width: 20%">quantity</th>
                             <th style="width:15%">rejected</th>
                             <th style="width:15%">accepted</th>
                            <th style="width: 20%">total(Rs)</th>
                            <th style="width: 15%"></th>
                        </tr>
                    </thead>
                        @foreach($receives as $receive)
                            <tr>
                                <td> <big>{{$receive->id}}</big></td>
                                 <td> <a href="/itemorders/{{$receive->order_id}}">{{$receive->order_id}}</a></td>
                               
                                <td> {{$receive->date}}</td>
                               {{$receive}}
                                 @if(count($receive->item_receive)>0)
                                  <?php
                                       
                                        $amount=0;
                                        $reject_amount=0;
                                        $accept_amount=0;
                                        $tot_rs=0;

                                    foreach($receive->item_receive as $items){
                                        
                                        $amount+=$items->amount;
                                        $reject_amount+=$items->rejected;
                                        $accept_amount+=$amount- $reject_amount;
                                        $tot_rs+=$accept_amount*$items->unit_price;
                                        
                                        
                                       // {{$items}}
                                   }
                                   ?>
                                    
                                
                                <td> {{$amount}}</td>
                                <td>{{$reject_amount}}</td>
                                <td> {{$accept_amount}}</td>
                                <td>{{$tot_rs}}</td>
                               
                                
                                @else
                                    <td>0</td>
                                    <td>0</td>
                                     <td>0</td>
                                    <td>0</td>
                                 @endif

                                <td> <a href="/itemreceives/{{$receive->id}}" class="btn btn-warning btn-xs">edit</a> </td>
                            </tr>
                                
                    @endforeach
                    </table>
                        {{$receives->links()}}
                    @else
                    no GRN<br>click add GRN button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
