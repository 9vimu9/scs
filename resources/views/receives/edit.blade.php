@extends('layouts.app')

@section('head')


 <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}" >

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>EDIT GRN</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/receives/{{$receive->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="col-md-4 control-label">order no</label>
                            <div class="col-md-2">

                                 <select id="order_no"  class="form-control" >
                                    <option value="{{$receive->order_id}}" selected="{{$receive->order_id}}">
                                        {{$receive->order_id}}
                                    </option>
                                </select>
                                <input type="hidden" id="order_id" name="order_id" value="{{$receive->order_id}}" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-5 control-label">discount(%)</label>
                            <div class="col-md-1">
                                <input id="discount" type="text" class="form-control" name="discount"  value="{{$receive->discount}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-5 control-label">VAT <span id="vat_value" class="badge"></span>%</label>

                            <div class="col-md-2">
                              <div class="material-switch pull-left">
                                  <input id="vat" name="vat" type="checkbox" {{ $receive->vat > 0.00 ? "checked" : "" }} />
                                  <label for="vat" class="label-danger"></label>
                              </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">date</label>
                            <div class="col-md-2">
                                <input id="datepicker" type="text" class="datepicker form-control" name="date" value="{{$receive->date}}">
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

@section('script')
 {{-- auto suggest --}}
    @include('layouts.suggest');

    <script>
        GetSuggestions("order_no","id","orders");

        $('#order_no').on('select2:select', function (evt) {
            console.log(evt.params.data.id);
            $('#order_id').val(evt.params.data.id);
        });
    </script>
    {{-- end of autosuggest --}}
@endsection
