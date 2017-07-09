@include('layouts.reportheader')
 


    <?php $sub_tot=0;?>
    @if(count($order->item_order)>0)
        @foreach($order->items as $item_order)
            <?php
                $sub_tot+=$item_order->pivot->amount*$item_order->pivot->unit_price;
            ?>
        @endforeach
    @endif
print time: {{date("Y-m-d H:i:sa")}} report create time:{{$order->created_at->format('Y-m-d H:i:sa')}} order id:{{$order->id}}


   <div class="wrapper">
        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-7">
                <p>දුරකතනය:2618100</p>
            </div>
            <div class="col-xs-4">
               <p>ඇනවුම් අංකය | order No. <font size="5">{{$order->id}}</font></p> 
        
            </div>
        </div>
        <div class="row">
        <div class="col-xs-1"></div>
            <div class="col-xs-10">
            <h2>  <p class="text-center" ><strong>කැස්බෑව නගර සභාව<br>පිලියන්දල<br>KESBEWA URBAN COUNCIL</p></strong></h2>  
        
            </div>
        </div>

        <div class="row">
         <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <p><h4>{{$order->supplier->name}}</h4></p> 
                <p><h4>{{$order->supplier->address}}</h4></p> 
                <p><h4>{{$order->date}}<h4></p> 
        
            </div>
        </div>

        <div class="row">
         <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <p>
                    පහත විස්තර සදහන් ද්‍රව්‍ය මෙහි සදහන් දින සිට දින {{(strtotime($order->deadline)-strtotime($order->date))/86400}} ක් ඇතුලත මෙම කාර්යාලය වෙත සපයා ගෙවීම සදහා බිල්පත් ඉදිරිපත් කරන්න. අදාල ද්‍රව්‍ය රාජකාරි වෙලාවන් තුලදි සභාවේ ගබඩාව වෙත ගෙනවිත් භාර දිය යුතුය.
                    නියමිත කාල සීමාව ඇතුලත මෙම ඇනවුම් සපුරාලීමට ඔබ අපොහොසත් වුවහොත් වෙනත් කිසිදු දැනුම් දීමකින් තොරව ඇනවුම අවලංගු  වූවා සේ, සැලකීමට කරුණාකර සටහන් කර ගන්න<br>
                    please supply the following materials within {{(strtotime($order->deadline)-strtotime($order->date))/86400}} dates hereof an submit the bill and payment Materials should be delivered to the stores here durung office hours Please note that if this order in not executed within stipulated time herein.This order wil treated as canceled without further notice.

                </p> 
     

<style>

</style>
            </div>
        </div>
        <div class="panel-body">
            @if(count($order->items)>0)
                <table class="table table-bordered "style="width: 75%" >
                    <tr>
                        <td class="hiddencell"></td>
                        <td class="hiddencell"></td>
                        <td class="hiddencell"></td>
                        <td><font size="5">Rs. {{$sub_tot}}</font></td>
                    </tr>
                    <tr>
                        <th style="width: 10%">ප්‍රමාණය<br>quantitiy</th>
                        <th style="width: 30%">ද්‍රව්‍ය පිලිබඳ විස්තර<br>description of articles</th>
                        <th style="width: 15%">ගණන<br>rate</th>
                        <th style="width: 20%">මුදල<br>amount</th>
                            
                    </tr>

                    @foreach($order->items as $item_order)
                        <tr>
                            <td>{{$item_order->pivot->amount}}</td>
                            <td>{{$item_order->name}}</a></td>
                            <td>{{$item_order->pivot->unit_price}}</a></td>
                            <td>{{$item_order->pivot->amount*$item_order->pivot->unit_price}}</td>
                        </tr>
                    @endforeach
                </table>
                
            @else
            no items
            
            @endif
        </div>
        <div class="row">
             <div class="col-xs-1"></div>
            <div class="col-xs-11">
               <p >...............................<br>  කැස්බෑව නගර සභාව </p> 
        
            </div>
        </div>

         

    </div>


</body>


</html>


  