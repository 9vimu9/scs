@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <big>{{$title}} </big>
                <a href="{{url('/sales/create') }}" class="pull-right btn btn-primary btn-sm">add sale</a>
            </div>
                <div class="panel-body">
                    @if(count($sales)>0)
                    <div class="table-responsive">
                     <table id="sales_index" class="table table-striped table-hover table-center" cellspacing="0" style="table-layout: fixed; width: 150%" >
                       <thead>
                        <tr>
                            <th style="width: 8%">S ID</th>
                            <th style="width: 8%">Q ID</th>
                            <th style="width: 25%">date</th>
                            <th style="width: 25%">customer</th>
                            <th style="width: 12%">deliver date</th>
                            <th style="width: 12%">planned return date</th>
                            <th style="width: 12%">actual return date</th>
                            <th style="width: 8%">service charge(Rs)</th>
                            <th style="width: 10%">item charge</th>
                            <th style="width: 10%">advance(Rs)</th>
                            <th style="width: 15%">discount</th>
                            <th style="width: 10%">cost-discount</th>
                            <th style="width: 10%">service charge+cost-discount</th>
                            <th style="width: 10%">user</th>
                            <th style="width: 25%"></th>
                        </tr>
                    </thead>
                    <tfoot>
                      <tr>

                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                          <th ></th>
                      </tr>
                    </tfoot>
                    <tbody>

                        @foreach($sales as $sale)
                            <tr>
                                <td> <big>{{$sale->id}}</big></td>
                                <td> <big>{{$sale->quotation_id}}</big></td>
                                <td> <big>{{$sale->created_at}}</big></td>
                                <td> {{$sale->quotation->customer->name}}</td>
                                <td> {{$sale->deliver_date}}</td>
                                <td> {{$sale->return_date}}</td>
                                <td>
                                   @if ($sale->actual_return_date=='0000-00-00')
                                     n r
                                   @else
                                      {{$sale->actual_return_date}}
                                   @endif
                                 </td>
                                <td> {{$sale->service_charge}}</td>
                                <?php
                                  $tot=0;
                                  $discountValue=0;
                                  if(count($sale->sale_item)>0){
                                    foreach($sale->sale_item as $items){

                                        $tot+=$items->total;
                                        // echo $items;
                                    }
                                    $discountValue=($tot-$sale->advance)*($sale->discount)/100;
                                  }
                                  ?>
                                  <td> {{$tot}}</td>
                                  <td> {{$sale->advance}}</td>
                                  <td> <span class="badge">{{$sale->discount}}%</span> [Rs.{{$discountValue}}]</td>
                                  <td> {{$tot-$discountValue}}</td>
                                  <td> {{$sale->service_charge+$tot-$discountValue}}</td>
                                  <td>{{$sale->user->name}}</td>
                                  <td>
                                    <div class="row">
                                      <div class="col-xs-12">
                                        <a href="/saleitems/{{$sale->id}}" class="btn btn-info btn-xs">more</a>

                                        <form class="change_actual_return_Date form-inline" action="{{ url('change_actual_return_Date') }}" method="get">
                                          <input type="hidden" name="sale_id" value="{{$sale->id}}">
                                          <input type="hidden" id="actual_return_date_{{$sale->id}}" name="actual_return_date" value="0000-00-00">
                                          @if ($sale->actual_return_date=='0000-00-00')
                                            <button  class="btn btn-success btn-xs datepicker_embedded_btn"  data-sale_id='{{$sale->id}}' data-date-format="yyyy-mm-dd" data-date="{{date('Y-m-d', time())}}">returned</button>
                                          @else
                                            <button type="submit" class="btn btn-warning btn-xs not_returned"  >
                                              not returned
                                            </button>
                                          @endif
                                        </form>

                                      </div>
                                    </div>
                                  </td>
                            </tr>
                    @endforeach
                  </tbody>

                </table>
                {{-- {{ $sales->links() }} --}}
                </div>
                @else
                  no sales<br>click add sale button
                @endif
        </div>
    </div>
</div>

@endsection



@section('script')
  <script type="text/javascript">

    $('.datepicker_embedded_btn').datepicker(

    ).on('changeDate', function(ev){
        $('.datepicker_embedded_btn').datepicker('hide');
        var selected_date=$(this).data('date');
        var selected_sale_id=$(this).data("sale_id");
        $('#actual_return_date_'+selected_sale_id).val(selected_date);
        alert($('#actual_return_date').val());
        $(this).closest("form").submit();
    });

    var sales_index=$('#sales_index').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
    })

    var searchArray = {
      0:"sales_id",//table column:id naem
      1:"quotation_id",//table column:id naem
      2:"date",//table column:id naem
      3:"customer",
      4:"deliver_date",
      5:"planned_return_date",
      6:"actual_return_date",
      13:"user",
    };
    AddColumnSearch(sales_index,searchArray,'#sales_index');

  </script>

@endsection
