@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row ">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <big>ITEMS</big>
                <a href="/items/create" class="pull-right btn btn-primary btn-sm">add item</a>
            </div>
                <div class="panel-body">
                    @if(count($all_items)>0)
                    <table class="table table-striped table-hover" >
                        @foreach($all_items as $item)
                            <tr>
                                <td> <big><a href="/items/{{$item->id}}">{{$item->name}}</a></big></td>
                                <td>{{$item->created_at->format('Y-m-d_H:m')}}</td>
                                <td>{{$item->updated_at->format('Y-m-d_H:m')}}</td>
                                <td> 
                                   

                                    <form action="/items/{{$item->id}}" class="pull-right" method="POST">
                                        {{ csrf_field() }}
                                        <a href="/items/{{$item->id}}/edit" class="btn btn-warning btn-xs">edit</a>
                                        <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                           
                               
                              
                            
                    @endforeach
                    </table>
                        {{$all_items->links()}}
                    @else
                    no items<br>click add item button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
