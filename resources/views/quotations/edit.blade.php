@extends('layouts.app')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}" >
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>EDIT QUOTATION #{{$quotation->id}}</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/quotations/{{$quotation->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

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
                              <select id="customer"  name="customer" class="form-control" data-width="100%">
                                <option value="{{$quotation->customer_id}}" selected="{{$quotation->customer->name}}">
                                    {{$quotation->customer->name}}
                                </option>
                              </select>
                            <input type="hidden" id="customer_id" name="customer_id" value="{{$quotation->customer_id}}" />
                            </div>
                        </div>


                        <div class="form-group">
                          <label class="col-xs-5 control-label">funeral ?</label>
                            <div class="col-xs-3">
                              <div class="material-switch">
                                  <input id="checkfuneral" name="checkfuneral" type="checkbox" {{ $quotation->sales_type== 1 ? "checked" : "" }}/>
                                  <label for="checkfuneral" class="label-danger"></label>
                              </div>
                          </div>
                        </div>


                        <div class="form-group">
                            <label class="col-xs-5 control-label">service charge(Rs)</label>
                            <div class="col-xs-2">
                                <input id="service_charge" type="text" class="form-control" name="service_charge" value="{{$quotation->service_charge}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">advance(Rs)</label>
                            <div class="col-xs-2">
                                <input id="advance" type="text" class="form-control" name="advance" value="{{$quotation->advance}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">discount(%)</label>
                            <div class="col-xs-1">
                                <input id="discount" type="text" class="form-control" name="discount" value="{{$quotation->discount}}">
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
