@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE QUOTATION <span class="label label-primary"><big>#{{$quotation->id}}</big></span></big>
                &nbsp&nbsp&nbsp&nbsp
                customer :<strong class="text-info"><big>{{$quotation->customer->name}}</big></strong>&nbsp&nbsp
                for <strong class="text-info"><big>{{$quotation->days}}</big></strong>&nbsp&nbsp days
                &nbsp&nbsp&nbsp&nbsp<span class="badge"><strong><big>{{$quotation->sales_type==1 ? 'FUNERAL':'OTHER OCCASION'}}</big></strong></span>

                <form action="/quotations/{{$quotation->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}

                    <a href="/reports/quotation/{{$quotation->id}}" class="btn btn-info btn-xs">print</a>
                    <a href="/reports/quotation/{{$quotation->id}}" class="btn btn-info btn-xs">email</a>&nbsp&nbsp&nbsp&nbsp
                    <a href="/quotations/{{$quotation->id}}/edit" class="btn btn-warning btn-xs ">edit this quotation</a>
                    <input type="submit" name="delete" value="delete this quotation" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>


            </div>
            <div class="panel-body">


            @if(count($quotation->items)>0)
                <table class="table table-striped table-hover" style="width: 75%" >
                    <thead>
                        <tr>
                            <th style="width: 25%">item name</th>
                            <th style="width: 15%">amount</th>
                            <th style="width: 20%">created</th>
                            <th style="width: 20%">last updated</th>
                            <th style="width: 15%"> <a href="/quotationitems/create/{{$quotation->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a></th>
                        </tr>
                    </thead>
                    @foreach($quotation->items as $quotation_item)
                        <tr>
                            <td>{{$quotation_item->name}}</td>
                            <td>{{$quotation_item->pivot->amount}}</td>
                             <td> {{$quotation_item->pivot->created_at->format('Y-m-d_H:m')}}</td>
                                   <td> {{$quotation_item->pivot->updated_at->format('Y-m-d_H:m')}}</td>


                            <td>
                                <form action="/quotationitems/{{$quotation_item->pivot->id}}" class="form-inline" method="POST">
                                    {{ csrf_field() }}
                                    <a href="/quotationitems/{{$quotation_item->pivot->id}}/edit" class="btn btn-warning btn-xs">edit</a>&nbsp&nbsp
                                    <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>

                {{-- {{$all_items->links()}} --}}
            @else
                <a href="/quotationitems/create/{{$quotation->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a></th>

            @endif

            </div>



        </div>
    </div>

</div>


@endsection
