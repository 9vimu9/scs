@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>current situation</big>
                <a href="/officers/create" class="pull-right btn btn-primary btn-sm">add officer</a>
            </div>
                <div class="panel-body">
                    @if(count($items)>0)
                     <table class="table table-striped table-hover"style="width: 75%" >
                     <thead>
                        <tr>
                            <th style="width: 25%">name</th>
                             <th style="width: 15%">category</th>
                            <th style="width: 15%">code</th>
                              <th style="width: 10%">location</th>
                            
                            <th style="width: 20%">amount</th>
                            <th style="width: 20%">max</th>
                             <th style="width: 20%">reorder</th>
                              <th style="width: 20%">min</th>
                            <th style="width: 15%"></th>
                           
                        </tr>
                        @foreach($items as $item)
                            <tr>
                                <td> <a href="/items/{{$item->id}}">{{$item->name}}</a></td>
                              
                                <td>{{$item->cat->name}}</td>
                                <td>{{$item->code}}</td>
                                 <td>{{$item->location}}</td>
                                
                                <td>{{$item->current}}</td>
                                 <td>{{$item->max}}</td>
                                  <td>{{$item->reorder}}</td>
                                   <td>{{$item->min}}</td>
                                    <td></td>

                                  // ff

                                    {{-- <form action="/officers/{{$officer->id}}" class="pull-right" method="POST">
                                        {{ csrf_field() }}
                                        <td> <a href="/officers/{{$officer->id}}/edit" class="btn btn-warning btn-xs">edit</a>
                                        <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form> --}}
                                </td>
                            </tr>
                           
                               
                              
                            
                    @endforeach
                    </table>
                      
                    @else
                    no officers<br>click add officer button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
