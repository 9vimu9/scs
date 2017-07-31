@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>Goods receive notes</big>
                <a href="/grns/create" class="pull-right btn btn-primary btn-sm">add grn</a>
            </div>
                <div class="panel-body">
                {{($grns)}}
                    @if(count($grns)>0)
                     <table class="table table-striped table-hover" style="width: 100%" >
                    <thead>
                        <tr>
                            <th style="width: 8%">grn #</th>
                            <th style="width: 8%">order #</th>
                            <th style="width: 12%">date</th>
                            <th style="width: 10%">quantity</th>


                            <th style="width: 10%">total(Rs)</th>
                            <th style="width: 15%">created</th>
                            <th style="width: 15%">last updated</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                        @foreach($grns as $grn)
                            <tr>
                                <td> <big>{{$grn->id}}</big></td>
                                <td> <a href="/itemorders/{{$grn->order_id}}">{{$grn->order_id}}</a></td>

                                <td> {{$grn->date}}</td>

                                @if(count($grn->items)>0)
                                <?php
                                    $amount=0;

                                    $tot_rs=0;

                                    foreach($grn->items as $item_grn){
                                        $amount+=$item_grn->pivot->amount;


                                        foreach($grn->order->items as $item_order){

                                            if($item_order->pivot->item_id===$item_grn->pivot->item_id){
                                                $tot_rs+=($item_grn->pivot->amount)*$item_order->pivot->unit_price;
                                            }
                                        }


                                   }
                                ?>


                                <td> {{$amount}}</td>


                                <td>{{$tot_rs}}</td>


                                @else
                                    <td>0</td>
                                    <td>0</td>
                                     <td>0</td>
                                    <td>0</td>
                                 @endif
                                    <td>{{$grn->created_at->format('Y-m-d_H:m')}}</td>
                                    <td>{{$grn->updated_at->format('Y-m-d_H:m')}}</td>
                                <td> <a href="/itemgrns/{{$grn->id}}" class="btn btn-warning btn-xs">more</a> </td>
                            </tr>

                    @endforeach
                    </table>
                        {{$grns->links()}}
                    @else
                    no GRN<br>click add GRN button

                    @endif
                </div>

        </div>

    </div>
</div>

@endsection
