@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>EDIT ISSUE</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/issues/{{$issue->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label class="col-md-4 control-label">officer</label>
                            <div class="col-md-3">
                               <select id="name"  class="form-control" >
                                    <option value="{{$issue->officer_id}}" selected=" {{$issue->officer->name}}">
                                        {{$issue->officer->name}}
                                    </option>
                                </select>
                            <input type="hidden" id="officer_id" name="officer_id" value="{{$issue->officer_id}}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">date of issue</label>
                            <div class="col-md-3">
                                <input id="datepicker" type="text" class="datepicker form-control" name="issue_date" value="{{$issue->issue_date}}">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label">description</label>
                            <div class="col-md-4">
                               <textarea name="description" class="form-control">{{$issue->description}}</textarea>වැඩ සදහා ...
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
       GetSuggestions("name","name","officers");

        $('#name').on('select2:select', function (evt) {
            console.log(evt.params.data.id);
            $('#officer_id').val(evt.params.data.id);
        });
    </script>
    {{-- end of autosuggest --}}
@endsection
