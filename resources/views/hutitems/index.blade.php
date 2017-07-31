@extends('layouts.app')



@section('content')

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>updating items of: &nbsp&nbsp<big>{{$hut->item->name}}</big></big>
                &nbsp&nbsp&nbsp&nbsp
                category : <strong class="text-info"><big>{{$hut->item->cat->name}}</big></strong>&nbsp&nbsp
                price : <strong>Rs. {{$hut->item->prices[count($hut->item->prices)-1]->price}}</strong>&nbsp&nbsp

                <form action="/huts/{{$hut->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}
                    <a href="/huts/{{$hut->id}}/edit" class="btn btn-warning btn-xs ">edit</a>&nbsp&nbsp
                    <input type="submit" name="delete" value="delete this hut" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>


            </div>
            <div class="panel-body">


            @if(count($hut->hut_items)>0)
                <table class="table table-striped table-hover" style="width: 95%" >
                    <thead>
                        <tr>
                            <th style="width: 25%">item name</th>
                            <th style="width: 15%">amount</th>
                            <th style="width: 20%">last updated</th>
                            <th style="width: 15%"> <a href="/hutitems/create/{{$hut->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a></th>
                        </tr>
                    </thead>
                    @foreach($hut->hut_items as $item)
                        <tr>

                            <td>{{$item->item->name}}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{$item->updated_at->format('Y-m-d_H:m')}}</td>
                            <td>
                                <form action="/hutitems/{{$item->id}}" class="form-inline" method="POST">
                                    {{ csrf_field() }}
                                    <a href="/hutitems/{{$item->id}}/edit" class="btn btn-warning btn-xs">edit</a>&nbsp&nbsp
                                    <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>

                {{-- {{$all_items->links()}} --}}
            @else
                <a href="/hutitems/create/{{$hut->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a>

            @endif

            </div>



        </div>
    </div>

</div>


@endsection
