@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>ISSUES</big>
                <a href="/issues/create" class="pull-right btn btn-primary btn-sm">add issue</a>
            </div>
                <div class="panel-body">
                    @if(count($issues)>0)
                     <table class="table table-striped table-hover" style="width: 92%" >
                    <thead>
                        <tr>
                            <th style="width: 10%">issue</th>
                            <th style="width: 15%">officer</th>
                            <th style="width: 12%">date</th>
                            <th style="width: 30%">description</th>
                            <th style="width: 15%">created</th>
                            <th style="width: 15%">last updated</th>
                            <th style="width: 10%"></th>
                           
                        </tr>
                    </thead>
                        @foreach($issues as $issue)
                            <tr>
                                <td> <big>{{$issue->id}}</big></td>
                               <td> {{$issue->officer->name}}</td>
                                <td> {{$issue->issue_date}}</td>
                                 <td> {{$issue->description}}</td>
                                  <td> {{$issue->created_at->format('Y-m-d_H:m')}}</td>
                                   <td> {{$issue->updated_at->format('Y-m-d_H:m')}}</td>
                                 

                                <td> <a href="/issueitems/{{$issue->id}}" class="btn btn-warning btn-xs">more</a> </td>
                            </tr>
                                
                    @endforeach
                    </table>
                        {{$issues->links()}}
                    @else
                    no issues<br>click add issue button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
