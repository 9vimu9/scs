@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>LOAN ACCOUNT ISSUE ITEMS RETURN</big>
                <a href="/loanissuereturns/create" class="pull-right btn btn-primary btn-sm">add loan issue return</a>
            </div>
                <div class="panel-body">
               
                    @if(count($loanissuereturns)>0)
                     <table class="table table-striped table-hover" style="width: 100%" >
                    <thead>
                        <tr>
                            <th style="width: 12%">loan issue return #</th>
                            <th style="width: 12%">loan issue #</th>
                            <th style="width: 12%">date</th>
                            
                            <th style="width: 15%">created</th>
                            <th style="width: 15%">last updated</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                        @foreach($loanissuereturns as $loanissuereturn)
                            <tr>
                                <td> <big>{{$loanissuereturn->id}}</big></td>
                                <td> <a href="/itemloanissues/{{$loanissuereturn->loanissue_id}}">{{$loanissuereturn->loanissue_id}}</a></td>
                               
                                <td> {{$loanissuereturn->date}}</td>
                               
                                
                                <td>{{$loanissuereturn->created_at->format('Y-m-d_H:m')}}</td>
                                <td>{{$loanissuereturn->updated_at->format('Y-m-d_H:m')}}</td>
                                <td> <a href="/itemloanissuereturns/{{$loanissuereturn->id}}" class="btn btn-warning btn-xs">more</a> </td>
                            </tr>
                                
                    @endforeach
                    </table>
                        {{$loanissuereturns->links()}}
                    @else
                    no GRN<br>click add GRN button
                    
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
