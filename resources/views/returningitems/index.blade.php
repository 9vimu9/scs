@extends('layouts.app')

@section('content')

  <?php
    $sub_tot=0;
    $final_tot=0;
  ?>
  @if(count($returning->sale->items)>0)
      @foreach($returning->sale->items as $returning_item)
          <?php
              $sub_tot+=$returning_item->pivot->total;
          ?>
      @endforeach
      <?php
          $final_tot=$returning->sale->service_charge+$sub_tot-($sub_tot-$returning->sale->advance)*($returning->sale->discount)/100;
      ?>

  @endif

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>RETURNINGS SALE ORDER <span class="label label-primary"><big>#{{$returning->sale->id}}</big></span></big>
                &nbsp&nbsp&nbsp&nbsp
                customer :<strong class="text-info"><big>{{$returning->sale->quotation->customer->name}}</big></strong>&nbsp&nbsp
                &nbsp&nbsp&nbsp&nbsp<span class="badge"><strong><big>{{$returning->sale->quotation->sales_type==1 ? 'FUNERAL':'OTHER OCCASION'}}</big></strong></span>
                <div class="pull-right">
                  <font size="3">total: </font> <span class="badge"><font size="4">Rs.{{$sub_tot}}</font></span>&nbsp&nbsp
                  <font size="4">final total: </font> <span class="badge"><font size="5">Rs.{{$final_tot}}</font></span>
                </div>
            </div>
            <div class="panel-body">
              <div class="col-sm-3">
                service charge(Rs) :<strong class="text-info"><big>{{$returning->sale->service_charge}}</big></strong>&nbsp&nbsp
              </div>
              <div class="col-sm-3">
                advance(Rs) :<strong class="text-info"><big>{{$returning->sale->advance}}</big></strong>&nbsp&nbsp
              </div>
              <div class="col-sm-2">
                discount :<strong class="text-info"><big>{{$returning->sale->discount}}</big></strong>%&nbsp
              </div>
              <div class="col-sm-3">
                from :<strong class="text-info"><big>{{$returning->sale->deliver_date}}</big></strong>&nbsp&nbsp
                to :<strong class="text-info"><big>
                  {{$returning->sale->actual_return_date=="0000-00-00" ? $returning->sale->return_date : $returning->sale->actual_return_date}}</big></strong>&nbsp&nbsp

              </div>

              {{-- {{$returning->sale->items}} --}}
              {{$returning->sale_items}}
            @if(count($returning->sale->items)>0)
              <form action="/returningitems/{{$returning->id}}" method="get">
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="PUT">
                <table class="table table-bordered table-hover" style="width: 60%" >
                    <thead>
                        <tr>
                            <th style="width: 50%">item name</th>
                            <th style="width: 20%">delivered amount</th>
                            <th style="width: 30%">returned amount <button type="submit" class="btn btn-danger btn-sm"> save</button></th>
                        </tr>
                    </thead>

                    @foreach($returning_items as $returning_item)
                      <input type="hidden" name="returning_item_id[]" value="{{$returning_item->id}}" />
                      <tr>
                        <td>{{$returning_item->sale_item->item->name}}</td>
                        <td>{{$returning_item->sale_item->amount}}</td>
                        <td>
                          <input type="text" name="amount[]"  value="{{$returning_item->amount}}" />
                        </td>
                      </tr>
                    @endforeach
                  </form>
                </table>
              @endif
            </div>
        </div>
    </div>

</div>

@endsection
