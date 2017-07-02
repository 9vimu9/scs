@extends('layouts.app')



@section('content')
                 
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>CREATE lOAN ISSUE RETURNS NOTE <span class="label label-primary"><big>#{{$loanissue->loanissuereturn->id}}</big></span></big>
                &nbsp&nbsp    
                for loan account issue : <strong class="text-info"><big><a href="/itemloanissues/{{$loanissue->id}}">#{{$loanissue->id}}</a></big></strong>
                &nbsp&nbsp&nbsp&nbsp
               
                officer : <strong class="text-info"><big>{{$loanissue->officer->name}}</big></strong>
                <form action="/loanissuereturns/{{$loanissue->loanissuereturn->id}}" class="form-group pull-right" method="POST">
                    {{ csrf_field() }}
                  &nbsp&nbsp
                    <a href="/loanissuereturns/{{$loanissue->loanissuereturn->id}}/edit" class="btn btn-warning btn-xs ">edit this return</a>&nbsp&nbsp
                    <input type="submit" name="delete" value="delete this return" class="btn btn-danger btn-xs">
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            
            
            </div>
            <div class="panel-body">
            
            
            @if(count($loanissue->items)>0)
                <table class="table table-bordered table-hover" style="width: 80%" >
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align: center" ><big>issued items details</big></th>
                            <th colspan="3"style="text-align: center"><big>returning data</big></th>
                        </tr>

                        <tr>
                            <th style="width: 15%">item name</th>
                           
                            <th style="width: 8%">amount</th>

                            <th style="width: 8%">received amount</th>
                            <th style="width: 8%">rejected amount</th>
                             <th style="width: 8%">actual amount</th>
                             
                               <th style="width: 15%"></th>
                        </tr>
                    </thead>

 

                    @foreach($loanissue->items as $item_loanissue)
                    
                        <tr >
                            <td>{{$item_loanissue->name}}</td>
                           
                            <td>{{$item_loanissue->pivot->amount}}</td> 

                            <?php

                               
                                $item_loanissuereturn_id=0;
                                $item_loanissuereturn_amount=0;
                                $item_loanissuereturn_reject=0;
                               
                                if(count($loanissue->loanissuereturn->items)>0){                   
                           
                                    foreach($loanissue->loanissuereturn->items as $item_loanissuereturn){
                                        if($item_loanissuereturn->pivot->item_id===$item_loanissue->pivot->item_id){
                                            // {{-- mekata awwa kiyanne e item_order ekata adaalawa item_reeive ekak thibe kiyana eka --}}
                                            // <td>badu atha</td> 
                                           
                                            $item_loanissuereturn_id=$item_loanissuereturn->pivot->id;
                                            $item_loanissuereturn_amount=$item_loanissuereturn->pivot->amount;
                                            $item_loanissuereturn_reject=$item_loanissuereturn->pivot->rejected;
                                          
                                        }
                                       
                                    }
                                }
                               
                            ?>

                            @if($item_loanissuereturn_id===0)
                            <form action="/itemloanissuereturns" class="form-inline" method="POST">
                                    {{ csrf_field() }}
                                    <td><input id="amount" type="text" class="form-control" name="amount" ></td>
                                    <td><input id="rejected" type="text" class="form-control" name="rejected"></td>
                                     <input type="hidden" name="item_id" value="{{$itemloanissuereturn->pivot->item_id}}">
                                      <input type="hidden" name="loanissuereturns_id" value="{{$loanissue->loanissuereturn->id}}">
                                    <td>{{$item_loanissue->item_id}}</td>/\/\
                                    <td></td>
                                    
                                   <td>
                                        <input type="submit" name="delete" value="add" class="btn btn-primary btn-xs">
                                   </td>
                                </form>
                                
                            @else
                               
                                <form action="/itemreceives/{{$item_receive_id}}" class="pull-right" method="POST">
                                    {{ csrf_field() }}
                                    <td><input id="amount" type="text" class="form-control" name="amount" value="{{$item_receive_amount}}"></td>
                                    <td><input id="rejected" type="text" class="form-control" name="rejected" value="{{$item_receive_reject}}"></td>
                                   
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="receive_id" value="{{$item_receive->pivot->receive_id}}">
                                    <input type="hidden" name="item_id" value="{{$item_receive->pivot->item_id}}">
                                   <td>
                                    <input type="submit" name="edit" value="update" class="btn btn-warning btn-xs">
                                   
                                </form>
                                 <form action="/itemreceives/{{$item_receive_id}}" class="pull-right" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                   </td>
                                </form>
                            @endif
                            
                           
                        </tr>
                    @endforeach
                  
                </table>
                 
                {{-- {{$all_items->links()}} --}}
            @else
                <a href="/itemorders/create/{{$order->id}}" class="btn btn-info btn-xs"> <i class="fa fa-btn fa-plus"></i>add new item</a>
                
            @endif      
                   
            </div>
        
            

        </div>
    </div>
    
</div>


@endsection 

@section('script')
<script>
$(document).ready(function(){
$('.form-control').keyup(function(){
       
      
        var amount=  $(this).parents('tr:first td:nth-child(5)')context.text();
         var amodunt=  $(this).parents('tr:first td:nth-child(4)').text();
     //   var actual_amount=amount-rejected;
        console.log(amount+" "+amodunt);
     // $(this).closest('tr').find("td:eq(6)").text(actual_amount);
    });
    });



</script>
@endsection


