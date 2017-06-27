@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" >
        <div class="panel panel-default">
            <div class="panel-heading"><big>Edit item: <strong><big>{{$item->name}}</big></strong></big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/items/{{$item->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="col-md-4 control-label">name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$item->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">code</label>
                            <div class="col-md-3">
                                <input id="code" type="text" class="form-control" name="code" value="{{$item->code}}">
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">location</label>
                            <div class="col-md-3">
                                <input id="location" type="text" class="form-control" name="location" value="{{$item->location}}">
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">max level</label>
                            <div class="col-md-1">
                                <input id="max" type="text" class="form-control" name="max" value="{{$item->max}}">
                            </div>

                             <label class="col-md-1 control-label">min level</label>
                            <div class="col-md-1">
                                <input id="min" type="text" class="form-control" name="min" value="{{$item->min}}">
                            </div>
                        </div>

                          

                          <div class="form-group">
                            <label class="col-md-4 control-label">ordering quantity</label>
                            <div class="col-md-1">
                                <input id="reorder" type="text" class="form-control" name="reorder" value="{{$item->reorder}}">
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">category</label>
                            <div class="col-md-1">
                                <input id="cat" type="text" class="form-control" name="cat" value="{{$item->cat}}">
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
