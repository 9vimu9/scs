@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" >
        <div class="panel panel-default">
            <div class="panel-heading"><big>Edit item: <strong><big>{{$item->name}}</big></strong></big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/items/{{$item->id}}">
                        {{ csrf_field() }}


                           <div class="form-group">
                            <label class="col-md-4 col-sm-4 control-label">category</label>
                            <div class="col-md-3 col-sm-3">
                               
                                <select id="cat"  name="cat" class="form-control" data-width="100%"><option value="{{$item->cat_id}}" selected="{{$item->cat->name}}">{{$item->cat->name}}</option></select>
                                 <input type="hidden" id="cat_id" value="{{$item->cat_id}}" name="cat_id"/>
                                
                            </div>
                             
                           
                        </div>

                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="col-md-4 control-label">name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$item->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">code</label>
                            <div class="col-md-3">
                                <input id="code" type="text" class="form-control" name="code" value="{{$item->code}}">
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">location</label>
                            <div class="col-md-3">
                                <input id="location" type="text" class="form-control" name="location" value="{{$item->location}}">
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">max level</label>
                            <div class="col-md-1">
                                <input id="max" type="text" class="form-control" name="max" value="{{$item->max}}">
                            </div>

                             <label class="col-md-1 control-label">min level</label>
                            <div class="col-md-1">
                                <input id="min" type="text" class="form-control" name="min" value="{{$item->min}}">
                            </div>
                        </div>

                          

                          <div class="form-group">
                            <label class="col-md-4 control-label">reorder level</label>
                            <div class="col-md-1">
                                <input id="reorder" type="text" class="form-control" name="reorder" value="{{$item->reorder}}">
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
           GetColumnData(cat_id,"symbol","cats","#code");
       
   
    });

  $("#max,#min,#reorder").change(function(){
       
      //  checkReorder();
        var max=parseInt($('#max').val());
        var min=parseInt($("#min").val());
        var reorder=parseInt($("#reorder").val());


        if(max<=min){
            alert("check your max and min  values");
            $(this).focus();
            $(this).val('');
        }

        if( max<=reorder || min>=reorder){
           alert("check your reorder value");
           $("#reorder").focus();
          $("#reorder").val('');
     }
       
    });
</script>

@endsection
