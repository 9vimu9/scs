@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE ORDER</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/orders">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label">supplier</label>
                            <div class="col-md-3">
                               <select id="name"  class="form-control" ></select>
                            <input type="hidden" id="supplier_id" name="supplier_id" value="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">date</label>
                            <div class="col-md-3">
                                <input id="datepicker" type="text" class="datepicker form-control" name="date" value="{{date('Y-m-d')}}">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label">deadline</label>
                            <div class="col-md-3">
                               <input id="datepicker2" type="text" class="datepicker form-control" name="deadline">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
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
        GetSuggestions("name","suppliers");

        $('#name').on('select2:select', function (evt) {
            console.log(evt.params.data.id);
            $('#supplier_id').val(evt.params.data.id);
        });
    </script>
    {{-- end of autosuggest --}}
@endsection 




