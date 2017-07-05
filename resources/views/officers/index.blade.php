@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>OFFICERS</big>
                <a href="/officers/create" class="pull-right btn btn-primary btn-sm">add officer</a>
            </div>
                <div class="panel-body">
                    @if(count($all_officers)>0)
                     <table class="table table-striped table-hover"style="width: 75%" >
                     <thead>
                        <tr>
                            <th style="width: 25%">name</th>
                            <th style="width: 15%">NIC</th>
                            <th style="width: 20%">created</th>
                            <th style="width: 20%">last updated</th>
                            <th style="width: 15%"></th>
                           
                        </tr>
                        @foreach($all_officers as $officer)
                            <tr>
                                <td> <big><a href="/officers/{{$officer->id}}">{{$officer->name}}</a></td>
                                <td>{{$officer->nic}}</td>

                                <td>{{$officer->created_at->format('Y-m-d_H:m')}}</td>
                                <td>{{$officer->updated_at->format('Y-m-d_H:m')}}</td>
                                
                                   

                                    <form action="/officers/{{$officer->id}}" class="pull-right" method="POST">
                                        {{ csrf_field() }}
                                        <td> <a href="/officers/{{$officer->id}}/edit" class="btn btn-warning btn-xs">edit</a>
                                        <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                           
                               
                              
                            
                    @endforeach
                    </table>
                        {{$all_officers->links()}}
                    @else
                    no officers<br>click add officer button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
