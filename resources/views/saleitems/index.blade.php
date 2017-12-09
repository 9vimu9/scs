@extends('layouts.app')

@section('content')

  <?php
    $sub_tot=0;
    $final_tot=0;
  ?>
  @if(count($sale->items)>0)
      @foreach($sale->items as $sale_item)
          <?php
              $sub_tot+=$sale_item->pivot->total;
          ?>
      @endforeach
      <?php
          $final_tot=$sale->service_charge+$sub_tot-($sub_tot-$sale->advance)*($sale->discount)/100;
      ?>

  @endif

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE SALE ORDER <span class="label label-primary"><big>#{{$sale->id}}</big></span></big>
                &nbsp&nbsp&nbsp&nbsp
                customer :<strong class="text-info"><big>{{$sale->quotation->customer->name}}</big></strong>&nbsp&nbsp
                for <strong class="text-info"><big>{{$sale->days}}</big></strong>&nbsp&nbsp days
                &nbsp&nbsp&nbsp&nbsp<span class="badge"><strong><big>{{$sale->quotation->sales_type==1 ? 'FUNERAL':'OTHER OCCASION'}}</big></strong></span>

                <form action="/sales/{{$sale->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}

                    <a href="/reports/sale/{{$sale->id}}" class="btn btn-info btn-sm">print</a>
                    <a href="/reports/sale/{{$sale->id}}" class="btn btn-info btn-sm">email</a>&nbsp&nbsp&nbsp&nbsp
                    <a href="/sales/{{$sale->id}}/edit" class="btn btn-warning btn-sm ">edit this sale</a>
                    <input type="submit" name="delete" value="delete this sale" class="btn btn-danger btn-sm">
                    <input type="hidden" name="_method" value="DELETE">
                </form>

            </div>
            <div class="panel-body">
              <div class="col-sm-2">
                service charge(Rs) :<strong class="text-info"><big>{{$sale->service_charge}}</big></strong>&nbsp&nbsp
              </div>
              <div class="col-sm-2">
                advance(Rs) :<strong class="text-info"><big>{{$sale->advance}}</big></strong>&nbsp&nbsp
              </div>
              <div class="col-sm-1">
                discount :<strong class="text-info"><big>{{$sale->discount}}</big></strong>%&nbsp
              </div>
              <div class="col-sm-3">
                from :<strong class="text-info"><big>{{$sale->deliver_date}}</big></strong>&nbsp&nbsp
                to :<strong class="text-info"><big>
                  {{$sale->actual_return_date=="0000-00-00" ? $sale->return_date : $sale->actual_return_date}}</big></strong>&nbsp&nbsp

              </div>
              <div class="pull-right">
                <font size="3">total: </font> <span class="badge"><font size="4">Rs.{{$sub_tot}}</font></span>&nbsp&nbsp
                <font size="4">final total: </font> <span class="badge"><font size="5">Rs.{{$final_tot}}</font></span>&nbsp&nbsp
              </div>

            @if(count($sale->items)>0)
                <table class="table table-bordered table-hover" style="width: 95%" >
                    <thead>
                        <tr>
                            <th style="width: 25%">item name</th>
                            <th style="width: 15%">unit price(Rs)</th>
                            <th style="width: 15%">amount</th>
                            <th style="width: 15%">for {{$sale->days}} days(Rs)</th>
                            <th style="width: 20%">user</th>
                            <th style="width: 20%"> <a href="/saleitems/create/{{$sale->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a></th>
                        </tr>
                    </thead>
                    @foreach($sale->items as $sale_item)
                        <tr>
                            <td>{{$sale_item->name}}</td>
                            <td>{{$sale_item->pivot->unit_price}}</td>
                            <td>{{$sale_item->pivot->amount}}</td>
                            <td>{{$sale_item->pivot->total}}</td>
                            <td>{{$sale_item->user_name}}</td>

                            {{-- <td> {{$sale_item['user_name']}}</td> --}}
                            <td>
                                <form action="/saleitems/{{$sale_item->pivot->id}}" class="form-inline" method="POST">
                                    {{ csrf_field() }}
                                    <a href="/saleitems/{{$sale_item->pivot->id}}/edit" class="btn btn-warning btn-xs">edit</a>&nbsp&nbsp
                                    <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>

                {{-- {{$all_items->links()}} --}}
            @else
                <a href="/saleitems/create/{{$sale->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a></th>

            @endif

            </div>
        </div>
    </div>

</div>

@endsection
