@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row ">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <big>ITEMS</big>
                <a href="/items/create" class="pull-right btn btn-primary btn-sm">add item</a>
            </div>
                <div class="panel-body">
                    @if(count($all_items)>0)
                        <table id="example1" class="table table-bordered table-striped" width="75%">
                            <thead>
                                <tr>
                                    <th width="25%">name</th>
                                    <th width="15%">categoty</th>

                                    <th width="15%">current price</th>

                                    <th width="15%"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($all_items as $item)
                                    <tr>
                                        <td> <big><a href="/items/{{$item->id}}">{{$item->name}}</a></big></td>

                                        <td>{{$item->cat->name}}</td>
                                        <td>{{$item->prices[count($item->prices)-1]->price}}</td>
                                        <?php // NOTE: at ItemsController->index we set orderby as updated_at desc so $item->prices array created at same manner (updated_at desc so 0th index is the last price change)  ?>


                                        <td>
<?php // NOTE:ishut>0 means its =hut_id ?>

                                        <form action="/items/{{$item->id }}" class="pull-right" method="POST">
                                            {{ csrf_field() }}
                                            <a href="{{ $item->ishut>0 ? "/huts/".$item->ishut : "/items/".$item->id }}/edit" class="btn btn-warning btn-xs">edit</a>
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

    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection
