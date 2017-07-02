@extends('layouts.app')

@section('content')
 
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE ISSUE <span class="label label-primary"><big>#{{$issue->id}}</big></span></big>
                for&nbsp&nbsp&nbsp&nbsp 
                officer :<strong class="text-info"><big>{{$issue->officer->name}}</big></strong>&nbsp&nbsp
                date of issue : <strong class="text-info"><big>{{$issue->issue_date}}</big></strong>&nbsp&nbsp
                                
                <form action="/issues/{{$issue->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}
                   
                    <a href="/issues/{{$issue->id}}/edit" class="btn btn-warning btn-xs ">edit this issue</a>&nbsp&nbsp
                    <input type="submit" name="delete" value="delete this issue" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            
            
            </div>
            <div class="panel-body">
                
            
            @if(count($issue->items)>0)
                <table class="table table-striped table-hover" style="width: 75%" >
                    <thead>
                        <tr>
                            <th style="width: 25%">item name</th>
                            <th style="width: 15%">amount</th>
                            <th style="width: 20%">created</th>
                            <th style="width: 20%">last updated</th>
                            <th style="width: 15%"> <a href="/issueitems/create/{{$issue->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a></th>
                        </tr>
                    </thead>
                    @foreach($issue->items as $issue_item)
                        <tr>
                            <td>{{$issue_item->name}}</td>
                            <td>{{$issue_item->pivot->amount}}</td>
                             <td> {{$issue_item->pivot->created_at->format('Y-m-d_H:m')}}</td>
                                   <td> {{$issue_item->pivot->updated_at->format('Y-m-d_H:m')}}</td>
                                 
                                                           
                            <td> 
                                <form action="/issueitems/{{$issue_item->pivot->id}}" class="form-inline" method="POST">
                                    {{ csrf_field() }}
                                    <a href="/issueitems/{{$issue_item->pivot->id}}/edit" class="btn btn-warning btn-xs">edit</a>&nbsp&nbsp
                                    <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                  
                </table>
                 
                {{-- {{$all_items->links()}} --}}
            @else
                <a href="/issueitems/create/{{$issue->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a></th>
                
            @endif      
                   
            </div>
        
            

        </div>
    </div>
    
</div>


@endsection 


