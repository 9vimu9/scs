@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>Goods receive notes</big>
                <a href="/grns/create" class="pull-right btn btn-primary btn-sm">add grn</a>
            </div>
                <div class="panel-body">
                  <div class="panel-body">
                      <form class="form-horizontal" role="form" method="POST" action="/grns">
                              {{ csrf_field() }}

                              <div class="form-group">
                                  <label class="col-md-5 control-label">type</label>
                                  <div class="col-md-2">
                                      <input id="discount" type="text" class="form-control" name="discount"  value={{old('discount')}}>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-5 control-label">amount</label>
                                  <div class="col-md-2">
                                      <input id="discount" type="text" class="form-control" name="discount"  value={{old('discount')}}>
                                  </div>
                              </div>


                              <div class="form-group">
                                  <label class="col-md-5 control-label">discount(%)</label>
                                  <div class="col-md-1">
                                      <input id="discount" type="text" class="form-control" name="discount"  value={{old('discount')}}>
                                  </div>
                              </div>



                              <div class="form-group">
                                  <label class="col-md-5 control-label">date</label>
                                  <div class="col-md-2">
                                      <input id="datepicker" type="text" class="datepicker form-control" name="date" value="{{date('Y-m-d')}}">
                                  </div>
                              </div>


                              <div class="form-group">
                                  <div class="col-md-6 col-md-offset-5">
                                      <button type="submit" class="btn btn-primary">
                                          <i class="fa fa-btn fa-plus"></i> create
                                      </button>
                                  </div>
                              </div>
                          </form>

                  </div>

                </div>

        </div>

    </div>
</div>

@endsection
