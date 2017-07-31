@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE SALE</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/sales">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label">customer</label>
                            <div class="col-md-3">
                               <select id="name"  class="form-control" ></select>
                            <input type="hidden" id="customer_id" name="customer_id" value="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">date of sale</label>
                            <div class="col-md-3">
                                <input id="datepicker" type="text" class="datepicker form-control" name="sale_date" value="{{date('Y-m-d')}}">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label">description</label>
                            <div class="col-md-4">
                               <textarea name="description" class="form-control"value={{old('descrition')}}></textarea>වැඩ සදහා ..
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
       GetSuggestions("name","name","customers");

        $('#name').on('select2:select', function (evt) {
            console.log(evt.params.data.id);
            $('#customer_id').val(evt.params.data.id);
        });
    </script>
    {{-- end of autosuggest --}}
@endsection
