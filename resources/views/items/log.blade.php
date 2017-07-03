@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row ">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <big>{{$item->name}}</big>
                &nbsp&nbsp    
                stock code no : <strong class="text-info"><big>{{$item->code}}</big></strong>
                &nbsp&nbsp    
                location : <strong class="text-info"><big>{{$item->location}}</big></strong>
                <div class="pull-right">&nbsp&nbsp    
                max level: <strong class="text-info"><big>{{$item->max}}</big></strong>
                &nbsp&nbsp    
                min level: <strong class="text-info"><big>{{$item->min}}</big></strong>
                &nbsp&nbsp    
                reorder level: <strong class="text-info"><big>{{$item->reorder}}</big></strong>
                </div>
                
            
            </div>
                <div class="panel-body">
                    @if(count($logs)>0)
                        <?php
                            $previous_date=0;
                            $balance=0;

                            $link_prhase="";   
                            $title="";
                            $no_col_header="";   
                        ?>
                        <table class="table  table-hover table-bordered" style="width: 55%" >
                            <thead>
                                <tr>
                                    <th>type</th>
                                    <th>#no</th>
                                    <th>quantity</th>
                                    <th>balance</th>
                                </tr>
                            </thead>

                            @foreach($logs as $log)
                            
                                @if($previous_date!=$log->date)
                            
                                    <?php
                                        $previous_date=$log->date;
                                    ?>
                                    <tr class="bg-info"><th colspan="4" style="text-align: center"> {{$log->date}}</th>

                                @endif

                                <tr>
                                
                                    <?php
                                        if($log->type=="o"){
                                            $link_prhase="/itemorders/";
                                            $title="ORDERED";
                                            $no_col_header="order #";
                                        
                                        }else if($log->type=="r"){
                                            $link_prhase="/itemreceives/";
                                            $title="RECEIVED";
                                            $no_col_header="GRN #";
                                            $balance+=$log->amount;
                                        
                                        }else if($log->type=="i"){
                                            $link_prhase="/issueitems/";
                                            $title="ISSUED";
                                            $no_col_header="IO #";
                                            $balance-=$log->amount;
                                            
                                        }
                                    ?>
                                    <td>{{$title}}</td>
                                    <td><a href="{{ $link_prhase.$log->id}}">{{$no_col_header.$log->id}}</a></td>
                                    <td>{{$log->amount}}</td>
                                    <td>{{$balance}}</td>

                                </tr>
                                        
                            
                            @endforeach

                        </table>







 

                    @else
                    no items<br>click add item button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
