@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row ">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <big>{{$item->name}}</big>
                &nbsp&nbsp
                category :<strong class="text-info"><big>{{$item->cat->name}}</big></strong>
                &nbsp&nbsp
                item code : <strong class="text-info"><big>{{$item->code}}</big></strong>
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
                    <table id="log" class="table  table-hover table-bordered" style="width: 55%" >
                        <thead>
                            <tr>
                                <th>type</th>
                                <th>#no</th>
                                <th>quantity</th>
                                <th>balance</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($logs as $log)

                                @if($previous_date!=$log->date)

                                    <?php
                                        $previous_date=$log->date;
                                    ?>
                                    <tr class="bg-info">
                                        <td colspan="4" style="text-align: center"> {{$log->date}}</td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                    </tr>
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

                                        }else if($log->type=="li"){
                                            $link_prhase="/itemloanissues/";
                                            $title="LOAN ACCOUNT ISSUED";
                                            $no_col_header="LIO #";
                                            $balance-=$log->amount;


                                        }else if($log->type=="lir"){
                                            $link_prhase="/itemloanissuereturns/";
                                            $title="LOAN ITEM RETURNED";
                                            $no_col_header="LIRO #";
                                            $balance+=$log->amount;

                                        }
                                    ?>
                                    <td>{{$title}}</td>
                                    <td><a href="{{ $link_prhase.$log->id}}">{{$no_col_header.$log->id}}</a></td>
                                    <td>{{$log->amount}}</td>
                                    <td>{{$balance}}</td>

                                </tr>


                            @endforeach
                        </tbody>

                    </table>

                @else
                no history

                @endif
            </div>

        </div>

    </div>
</div>

@endsection

@section('script')
<script>
  $(function () {

    $('#log').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
@endsection
