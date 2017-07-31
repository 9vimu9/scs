@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE SALE <span class="label label-primary"><big>#{{$sale->id}}</big></span></big>
                for&nbsp&nbsp&nbsp&nbsp
                 customer :<strong class="text-info"><big>{{$sale->customer->name}}</big></strong>&nbsp&nbsp
                date of sale : <strong class="text-info"><big>{{$sale->sale_date}}</big></strong>&nbsp&nbsp

                <form action="/sales/{{$sale->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}

                    <a href="/sales/{{$sale->id}}/edit" class="btn btn-warning btn-xs ">edit this sale</a>&nbsp&nbsp
                     <a href="/reports/sale/{{$sale->id}}" class="btn btn-danger btn-xs">print</a>
                    <input type="submit" name="delete" value="delete this sale" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>


            </div>
            <div class="panel-body">


            @if(count($sale->items)>0)
                <table class="table table-striped table-hover" style="width: 75%" >
                    <thead>
                        <tr>
                            <th style="width: 25%">item name</th>
                            <th style="width: 15%">amount</th>
                            <th style="width: 20%">created</th>
                            <th style="width: 20%">last updated</th>
                            <th style="width: 15%"> <a href="/saleitems/create/{{$sale->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a></th>
                        </tr>
                    </thead>
                    @foreach($sale->items as $sale_item)
                        <tr>
                            <td>{{$sale_item->name}}</td>
                            <td>{{$sale_item->pivot->amount}}</td>
                             <td> {{$sale_item->pivot->created_at->format('Y-m-d_H:m')}}</td>
                                   <td> {{$sale_item->pivot->updated_at->format('Y-m-d_H:m')}}</td>


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
