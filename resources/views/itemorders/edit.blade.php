@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>ORDER #{{$item_order->order_id}} EDIT ITEMS</big></strong></big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/itemorders/{{$item_order->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label class="col-md-4 control-label">item name</label>
                            <div class="col-md-4">
                                 <select id="item"  name="item" class="form-control" data-width="100%"><option value="{{$item_order->item_id}}" selected="{{$item_order->item->name}}">{{$item_order->item->name}}</option></select>
                                 <input type="hidden" id="item_id" value="{{$item_order->item_id}}" name="item_id"/>
                                  <input type="hidden" id="order_id" value="{{$item_order->order_id}}" name="order_id"/>
                                 
                            </div>
                             
                               {{-- reorder quantity <span class="label label-danger" id="reorder_badge">{{$item_order->item_reorder}}</span> --}}
                            
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">amount</label>
                            <div class="col-md-2">
                                <input id="amount" type="text" class="form-control" name="amount" value="{{$item_order->amount}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">unit price</label>
                            <div class="col-md-2">
                                <input id="unit_price" type="text" class="form-control" name="unit_price" value="{{$item_order->unit_price}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-2">
                                <span class="badge" id="total"></span>
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
  
    var reorder=parseInt($('#reorder_badge').text());
    

    $("#unit_price,#amount").keyup(function(){
       
      //  checkReorder();
        var price=$('#unit_price').val();
        var amount=$("#amount").val();
        var itemTotal=price*amount;
        $('#total').html('<h6><strong>Rs: '+itemTotal+'</strong></h6>');
    });

    function checkReorder(){
       
      
        if(reorder==0){
            alert("please select your item from item box");
        } else{
            
            if(reorder<$("#amount").val()){
                
                alert($( "#item option:selected" ).text()+"'s maximum reorder value is "+reorder+". apply below that")
                $("#amount").focus();
              $("#amount").val('');
            }
        }
    }

    GetSuggestions("item","name","items");

    $('#item').on('select2:select', function (evt) {
        var seletedItemId=evt.params.data.id;
       // console.log(seletedItemId);
        $('#item_id').val(seletedItemId);
         GetSingleValue(seletedItemId,"reorder","items","#reorder_badge");
    });
 // $('#item').select2('data', {id: $('#item_id').val(), a_key: $('#item_name').val()});
    </script>

@endsection 


