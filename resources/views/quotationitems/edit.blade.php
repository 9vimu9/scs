@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
              <big>EDIT ITEMS FOR quotation : {{$quotation_id}}</big></strong></big>
                <a href="/quotationitems/{{$quotation_id}}" class="btn btn-info btn-sm pull-right">back</a>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/quotationitems">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label">item name</label>
                            <div class="col-md-4">
                                <select id="item"  name="item" class="form-control" data-width="100%"></select>
                                <input type="hidden" id="item_id"  name="item_id"/>
                                <input type="hidden" id="quotation_id"  name="quotation_id" value="{{$quotation_id}}"/>
                            </div>
                            quantity in store <span class="label label-danger" id="quantity_badge">0</span>

                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">amount</label>
                            <div class="col-md-2">
                                <input id="amount" type="text" class="form-control" name="amount" value={{old('amount')}}>
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

$(document).ready(function(){
    var item_stock_amount=0;

    getStoreQuantitiy(parseInt($('#item_id').val()))

    var iniitial_quantity=parseInt($('#amount').val());
    var iniitial_id=parseInt($('#item_id').val());
    var temp=0;
    setTimeout(function(){temp= item_stock_amount=item_stock_amount+iniitial_quantity;}, 1000);

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
                ]);
            $("#amount").focus();
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
