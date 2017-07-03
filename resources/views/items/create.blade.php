@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>ADD ITEM</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/items">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label">name</label>
                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control" name="name" value={{old('name')}}>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">code</label>
                            <div class="col-md-3">
                                <input id="code" type="text" class="form-control" name="code" value={{old('code')}}>
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">location</label>
                            <div class="col-md-3">
                                <input id="location" type="text" class="form-control" name="location" value={{old('location')}}>
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">max level</label>
                            <div class="col-md-1">
                                <input id="max" type="text" class="form-control" name="max" value={{old('max')}}>
                            </div>

                             <label class="col-md-1 control-label">min level</label>
                            <div class="col-md-1">
                                <input id="min" type="text" class="form-control" name="min" value={{old('min')}}>
                            </div>
                        </div>

                          

                        <div class="form-group">
                            <label class="col-md-4 control-label">reorder level</label>
                            <div class="col-md-1">
                                <input id="reorder" type="text" class="form-control" name="reorder" value={{old('reorder')}}>
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">category</label>
                            <div class="col-md-1">
                                <input id="cat" type="text" class="form-control" name="cat" value={{old('cat')}}>
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
<script>
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