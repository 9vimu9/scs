@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE SALES</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/sales">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-sm-5 control-label">for quotation no</label>
                            <div class="col-sm-2">
                                <select id="quotation_no"  class="form-control" data-width="100%">

                                </select>
                                <input type="hidden" id="quotation_id" name="quotation_id" value="" />
                            </div>
                            <span class="badge" id="funeral_badge"></span>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">from</label>
                            <div class="col-sm-2">
                                <input id="datepicker" type="text" class="datepicker form-control" name="deliver_date" value="{{date('Y-m-d')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">to</label>
                            <div class="col-sm-2">
                                <input id="datepicker2" type="text" class="datepicker form-control" name="return_date" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">customer</label>
                            <div class="col-xs-3">
                               <select id="customer_name"  class="form-control" data-width="100%">
                                 {{-- <option value="1" selected="">

                                 </option> --}}
                               </select>
                               <input type="hidden" id="customer_id" name="customer_id" value="" />
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-xs-5 control-label">service charge(Rs)</label>
                            <div class="col-xs-2">
                                <input id="service_charge" type="text" class="form-control" name="service_charge" value={{old('service_charge')}}>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">advance(Rs)</label>
                            <div class="col-xs-2">
                                <input id="advance" type="text" class="form-control" name="advance" value={{old('advance')}}>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-5 control-label">discount(%)</label>
                            <div class="col-xs-1">
                                <input id="discount" type="text" class="form-control" name="discount" value={{old('discount')}}>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-5">
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

@section('script')
 {{-- auto suggest --}}
    @include('layouts.suggest');

    <script>
       GetSuggestions("customer_name","name","customers");

       var customer_select= $('#customer_name').on('select2:select', function (evt) {
            $('#customer_id').val(evt.params.data.id);
        });

        GetSuggestions("quotation_no","id","quotations");

        $('#quotation_no').on('select2:select', function (evt) {
          var quotation_id=evt.params.data.id;
          $('#quotation_id').val(quotation_id);
          var column='id';
          var table='quotations';
          $.ajax({
              type:'GET',
              url: '/suggest',
              data:"?q="+quotation_id+"&c="+column+"&t="+table+"&type=rowValue",
              success:function(data){

                  var serviceCharge=data[0].service_charge;
                  var advance=data[0].advance;
                  var discount=data[0].discount;
                  var days=data[0].days;
                  var isFuneral=data[0].sales_type=='1' ? 'funeral' : 'other occasion';
                  var customer_id=data[0].customer_id;
                  var customer_name=  GetSingleValue (customer_id,'name','customers',null);

                  var result = new Date($('#datepicker').val());
                  result.setDate(result.getDate() + days);
                  var deliveryDate=result.getFullYear()+'-'+(result.getMonth() + 1) + '-' + result.getDate();

                  var option = new Option(customer_name, '0', true, true);
                  customer_select.append(option);
                  customer_select.trigger('change');

                  $('#datepicker2').val(deliveryDate);
                  $('#service_charge').val(serviceCharge);
                  $('#advance').val(advance);
                  $('#discount').val(discount);
                  $('#customer_id').val(customer_id);
                  $('#funeral_badge').html('<font size="5">'+isFuneral+'</font>');// NOTE: becasuse salestype 1 means funeral

              }
          });

        });
    </script>
    {{-- end of autosuggest --}}
@endsection
