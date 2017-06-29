@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE ORDER <span class="label label-primary"><big>#{{$order->id}}</big></span></big>
           &nbsp&nbsp&nbsp&nbsp
                supplier : <strong class="text-info"><big>{{$order->supplier->name}}</big></strong>&nbsp&nbsp
                contact : <strong>{{$order->supplier->tel}}</strong>&nbsp&nbsp
                order created at: <strong><big>{{$order->date}}</big></strong>&nbsp&nbsp
                deadline : <strong class="text-danger"><big>{{$order->deadline}}</big></strong>&nbsp&nbsp
                 <form action="/orders/{{$order->id}}" class="form-group pull-right" method="POST">
                  <a href="/orders/{{$order->id}}/edit" class="btn btn-warning btn-xs ">edit order</a>&nbsp&nbsp
              
                    {{ csrf_field() }}
                    <input type="submit" name="delete" value="delete order" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            
            
            </div>
            <div class="panel-body">
           
            
             <form class="form-horizontal" role="form" method="POST" action="/itemorders">
                        {{ csrf_field() }}
                                           
                            <label class="col-md-1 col-sm-1 control-label">item</label>
                            <div class="col-md-2 col-sm-2">
                            <select id="item"  name="item" class="form-control" data-width="100%"></select>
                            <input type="hidden" id="item_id" value="" name="item_id"/>
                            <input type="hidden" id="order_id" value="{{$order->id}}" name="order_id"/>
                            </div>
                      
                            <label class="col-md-1 col-sm-1 control-label">amount</label>
                            <div class="col-md-2 col-sm-2">
                                <input id="amount" type="text" class="form-control" name="amount">
                            </div>
                                               
                            <label class="col-md-1 col-sm-1 control-label">price (Rs)</label>
                            <div class="col-md-2 col-sm-2">
                                <input id="unit_price" type="text" class="form-control" name="unit_price">
                                
                            </div>
                             <div class="col-md-2 col-sm-2"> <label class="control-label">&nbsp</label><span class="badge" id="total"></span></div>  
                            
                            <div class="col-md-1 col-sm-1">
                                <button type="submit" class="btn btn-primary btn-sm ">
                                    <i class="fa fa-btn fa-plus"></i> add
                                </button>
                            </div>
                       
 
                    </form>
                  
                    {{-- {{var_dump($order->item_order)}} --}}
            </div>
        
         @if(count($order->item_order)>0)
                    <table class="table table-striped table-hover" >
                    <thead>
                    <tr>
                        <th>item name</th>
                        <th>amount</th>
                        <th>unit price</th>
                        <th></th>
                    </tr>
                    </thead>
                        @foreach($order->item_order as $item_order)
                            <tr>
                                <td>{{$item_order->item_id}}</td>
                                <td>{{$item_order->amount}}</td>
                                 <td>{{$item_order->unit_price}}</td>

                                <td> 
                                   

                                    <form action="/item_order/{{$item_order->id}}" class="pull-right" method="POST">
                                        {{ csrf_field() }}
                                        <a href="/item_order/{{$item_order->id}}/edit" class="btn btn-warning btn-xs">edit</a>&nbsp&nbsp
                                        <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                           
                               
                              
                            
                    @endforeach
                    </table>
                        {{-- {{$all_items->links()}} --}}
                    @else
                    no items <br>click add item button
                    
                    @endif







        </div>
    </div>
    
</div>







@endsection 

@section('script')
 {{-- auto suggest --}}
 <script>
        var reorder=0;
        var itemTotal=0;
        
  $("#price,#amount").keyup(function(){
      var price=$('#price').val();
      var amount=$("#amount").val();
       itemTotal=price*amount;
      $('#total').html('<h6><strong>Rs: '+itemTotal+'</strong></h6>');
    });

function checkReorder(){
        if(reorder<$("#amount").val()){
        alert($( "#item option:selected" ).text()+"'s maximum reorder value is "+reorder+". apply below that")
     $("#amount").focus();
        }
    }
    $("#amount").keyup(checkReorder);

    
  
 </script>

    @include('layouts.suggest')

    <script>
   
        GetSuggestions("item","items");

        $('#item').on('select2:select', function (evt) {
            var seletedItemId=evt.params.data.id;
            console.log(seletedItemId);
            
            $('#item_id').val(seletedItemId);



          
            $.ajax({
               type:'GET',
               url: '/checkreorder',
               data:'q='+seletedItemId,
               success:function(data){
                reorder=data;
                  console.log(reorder);
               }
            });
       

            




        });

       
    </script>
    {{-- end of autosuggest --}}
@endsection 




