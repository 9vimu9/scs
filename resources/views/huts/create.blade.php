@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE HUT</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/huts">
                        {{ csrf_field() }}

                        <div class="form-group">
                           <label class="col-md-4 col-sm-4 control-label">category</label>
                           <div class="col-md-3 col-sm-3">
                                <select id="cat"  name="cat" class="form-control" data-width="100%">
                                  <option value="{{session('cat_id')}}" selected="{{session('cat_name')}}">
                                      {{session('cat_name')}}
                                  </option>
                                </select>
                                <input type="hidden" id="cat_id"  name="cat_id" value="{{session('cat_id')}}" />
                           </div>
                       </div>

                       <div class="form-group">
                           <label class="col-md-4 control-label">name</label>
                           <div class="col-md-4">
                               <input id="name" type="text" class="form-control" name="name" value={{old('name')}}>
                           </div>
                       </div>

                       <div class="form-group">
                           <label class="col-md-4 control-label">price</label>
                           <div class="col-md-2">
                               <input id="price" type="text" class="form-control" name="price" value={{old('price')}}>
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
