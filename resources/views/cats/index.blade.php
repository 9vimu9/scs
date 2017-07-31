@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>CATEGORIES</big>
                <a href="/cats/create" class="pull-right btn btn-primary btn-sm">add category</a>
            </div>
                <div class="panel-body">
                    @if(count($cats)>0)
                    <table class="table table-striped table-hover"style="width: 65%" >
                     <thead>
                        <tr>
                            <th style="width: 25%">name</th>

                            <th style="width: 20%">created</th>
                            <th style="width: 20%">last updated</th>
                            <th style="width: 15%"></th>

                        </tr>
                    </thead>
                        @foreach($cats as $cat)
                            <tr>
                                <td> <big><a href="/cats/{{$cat->id}}">{{$cat->name}}</a></big></td>
                              
                                <td>{{$cat->created_at->format('Y-m-d_H:m')}}</td>
                                <td>{{$cat->updated_at->format('Y-m-d_H:m')}}</td>



                                    <form action="/cats/{{$cat->id}}" class="pull-right" method="POST">
                                        {{ csrf_field() }}
                                        <td> <a href="/cats/{{$cat->id}}/edit" class="btn btn-warning btn-xs">edit</a>
                                        <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                        <input type="hidden" name="_method" value="DELETE">
                                         </td>
                                    </form>

                            </tr>




                    @endforeach
                    </table>

                    @else
                    no categories<br>click add category button

                    @endif
                </div>

        </div>

    </div>
</div>

@endsection
