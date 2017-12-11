@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row ">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <big>STORE</big>
                <a href="/items/create" class="pull-right btn btn-primary btn-sm">add item</a>
            </div>
                <div class="panel-body">
                    @if(count($all_items)>0)
                        <table id="store_index" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th width="20%">name</th>
                                    <th width="20%">categoty</th>
                                    <th width="10%">initial amount</th>
                                    <th width="10%">stock amount</th>
                                    <th width="10%">current amount</th>
                                    <th width="10%">rejected amount</th>
                                    <th width="12%">current price</th>
                                    <th width="25%"></th>
                                </tr>
                            </thead>
                            <tfoot>
                              <tr>

                                  <th ></th>
                                  <th ></th>
                                  <th ></th>
                                  <th ></th>
                                  <th ></th>
                                  <th ></th>
                                  <th ></th>
                                  <th ></th>
                              </tr>
                            </tfoot>
                            <tbody>
                                @foreach($all_items as $item)
                                    <tr>
                                      @php
                                        $amount_array=quantity_per_item($item->id);
                                      @endphp
                                        <td> <big><a href="/items/{{$item->id}}">{{$item->name}}</a></big></td>

                                        <td>{{$item->cat->name}}</td>
                                        <td>{{$amount_array['initial_amount']}}</td>
                                        <td>{{$amount_array['stock_amount']}}</td>
                                        <td>{{$amount_array['current_amount']}}</td>
                                        <td>{{$amount_array['rejected_amount']}}</td>

                                        <td>{{$item->prices[count($item->prices)-1]->price}}</td>
                                        <?php // NOTE: at ItemsController->index we set orderby as updated_at desc so $item->prices array created at same manner (updated_at desc so 0th index is the last price change)  ?>
                                        <td>
                                        <form action="/items/{{$item->id }}" class="pull-right" method="POST">
                                            {{ csrf_field() }}
                                            <a href="{{ $item->hut_id>0 ? "/huts/".$item->hut_id : "/items/".$item->id }}/edit" class="btn btn-warning btn-xs">edit</a>
                                            <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else
                    no items<br>click add item button

                    @endif
                </div>

        </div>

    </div>
</div>

@endsection


@section('script')
<script>
  $(function () {

    var store_index=$('#store_index').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

    var searchArray = {
      0:"name",//table column:id naem
      1:"cat"//table column:id naem
        };
    AddColumnSearch(store_index,searchArray,'#store_index');
  })
</script>
@endsection
