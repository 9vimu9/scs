@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>HUTS</big>
                <a href="/huts/create" class="pull-right btn btn-primary btn-sm">create new hut</a>
            </div>
                <div class="panel-body">
                    @if(count($huts)>0)
                     <table class="table table-striped table-hover" style="width: 75%" >
                    <thead>
                        <tr>
                            <th style="width: 25%">name</th>
                            <th style="width: 20%">category</th>
                            <th style="width: 20%">price(Rs)</th>
                            <th style="width: 20%">created at</th>
                            <th style="width: 20%"></th>
                        </tr>
                    </thead>
                        @foreach($huts as $hut)
                            <tr>
                                <td> {{$hut->item->name}}</td>
                                <td> {{$hut->item->cat->name}}</td>
                                <td>{{$hut->item->prices[count($hut->item->prices)-1]->price}}</td>
                                  <?php // NOTE: at ItemsController->index we set orderby as updated_at desc so $item->prices array created at same manner (updated_at desc so 0th index is the last price change)  ?>
                                <td>{{$hut->created_at->format('Y-m-d_H:m')}}</td>

                                <td>
                                  {{-- <form action="/huts/{{$hut->id }}" class="pull-right" method="POST">
                                      {{ csrf_field() }} --}}
                                      <a href="/hutitems/{{$hut->id}}" class="btn btn-warning btn-xs">more</a>

                                      {{-- <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                      <input type="hidden" name="_method" value="DELETE"> --}}
                                  {{-- </form> --}}
                                </td>
                            </tr>

                    @endforeach
                    </table>

                    @else
                    no huts<br>click add new hut button

                    @endif
                </div>

        </div>

    </div>
</div>

@endsection
