@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>SALES</big>
                <a href="/sales/create" class="pull-right btn btn-primary btn-sm">add sale</a>
            </div>
                <div class="panel-body">
                    @if(count($sales)>0)
                     <table class="table table-striped table-hover" style="width: 92%" >
                    <thead>
                        <tr>
                            <th style="width: 10%">sale</th>
                            <th style="width: 15%">customer</th>
                            <th style="width: 12%">date</th>
                            <th style="width: 30%">description</th>
                            <th style="width: 15%">created</th>
                            <th style="width: 15%">last updated</th>
                            <th style="width: 10%"></th>
                           
                        </tr>
                    </thead>
                        @foreach($sales as $sale)
                            <tr>
                                <td> <big>{{$sale->id}}</big></td>
                               <td> {{$sale->customer->name}}</td>
                                <td> {{$sale->sale_date}}</td>
                                 <td> {{$sale->description}}</td>
                                  <td> {{$sale->created_at->format('Y-m-d_H:m')}}</td>
                                   <td> {{$sale->updated_at->format('Y-m-d_H:m')}}</td>
                                 

                                <td> <a href="/saleitems/{{$sale->id}}" class="btn btn-warning btn-xs">more</a> </td>
                            </tr>
                                
                    @endforeach
                    </table>
                        {{$sales->links()}}
                    @else
                    no sales<br>click add sale button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
