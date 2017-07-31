@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
              <big>Edit customer: <strong><big>{{$customer->name}}</big></strong></big>
              <a href="/customers" class="pull-right btn btn-primary btn-sm">all customers</a>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/customers/{{$customer->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="col-md-4 control-label">name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$customer->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">NIC</label>
                            <div class="col-md-2">
                                <input id="nic" type="text" class="form-control" name="nic" value="{{$customer->nic}}">
                            </div>
                        </div>

                        <div class="form-group">
                           <label class="col-md-4 control-label">address</label>
                           <div class="col-md-6">

                              <input id="address" type="text" class="form-control" name="address" value="{{$customer->address}}">
                           </div>
                       </div>

                       <div class="form-group">
                          <label class="col-md-4 control-label">tel</label>
                          <div class="col-md-2">
                              <input id="tel_1" type="text" class="form-control" name="tel_1" value="{{explode("_",$customer->tel)[0]}}">
                          </div>
                          <div class="col-md-2">
                              <input id="tel_2" type="text" class="form-control" name="tel_2" value="{{explode("_",$customer->tel)[1]}}">
                          </div>
                      </div>

                      <div class="form-group">
                         <label class="col-md-4 control-label">email</label>
                         <div class="col-md-5">

                            <input id="email" type="email" class="form-control" name="email" value="{{$customer->email}}">
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
