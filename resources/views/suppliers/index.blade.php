@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>SUPPLIERS</big>
                <a href="/suppliers/create" class="pull-right btn btn-primary btn-xs">add supplier</a>
            </div>
                <div class="panel-body">
                    @if(count($all_suppliers)>0)
                    <table class="table table-striped table-hover"style="width: 75%" >
                     <thead>
                        <tr>
                            <th style="width: 25%">name</th>
                            <th style="width: 12%">tel</th>
                            <th style="width: 35%">address</th>

                            <th style="width: 20%"></th>

                        </tr>
                        @foreach($all_suppliers as $supplier)
                            <tr>
                                <td> <big><a href="/suppliers/{{$supplier->id}}">{{$supplier->name}}</a></big></td>
                                <td>{{$supplier->tel}}</td>
                                <td>{{$supplier->address}}</td>
                                <td>
                                    <form action="/suppliers/{{$supplier->id}}" class="pull-right" method="POST">
                                        {{ csrf_field() }}
                                         <a href="/suppliers/{{$supplier->id}}/edit" class="btn btn-warning btn-xs">edit</a>
                                        <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>




                    @endforeach
                    </table>
                        {{$all_suppliers->links()}}
                    @else
                    no suppliers<br>click add supplier button

                    @endif
                </div>

        </div>

    </div>
</div>

@endsection
