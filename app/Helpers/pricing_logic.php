<?php

function ItemTotalPriceUpdate($object)
{

  foreach ($object->items as $object_item){
    $unit_price=$object_item->pivot->unit_price;
    $half_price=$unit_price/2;
    $amount=$object_item->pivot->amount;
    $new_tot;
    $base_class=class_basename(get_class($object));
    if ($base_class=='sales') {
      $delever_date = strtotime($object->deliver_date );
      $actual_return_date=$object->actual_return_date=='0000-00-00' ? $object->return_date : $object->actual_return_date;
      $actual_return_date = strtotime($actual_return_date);
      $days = ($actual_return_date - $delever_date)/86400;// == return sec in difference
      $sale_type=$object->quotation->sales_type;
    }
    else {
      $days=$object->days-1;
      $sale_type=$object->sales_type;
    }
    if ($sale_type)// NOTE: this is true means new salestype is funeral
    {
      $days=$days>3 ? 3 : $days;
    }

    $new_tot=($unit_price+$days*$half_price)*$amount;

    DB::table(str_singular($base_class).'_items')
      ->where('id', $object_item->pivot->id)
      ->update(['total' => $new_tot]);
  }
}



 ?>
