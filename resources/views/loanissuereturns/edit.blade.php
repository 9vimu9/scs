@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>EDIT ITEMS RETURNING</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/loanissuereturns/{{$loanissuereturn->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="col-md-4 control-label">loan account issue no</label>
                            <div class="col-md-2">
                               
                                 <select id="order_no"  class="form-control" >
                                    <option value="{{$loanissuereturn->loanissue_id}}" selected="{{$loanissuereturn->loanissue_id}}">
                                        {{$loanissuereturn->loanissue_id}}
                                    </option>
                                </select>    
                                <input type="hidden" id="order_id" name="loanissue_id" value="{{$loanissuereturn->loanissue_id}}" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">date</label>
                            <div class="col-md-2">
                                <input id="datepicker" type="text" class="datepicker form-control" name="date" value="{{$loanissuereturn->date}}">
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
        GetSuggestions("order_no","id","loanissues");

        $('#order_no').on('select2:select', function (evt) {
            console.log(evt.params.data.id);
            $('#order_id').val(evt.params.data.id);
        });
    </script>
    {{-- end of autosuggest --}}
@endsection 




