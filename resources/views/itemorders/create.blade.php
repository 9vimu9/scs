@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>ORDER #{{$order_id}} ADD ITEMS</big></strong></big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/itemorders">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label class="col-md-4 control-label">item name</label>
                            <div class="col-md-4">
                                 <select id="item"  name="item" class="form-control" data-width="100%"></select>
                                 <input type="hidden" id="item_id"  name="item_id"/>
                                  <input type="hidden" id="order_id"  name="order_id" value="{{$order_id}}"/>

                            </div>

                               {{-- reorder quantity <span class="label label-danger" id="reorder_badge"></span> --}}

                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">amount</label>
                            <div class="col-md-2">
                                <input id="amount" type="text" class="form-control" name="amount" value={{old('amount')}}>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">unit price</label>
                            <div class="col-md-2">
                                <input id="unit_price" type="text" class="form-control" name="unit_price" value={{old('unit_price')}}>
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
                                    <i class="fa fa-btn fa-plus"></i> add
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

             $(document).trigger("add-alerts", [
            {
                "message": "please select your item from item box",
                "priority": 'danger'
            }
            ]);
        } else{

            if(reorder<$("#amount").val()){

                $(document).trigger("add-alerts", [
                {
                "message": $( "#item option:selected" ).text()+"'s maximum reorder value is "+reorder+". apply below that",
                "priority": 'danger'
                }
                ]);
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
