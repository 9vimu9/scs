@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>Edit Hut: <strong><big>{{$hut->item->name}}</big></strong></big></div>
            <div class="panel-body">

              <form class="form-horizontal" role="form" method="POST" action="/huts/{{$hut->id}}">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="PUT">
                      <div class="form-group">
                       <label class="col-md-4 col-sm-4 control-label">category</label>
                       <div class="col-md-3 col-sm-3">
                           <select id="cat"  name="cat" class="form-control" data-width="100%">
                             <option value="{{$hut->item->cat_id}}" selected="{{$hut->item->cat->name}}">
                                 {{$hut->item->cat->name}}
                             </option>
                           </select>
                            <input type="hidden" id="cat_id" value="{{$hut->item->cat_id}}" name="cat_id"/>
                       </div>
                     </div>


                       <div class="form-group">
                           <label class="col-md-4 control-label">name</label>
                           <div class="col-md-4">
                               <input id="name" type="text" class="form-control" name="name" value="{{$hut->item->name}}">
                           </div>
                       </div>

                       <div class="form-group">
                           <label class="col-md-4 control-label">price</label>
                           <div class="col-md-2">
                               <input id="price" type="text" class="form-control" name="price" value="{{$hut->item->prices[count($hut->item->prices)-1]->price}}">
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

@section("script")

@include('layouts.suggest')
<script>

    GetSuggestions("cat","name","cats");

     $('#cat').on('select2:select', function (evt) {
         var cat_id=evt.params.data.id;
           $('#cat_id').val(cat_id);

    });

</script>

@endsection
