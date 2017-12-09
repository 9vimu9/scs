@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
              <a href="/saleitems/{{$sale_item->sale->id}}" class="btn btn-info btn-sm ">back</a>
              <big>EDIT ITEMS OF SALE ORDER #{{$sale_item->sale->id}}</big></strong></big>
                  </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/saleitems/{{$sale_item->id}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">item name</label>
                            <div class="col-sm-4">
                                <select id="item"  name="item" class="form-control" data-width="100%">
                                  <option value="{{$sale_item->item_id}}" selected="{{$sale_item->item->name}}">
                                      {{$sale_item->item->name}}
                                  </option>
                                </select>
                                <input type="hidden" id="item_id"  name="item_id" value="{{$sale_item->item_id}}"/>

                            </div>
                        </div>

                        <input type="hidden" id="sale_id"  name="sale_id" value="{{$sale_item->sale->id}}"/>
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
                                <input id="amount" type="text" class="form-control" name="amount" value={{$sale_item->amount}}>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-4">
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
    var deliver_date='{{$sale_item->sale->deliver_date}}';
    var return_date='{{$sale_item->sale->return_date}}';
    var actual_return_date='{{$sale_item->sale->actual_return_date}}';
    if (actual_return_date=='0000-00-00') {
      actual_return_date=return_date;
    }
    deliver_date = new Date(deliver_date);
    actual_return_date = new Date(actual_return_date);
    var timeDiff = Math.abs(actual_return_date.getTime() - deliver_date.getTime());
    var days = Math.ceil(timeDiff / (1000 * 3600 * 24));
    var type={{$sale_item->sale->quotation->sales_type}};// NOTE: 1 means funeral 0 means other occasion

    var iniitial_quantity=parseInt($('#amount').val());
    var iniitial_id=parseInt($('#item_id').val());
    var temp=0;
    getStoreQuantitiy($('#item_id').val());//this method show values at startup
    setTimeout(function(){temp= item_stock_amount=item_stock_amount+iniitial_quantity;}, 1000);

    $("#amount").keyup(validator).change(validator).blur(validator);
    GetSuggestions("item","name","items");
    $('#price_badge').on('DOMSubtreeModified',GetTotalPrice);
    $('#amount').on('keyup',GetTotalPrice);

    //;

    function validator()
    {
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
