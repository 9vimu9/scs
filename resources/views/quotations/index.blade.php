@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <big>QUOTATIONS </big>
                <a href="/quotations/create" class="pull-right btn btn-primary btn-sm">add quotation</a>
            </div>
                <div class="panel-body">
                    @if(count($quotations)>0)
                    <div class="table-responsive">
                     <table class="table table-striped table-hover" style="table-layout: fixed; width: 100%" >
                       <thead>
                        <tr>
                            <th style="width: 8%">#</th>
                            <th style="width: 15%">customer</th>
                            <th style="width: 5%">days</th>
                            <th style="width: 8%">service charge(Rs)</th>
                            <th style="width: 10%">cost on items(Rs)</th>
                            <th style="width: 10%">advance(Rs)</th>
                            <th style="width: 15%">discount</th>
                            <th style="width: 10%">cost-discount</th>
                            <th style="width: 10%">service charge+cost-discount</th>
                            <th style="width: 10%">user</th>
                            <th style="width: 12%"></th>
                        </tr>
                    </thead>
                        @foreach($quotations as $quotation)
                            <tr>
                                <td> <big>{{$quotation->id}}</big></td>
                                <td> {{$quotation->customer->name}}</td>
                                <td> {{$quotation->days}}</td>
                                <td> {{$quotation->service_charge}}</td>
                                <?php
                                  $tot=0;
                                  $discountValue=0;
                                  if(count($quotation->quotation_item)>0){
                                    foreach($quotation->quotation_item as $items){
                                        $tot+=$items->total;
                                    }
                                    $discountValue=($tot-$quotation->advance)*($quotation->discount)/100;
                                  }
                                  ?>
                                  <td> {{$tot}}</td>
                                  <td> {{$quotation->advance}}</td>
                                  <td> <span class="badge">{{$quotation->discount}}%</span> [Rs.{{$discountValue}}]</td>
                                  <td> {{$tot-$discountValue}}</td>
                                  <td> {{$quotation->service_charge+$tot-$discountValue}}</td>
                                  <td>{{$quotation->user->name}}</td>
                                  <td>



                                    <div class="row">
                                      <div class="col-xs-12">
                                        <a href="/quotationitems/{{$quotation->id}}" class="btn btn-info btn-xs">more</a>
                                        <a href="/quotationitems/{{$quotation->id}}" class="btn btn-success btn-xs">SALE</a>
                                      </div>
                                    </div>
                                  </td>
                            </tr>
                    @endforeach
                    </table>
                  </div>
                    @else
                      no quotations<br>click add quotation button
                    @endif

        </div>
    </div>
</div>

@endsection
