@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
              <a href="/quotationitems/{{$quotation->id}}" class="btn btn-info btn-sm ">back</a>
              <big>ADD ITEMS FOR quotation : {{$quotation->id}}</big></strong></big>
                  </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/quotationitems">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-4 control-label">item name</label>
                            <div class="col-sm-4">
                                <select id="item"  name="item" class="form-control" data-width="100%"></select>
                                <input type="hidden" id="item_id"  name="item_id"/>

                            </div>
                        </div>

                        <input type="hidden" id="quotation_id"  name="quotation_id" value="{{$quotation->id}}"/>
                        <input type="hidden" id="unit_price"  name="unit_price"/>
                        <input type="hidden" id="total"  name="total"/>

                        <div class="form-group">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-2">
                              quantity in store <h3><span class="label label-danger" id="quantity_badge">0</span></h3>
                            </div>

                            <div class="col-sm-2">
                              current price <h3>Rs<span class="label label-info" id="price_badge">0</span></h3>
                            </div>

                            <div class="col-sm-2">
                              total<h3>Rs<span class="label label-success" id="total_badge">0</span></h3>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">amount</label>
                            <div class="col-sm-2">
                                <input id="amount" type="text" class="form-control" name="amount" value={{old('amount')}}>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-4">
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
$(document).ready(function(){

    GetSuggestions("item","name","items");
    $('#price_badge').on('DOMSubtreeModified',GetTotalPrice);
    $('#amount').on('keyup',GetTotalPrice);
    var item_stock_amount=0;
    var days={{$quotation->days}};
    var type={{$quotation->sales_type}};// TODO: 1 means funeral 0 means other occasion

    $("#amount").keyup(validator).change(validator).blur(validator);

    function validator()
    {
        if(item_stock_amount<$("#amount").val()){
            $(document).trigger("add-alerts", [
                {
                "message": $("#item option:selected").text()+"'s quanitiy in stock is "+item_stock_amount+". apply below that",
                "priority": 'danger'
                }
                ]);
            $("#amount").focus();
            $("#amount").val('');
        }
    }

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
                GetLatestPrice(item_id,"#price_badge");
            }
        });
    }

    function GetTotalPrice(){

        var price=parseFloat($('#price_badge').html());
        var halfDays=days-1;
        var tot;
        var amount=parseInt($('#amount').val());

        if(type==1){
          if (halfDays>3) {
              tot=(price+3*(price/2))*amount;
          }
          else {
              tot=(price+halfDays*(price/2))*amount;
          }

        }
        else {
          tot=(price+halfDays*(price/2))*amount;
        }

        $('#total_badge').html(tot);
        $('#total').val(tot);
        $('#unit_price').val(price);

        validator();
    }

});

</script>

@endsection
