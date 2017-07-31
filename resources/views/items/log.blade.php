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
                    <table id="log" class="table table-bordered " width="75%">
                        <thead>
                          <tr>
                              <th colspan="3" style="text-align: center" ><big>ordered</big></th>
                              <th colspan="3" style="text-align: center" ><big>grnd</big></th>
                              <th colspan="3"style="text-align: center"><big>saled</big></th>
                              <th  width="8%" rowspan="2" colspan="1" style="text-align: center"><big>balance</big></th>
                          </tr>
                            <tr>
                                <th width="10%">date</th>
                                <th width="8%">order no</th>
                                <th width="8%">quantity</th>
                                <th width="10%">date</th>
                                <th width="8%">GRN no</th>
                                <th width="8%">quantity</th>
                                <th width="10%">date</th>
                                <th width="8%">IO no</th>
                                <th width="8%">quantity</th>


                            </tr>
                        </thead>

                        <tbody>
                            @foreach($logs as $log)




                                        @if($log->type=="1o")
                                          <tr bgcolor="#DADADA">
                                          <td>{{$log->date}}</td>
                                          <td><a href="/itemorders/{{$log->id}}">order #{{$log->id}}</a></td>
                                          <td>{{$log->amount}}</td>
                                          <td  colspan="7"></td>



                                        @elseif($log->type=="2r")
                                            <tr bgcolor="#D9EDF7">
                                            <td colspan="3"></td>
                                            <td>{{$log->date}}</td>
                                            <td><a href="/itemgrns/{{$log->id}}">GRN #{{$log->id}}</a></td>
                                            <td>{{$log->amount}}</td>
                                            @php
                                                $balance+=$log->amount;
                                            @endphp
                                            <td colspan="3"></td>
                                            <td>{{$balance}}</td>

                                        @elseif($log->type=="5i")
                                            <tr bgcolor="#F2DEDE">
                                            <td colspan="6"></td>
                                            <td>{{$log->date}}</td>
                                            <td><a href="/saleitems/{{$log->id}}">IO #{{$log->id}}</a></td>
                                            <td>{{$log->amount}}</td>

                                            @php
                                                $balance-=$log->amount;
                                            @endphp
                                            <td>{{$balance}}</td>

                                      
                                        @endif



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
