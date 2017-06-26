@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>SUPPLIERS</big></div>
                <div class="panel-body">
                    @if(count($all_suppliers)>0)
                        @foreach($all_suppliers as $supplier)
                            <div class="well">
                            <big><a href="/suppliers/{{$supplier->id}}">{{$supplier->name}}</a>  {{$supplier->tel}}</big>
                            <div class="pull-right">
                                 <a href="/suppliers/{{$supplier->id}}/edit" class="btn btn-warning">edit</a>
                                 <a href="/suppliers/{{$supplier->id}}/edit" class="btn btn-danger">remove</a>
                            </div>
                            </div>
                    @endforeach
                        {{$all_suppliers->links()}}
                    @else
                        <div class="alert alert-warning">
                            no suppliers want to add one?
                            <a href="/suppliers/create" class="btn btn-warning">add supplier</a>
                        </div>
                    @endif
                </div>
            
        </div>
      
    </div>
</div>

@endsection
