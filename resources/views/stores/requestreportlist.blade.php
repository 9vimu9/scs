@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>ITEM REQUEST REPORTS</big>
                <a href="/stores/current" class="pull-right btn btn-primary btn-sm">new report</a>
            </div>
                <div class="panel-body">
                    @if(count($reportrequests)>0)
                      <table id="table" class="table  table-striped" width="75%">
                <thead>
               <tr>
                            <th width="10%">no</th>
                            <th width="20%">date</th>
                            <th width="40%">type</th>
                            <th width="16%"></th>
                           
                           
                        </tr>
                </thead>
                <tbody>
                @foreach($reportrequests as $reportrequest)
                            <tr bgcolor={{ $reportrequest->type==1 ? "#B2D732" : "#fff"}}>
                           
                                <td>{{$reportrequest->id}}</td>

                                <td>{{$reportrequest->created_at->format('Y-m-d_H:m')}}</td>

                               
                                @if($reportrequest->type==1)
                                 <td >
                                   <span class="badge">monthly</span>  request report for <strong><big>{{$reportrequest->created_at->format('M , Y')}}</big></strong>
                                @else
                                    <td bgcolor="">
                                      <span class="badge">urgent</span> request report on {{$reportrequest->created_at->format('Y-m-d H:m')}}
                                @endif
                                </td>
                                
                                   <td>

                                    <form action="/destroy_request_report/{{$reportrequest->id}}" class="form-group" method="POST">
                                        {{ csrf_field() }}
                                        <a href="/requestselected/{{$reportrequest->id}}" class="btn btn-warning btn-xs">more</a>
                                        <input type="submit" name="delete" value="delete" class="btn btn-danger btn-xs">
                                        <input type="hidden" name="_method" value="DELETE">
                                       
                                    </form>
                                </td>
                            </tr>
                           
                               
                              
                            
                    @endforeach
                </tbody>
                
              </table>
                       
                    @else
                    no officers<br>click add officer button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection

@section('script')
<script>
  $(function () {
   
    $('#table').DataTable({
        'paging'      : false,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : false,
        'autoWidth'   : true,
        'order': [[ 0, "desc" ]],
    })
  })
</script>

@endsection
