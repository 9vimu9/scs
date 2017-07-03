@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>LOAN ACCOUNT ISSUE</big>
                <a href="/loanissues/create" class="pull-right btn btn-primary btn-sm">add loan account</a>
            </div>
                <div class="panel-body">
                    @if(count($loanissues)>0)
                     <table class="table table-striped table-hover" style="width: 90%" >
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
                        @foreach($loanissues as $loanissue)
                            <tr>
                                <td> <big>{{$loanissue->id}}</big></td>
                               <td> {{$loanissue->officer->name}}</td>
                                <td> {{$loanissue->issue_date}}</td>
                                 <td> {{$loanissue->description}}</td>
                                  <td> {{$loanissue->created_at->format('Y-m-d_H:m')}}</td>
                                   <td> {{$loanissue->updated_at->format('Y-m-d_H:m')}}</td>
                                 

                                <td> <a href="/itemloanissues/{{$loanissue->id}}" class="btn btn-warning btn-xs">more</a> </td>
                            </tr>
                                
                    @endforeach
                    </table>
                        {{$loanissues->links()}}
                    @else
                    no loan accounts<br>click add loan issue button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
