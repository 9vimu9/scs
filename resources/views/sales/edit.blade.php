@extends('layouts.app')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}" >
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
              <big>EDIT SALES ORDER #{{$sale->id}}</big>

            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/sales/{{$sale->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                          <input type="hidden" name="quotation_id" value="{{$sale->quotation_id}}">

                        <div class="form-group">
                            <label class="col-xs-5 control-label">customer</label>
                            <div class="col-xs-4">
                                <span>{{$sale->quotation->customer->name}}</span>
                        </div>
                      </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">from</label>
                            <div class="col-sm-2">
                                <input id="datepicker" type="text" class="datepicker form-control" name="deliver_date" value="{{$sale->deliver_date}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">to</label>
                            <div class="col-sm-2">
                                <input id="datepicker2" type="text" class="datepicker form-control" name="return_date" value="{{$sale->return_date}}" >
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-xs-5 control-label">service charge(Rs)</label>
                            <div class="col-xs-2">
                                <input id="service_charge" type="text" class="form-control" name="service_charge" value="{{$sale->service_charge}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">advance(Rs)</label>
                            <div class="col-xs-2">
                                <input id="advance" type="text" class="form-control" name="advance" value="{{$sale->advance}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">discount(%)</label>
                            <div class="col-xs-1">
                                <input id="discount" type="text" class="form-control" name="discount" value="{{$sale->discount}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-5">
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
