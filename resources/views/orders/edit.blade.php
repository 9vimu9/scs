@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>Edit Order: <strong><big>{{$order->id}}</big></strong></big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/orders/{{$order->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                         <div class="form-group">
                            <label class="col-md-4 control-label">supplier</label>
                            <div class="col-md-3">
                               <select id="name"  class="form-control" ><option value="{{$order->supplier_id}}" selected="{{$order->supplier_name}}">{{$order->supplier_name}}</option></select>
                            <input type="hidden" id="supplier_id" name="supplier_id" value="{{$order->supplier_id}}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">date</label>
                            <div class="col-md-3">
                                <input id="datepicker" type="text" class="datepicker form-control" name="date" value="{{$order->date}}">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label">deadline</label>
                            <div class="col-md-3">
                               <input id="datepicker2" type="text" class="datepicker form-control" name="deadline" value="{{$order->dealine}}">
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
        GetSuggestions("name","suppliers");

        $('#name').on('select2:select', function (evt) {
            console.log(evt.params.data.id);
            $('#supplier_id').val(evt.params.data.id);
        });
    </script>
    {{-- end of autosuggest --}}
@endsection 

