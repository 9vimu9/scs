@extends('layouts.app')


@section('head')




@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">

                @if($reportrequest->type==1)
                    <big>monthly item request report {{$reportrequest->created_at->format('M,Y')}}</big>
                @else
                    <big>quick report on {{$reportrequest->created_at->format('d-M-Y')}}</big>
                @endif

                <form action="/destroy_request_report/{{$reportrequest->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}
                   <a href="/reports/requestmonthly/{{$reportrequest->id}}" class="btn btn-danger btn-xs">print</a>
                   <input type="submit" name="delete" value="delete this report" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>

            </div>

            <div class="panel-body">

                <form class="form-horizontal" role="form" method="POST" action="/itemrequestreportsadd">
                {{ csrf_field() }}
                    <div class="row">
                        <label class="col-md-2 col-sm-2 control-label">item name</label>
                        <div class="col-md-3  col-sm-3">
                            <select id="item"  name="item" class="form-control" data-width="100%"></select>
                            <input type="hidden" id="item_id"  name="item_id" value=""/>
                            <input type="hidden" id="reportrequest_id"  name="reportrequest_id" value="{{$reportrequest->id}}"/>
                            <input type="hidden" id="amount_in_store"  name="amount_in_store" value=""/>
                        </div>

                        <div class="col-md-2  col-sm-2">
                           <span class="label label-danger" id="quantity_badge">0</span> amount in store <br>
                           <span class="label label-warning" id="max_badge">0</span> maximum capacity<br>
                           <span class="label label-success" id="reorder_badge">0</span> reorder value
                        </div>

                        <label class="col-md-1  col-sm-1 control-label">amount</label>
                        <div class="col-md-2  col-sm-2">
                            <input id="amount" type="text" class="form-control" name="amount" value={{old('amount')}}>

                        </div>
                         <div class="col-md-1  col-sm-1">
                           <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-plus"></i> add</button>

                        </div>


                    </div>

                </form>
                <hr>
  {{ csrf_field() }}

                @if(count($reportrequest->items_reportrequest)>0)
                    <table id="current" class="table table-hover table-striped"  width="75%">
                        <thead>
                            <tr>
                                <th width="25%">item name</th>
                                <th width="5%">requested quantitiy</th>
                                <th width="20%">current quantity</th>
                                <th width="10%">max</th>
                                <th width="10%">reorder</th>
                                <th width="20%"> <button type="button" id="edit_main" class="edit btn btn-warning btn-xs">save all</button></th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach($reportrequest->items as $items_reportrequest)

                                <tr id="row_{{$items_reportrequest->pivot->id}}">
                                    <td> <a href="/items/{{$items_reportrequest->id}}">{{$items_reportrequest->name}}</a></td>
                                    <td><input type="text" id="{{$items_reportrequest->pivot->id}}" class="form-control" name="requested_amount" value="{{$items_reportrequest->pivot->requested_amount}}">
                                    </td>
                                    <td>{{$items_reportrequest->pivot->amount_in_store}}</td>
                                    <td>{{$items_reportrequest->max}}</td>
                                    <td>{{$items_reportrequest->min}}</td>

                                    <td> <button type="button" id="{{$items_reportrequest->pivot->id}}" class="edit btn btn-warning btn-xs" name="save">save</button>
                                    <button type="button" id="{{$items_reportrequest->pivot->id}}" class="btn btn-danger btn-xs" name="delete">delete</button></td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                @else
                    no officers<br>click add officer button

                @endif

            </div>

        </div>

    </div>
</div>

@endsection

@section('script')
@include('layouts.suggest')

<script>

$(document).ready(function(){

    var table=$('#current').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true
    })

    GetSuggestions("item","name","items");



    $("#amount").change(function(){
        var current= parseInt($('#quantity_badge').text());
        var max= parseInt($('#max_badge').text());
        console.log(current+" "+max);


        if(  $('#item_id').val()>0 && max-current<$("#amount").val()){


            $(document).trigger("add-alerts", [
                {
                "message":'you applied more than can request for '+$("#item option:selected").text(),
                "priority": 'warning'
                }
                ]);

        }

    });



    $('#item').on('select2:select', function (evt) {
        var item_id=evt.params.data.id;
        getStoreQuantitiy(item_id);

       //  GetColumnData (input_id,column,table,output_device)
        GetColumnData(item_id,"max","items","#max_badge");
        GetColumnData(item_id,"reorder","items","#reorder_badge");

    });

    function getStoreQuantitiy (item_id) {
        $('#item_id').val(item_id);
        $.ajax({
            type:'GET',
            url: '/checkquantity',
            data:'q='+item_id,
            success:function(data){
                parseInt(data);

                $('#quantity_badge').html(data);
                $('#amount_in_store').val(data);

            }
        });
    }



$('#edit_main').click(function(){ all_child_save.click() });





var all_child_save=$('[name="save"]').click(function(){


        $.ajax({
            type: 'post',
            url: '/itemrequestreportsupdate',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $(this).attr('id'),
                'requested_amount': $(this).closest('tr').find('input[name="requested_amount"]').val()
            }
           ,
            success: function(data) {
                 $(document).trigger("add-alerts", [
                {
                "message":'sucessfully updated',
                "priority": 'success'
                }
                ]);
                }
        });
    });

    var all_child_delete=$('[name="delete"]').click(function(){
        var id=$(this).attr('id');

        $.ajax({
            type: 'post',
            url: '/itemrequestreportsdelete/',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $(this).attr('id')

            },

            success: function(data) {
              table.row($('#row_'+id)).remove().draw();
               $(document).trigger("add-alerts", [
                {
                "message":'sucessfully removed',
                "priority": 'success'
                }
                ]);
            }
        });
    });

















});



</script>

@endsection
