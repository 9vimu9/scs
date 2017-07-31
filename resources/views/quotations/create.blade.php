@extends('layouts.app')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}" >
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE QUOTATION</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/quotations">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-xs-5 control-label">for</label>
                            <div class="col-xs-1">
                                <input id="days" type="text" class="form-control" name="days" value={{old('days')}}>

                            </div>
                              <label class="control-label">days</label>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">customer</label>
                            <div class="col-xs-3">
                               <select id="name"  class="form-control" ></select>
                            <input type="hidden" id="customer_id" name="customer_id" value="" />
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="col-xs-5 control-label">funeral ?</label>
                            <div class="col-xs-3">
                              <div class="material-switch">
                                  <input id="checkfuneral" name="checkfuneral" type="checkbox" />
                                  <label for="checkfuneral" class="label-danger"></label>
                              </div>
                          </div>
                        </div>


                        <div class="form-group">
                            <label class="col-xs-5 control-label">service charge(Rs)</label>
                            <div class="col-xs-2">
                                <input id="service_charge" type="text" class="form-control" name="service_charge" value={{old('service_charge')}}>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">advance(Rs)</label>
                            <div class="col-xs-2">
                                <input id="advance" type="text" class="form-control" name="advance" value={{old('advance')}}>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">discount(%)</label>
                            <div class="col-xs-1">
                                <input id="discount" type="text" class="form-control" name="discount" value={{old('discount')}}>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-5">
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
@endsection

@section('script')
 {{-- auto suggest --}}
    @include('layouts.suggest');

    <script>
       GetSuggestions("name","name","customers");

        $('#name').on('select2:select', function (evt) {
            console.log(evt.params.data.id);
            $('#customer_id').val(evt.params.data.id);
        });
    </script>
    {{-- end of autosuggest --}}
@endsection
