@extends('layouts.app')


@section('head')


 <link rel="stylesheet" href="{{ asset('css/checkbox.css') }}" >

@endsection

@section('content')

          
            <div class="panel-body">
            @if(count($items)>0)
                <table id="current" class="table table-hover table-striped"  width="100%">
                    <thead>
                        <tr>
                            <th width="25%">name</th>
                            <th width="5%">now</th>
                            <th width="10%">reorder</th>
                            <th width="15%">category</th>
                            <th width="10%">code</th>
                            <th width="10%">location</th>

                            <th width="8%">max</th>

                            <th width="8%">min</th>
                            <th width="20%">add

                                        <div class="material-switch pull-right">
                                            <input id="mainAdd" name="mainAdd" type="checkbox" />
                                            <label for="mainAdd" class="label-default"></label>
                                        </div>



                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($items as $item)
                            @if(($item->reorder-$item->current)>=0)

                                <tr>
                                    <td> <a href="/items/{{$item->id}}">{{$item->name}}</a></td>
                                    <td>{{$item->current}}</td>
                                    <td>{{$item->reorder}}</td>
                                    <td>{{$item->cat->name}}</td>

                                    <td>{{$item->code}}</td>
                                    <td>{{$item->location}}</td>

                                    <td>{{$item->max}}</td>

                                    <td>{{$item->min}}</td>

                                    <td>

                                        <div class="material-switch ">
                                            <input id="toreport_{{$item->id}}" name="toreport" class="to_report" type="checkbox" />
                                            <label for="toreport_{{$item->id}}" class="label-danger"></label>
                                        </div>
                                    </td>
                                </tr>



                            @endif
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

@section("script")
<script>
$(document).ready(function() {

    $("#to_this_month_button, #to_quick_button").click(function() {
        var selected_ids=[];
        $('.to_report').each(function(){
            if(this.checked){
                var item_id=$(this).attr('id').split("_")[1];
                selected_ids.push(item_id);


            }

        })

        $("#selected_ids").val(selected_ids);
    });




     $('#mainAdd').change(function(){
          $('.to_report').prop("checked", this.checked);

     });

    $('#current').DataTable( {
        "columnDefs": [{"targets": 8,"orderable": false}],
        "order": [[ 1, "asc" ]],
         "createdRow": function ( row, data, index ) {
             var val=255;
             var diffrence=data[2]-data[1];
             if(diffrence>0){
                val=265-(diffrence/data[6])*255-50;
                val=parseInt(val);

             }
             console.log(val);


                $('td', row).eq(1).css({'font-size':' 120%',"font-weight": "bold", "background-color": "rgb(200, "+val+",100 )"});

        }
    } );
//window.onload = function() { window.print(); }
});

</script>

  @endsection
