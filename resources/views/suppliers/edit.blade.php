@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>Edit supplier: <strong><big>{{$supplier->name}}</big></strong></big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/suppliers/{{$supplier->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label class="col-md-4 control-label">name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$supplier->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">address</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{$supplier->address}}">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label">tel</label>
                            <div class="col-md-2">
                                <input id="tel" type="text" class="form-control" name="tel" value="{{$supplier->tel}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i> update
                                </button>
                            </div>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>
@endsection
