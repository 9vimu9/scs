@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>EDIT SALED ITEM</big></strong></big>&nbsp&nbsp&nbsp&nbsp <big>sale</big> <span class="label label-primary"><big>#{{$sale_item->sale_id}}</big></span></div>
           
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/saleitems/{{$sale_item->id}}">
                    {{ csrf_field() }}
                      <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label class="col-md-4 control-label">item name</label>
                        <div class="col-md-4">
                            <select id="item"  name="item" class="form-control" data-width="100%">
                                <option value="{{$sale_item->item_id}}" selected="{{$sale_item->item->name}}">
                                    {{$sale_item->item->name}}
                                </option>
                            </select>
                            <input type="hidden" id="item_id"  name="item_id" value="{{$sale_item->item_id}}"/>
                            <input type="hidden" id="sale_id"  name="sale_id" value="{{$sale_item->sale_id}}"/>
                              quantity in store <span class="label label-danger" id="quantity_badge"></span>   
                        </div>

                        </div>
                       
                        
                   

                    <div class="form-group">
                        <label class="col-md-4 control-label">amount</label>
                        <div class="col-md-2">
                            <input id="amount" type="text" class="form-control" name="amount" value="{{$sale_item->amount}}" >
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

$(document).ready(function(){


    var item_stock_amount=0;

    getStoreQuantitiy(parseInt($('#item_id').val()))
    
 
    
    var iniitial_quantity=parseInt($('#amount').val());
    var iniitial_id=parseInt($('#item_id').val());
var temp=0;
    setTimeout(function(){
   temp= item_stock_amount=item_stock_amount+iniitial_quantity;
}, 1000);

    
    
    $("#amount").change(function(){
        
        if( iniitial_id==parseInt($('#item_id').val())){
           item_stock_amount=temp;
            console.log(item_stock_amount);
        }
       
       
        
        if(item_stock_amount<$("#amount").val()){
          $(document).trigger("add-alerts", [
                {
                "message": $("#item option:selected").text()+"'s quanitiy in stock is "+item_stock_amount+". apply below that",
                "priority": 'danger'
                }
                ]);   $("#amount").focus();
            $("#amount").val('');
        }
        
    });

    
    
    GetSuggestions("item","name","items");

    $('#item').on('select2:select', function (evt) {
        getStoreQuantitiy(evt.params.data.id);
   
    });
    
    function getStoreQuantitiy (item_id) {
        $('#item_id').val(item_id);
        $.ajax({
            type:'GET',
            url: '/checkquantity',
            data:'q='+item_id,
            success:function(data){
                item_stock_amount=parseInt(data);
               
                $('#quantity_badge').html(item_stock_amount);
            
            }
        });
    }






});
    


</script>

@endsection 


