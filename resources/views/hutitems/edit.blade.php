@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
              Hut <big>{{$hut_item->item->name}} </big>edit item </strong></big>
              <a href="/hutitems/{{$hut_item->hut_id}}" class="btn btn-info btn-sm pull-right">back</a>

            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/hutitems/{{$hut_item->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="col-md-4 control-label">item name</label>
                            <div class="col-md-4">
                                 <select id="item"  name="item" class="form-control" data-width="100%">
                                   <option value="{{$hut_item->item_id}}" selected="{{$hut_item->item->name}}">
                                     {{$hut_item->item->name}}
                                   </option>
                                 </select>
                                 <input type="hidden" id="item_id" value="{{$hut_item->item_id}}" name="item_id"/>
                                 <input type="hidden" id="hut_id"  name="hut_id" value="{{$hut_item->hut_id}}"/>

                            </div>

                               {{-- reorder quantity <span class="label label-danger" id="reorder_badge">{{$item_order->item_reorder}}</span> --}}

                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">amount</label>
                            <div class="col-md-2">
                                <input id="amount" type="text" class="form-control" name="amount" value="{{$hut_item->amount}}">
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

    @include('layouts.suggest')

    <script>
      GetSuggestions("item","name","items");

      $('#item').on('select2:select', function (evt) {
          var seletedItemId=evt.params.data.id;

          $('#item_id').val(seletedItemId);
      });
     </script>

@endsection
