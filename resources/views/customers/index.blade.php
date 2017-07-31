@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <big>customers</big>
                <a href="/customers/create" class="pull-right btn btn-primary btn-sm">add customer</a>
            </div>
                <div class="panel-body">
                    @if(count($all_customers)>0)
                     <table id="all_customers_table" class="table table-striped table-hover"style="width: 95%" >
                     <thead>
                        <tr>
                            <th style="width: 25%">name</th>
                            <th style="width: 10%">NIC</th>
                            <th style="width: 30%">address</th>
                            <th style="width: 10%">tel 1</th>
                            <th style="width: 10%">tel 2</th>
                            <th style="width: 25%">email</th>

                            <th style="width: 20%">qqqqqqqqqqq</th>

                        </tr>
                      </thead>
                      <tbody>
                        @foreach($all_customers as $customer)
                            <tr>
                                <td> <big><a href="/customers/{{$customer->id}}">{{$customer->name}}</a></td>
                                <td>{{$customer->nic}}</td>
                                <td>{{$customer->address}}</td>
                                <td>{{explode("_",$customer->tel)[0]}}</td>
                                <td>{{explode("_",$customer->tel)[1]}}</td>
                                <td>{{$customer->email}}</td>

                                <form action="/customers/{{$customer->id}}" class="pull-right" method="POST">
                                        {{ csrf_field() }}
                                        <td> <a href="/customers/{{$customer->id}}/edit" class="btn btn-warning btn-xs">edit</a>
                                        <input type="submit" name="delete" value="remove" class="btn btn-danger btn-xs">
                                        <input type="hidden" name="_method" value="DELETE">
                                </form>
                                </td>
                            </tr>




                        @endforeach
                    </tbody>
                  </table>

                    @else
                    no customers<br>click add customer button

                    @endif
                </div>

        </div>

    </div>
</div>

@endsection

@section('script')

  <script>

    $(document).ready(function(){
      $('#all_customers_table').DataTable({
        'paging'      : false,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : false,
        'autoWidth'   : false

      })








    });
  </script>
@endsection
