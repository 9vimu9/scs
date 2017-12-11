<?php

 function quantity_per_item($item_id)
{

  $item=App\item::find($item_id);
  $sale_return_data=$item->sale_items()->with('returning_item')->get();
  // {"id":9,"amount":10,"item_id":2,"sale_id":14,"created_at":"2017-12-09 17:04:43","updated_at":"2017-12-09 17:04:43","unit_price":"333.00","total":"6660.00","user_id":1,"returning_item":{"id":74,"amount":9,"sale_item_id":9,"returning_id":44,"created_at":"2017-12-10 02:04:03","updated_at":"2017-12-10 02:04:03"}}
  $item_returning_amount=0;
  $returned_sold_amount=0;//sale_item amount if its have a returning_Amount/returning_item athi sale_item wala amount wala ekathuwa
  $sold_not_returned_amount=0;
  foreach ($sale_return_data  as $sale_return ) {
    $returning_item=$sale_return->returning_item;
    if(!is_null($returning_item)){//this have returning item
      $item_returning_amount+=$returning_item->amount;
      $returned_sold_amount+=$sale_return->amount;
    }
    else {
      $sold_not_returned_amount+=$sale_return->amount;
    }

  }

  $item_initial_quantity = $item->initial_quantity;


  $item_rejected_amount=$returned_sold_amount-$item_returning_amount;
  $item_stock_amount=$item_initial_quantity-$item_rejected_amount;
  $item_current_amount=$item_stock_amount-($sold_not_returned_amount);

  $data_Array= ['rejected_amount'=>$item_rejected_amount,
          'stock_amount'=>$item_stock_amount,
          'current_amount'=>$item_current_amount,
          'not_returned'=>$sold_not_returned_amount,
          'initial_amount'=>$item_initial_quantity
        ];
// var_dump($data_Array);
        return $data_Array;
}


 ?>
