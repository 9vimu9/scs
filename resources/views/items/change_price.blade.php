@extends('layouts.app')

@section('head')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
@endsection

@section('content')


<div class="container ">

    <div class="row ">
        <div class="panel panel-default ">
            <div class="panel-heading">
                <big>SET ITEM PRICES</big>
                <button type="button"  id =""  class="btn btn-danger btn-sm pull-right" name="btn_no_price_items" >items without prices</button>


            </div>
                <div class="panel-body">
                    @if(count($item_prices)>0)
                        <table id="example1" class="table table-bordered table-striped" width="95%">
                            <thead>
                              <tr>
                                <th>
                                  <input  id="name_search" type="text" class="form-control" style="width:100%">
                                </th>
                                <th>
                                  <input  id="cat_search" type="text" class="form-control" style="width:100%">
                                </th>
                                <th>

                                </th>
                                <th>
                                  <input  id="user_search" type="text" class="form-control" name="amount" value="" style="width:100%">

                                </th>
                                <th>
                                  <input  type="text" class="form-control" name="amount" value="" style="width:100%">

                                </th>
                                <th></th>
                                <th></th>


                              </tr>
                                <tr>
                                    <th width="25%">name</th>
                                    <th width="15%">categoty</th>
                                    <th width="10%">current price</th>
                                    <th width="15%">changed by</th>
                                    <th width="18%">last updated</th>
                                    <th width="17%">new (Rs.)</th>
                                    <th width="18%">ddddddggggg</th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach($item_prices as $item_price)

                                    <tr>
                                        <td> <big><a href="/items/{{$item_price->item->id}}">{{$item_price->item->name}}</a></big></td>

                                        <td>{{$item_price->item->cat->name}}</td>
                                        <td>{{$item_price->price}}</td>
                                        <td>{{$item_price->user->name}}</td>
                                        <td>{{$item_price->created_at->format('Y-m-d_H:m')}}</td>
                                        <td>
                                          <input  type="text" class="form-control" name="price" value="" style="width:100%">
                                        </td>
                                        <td>
                                            {{ csrf_field() }}
                                            <button type="button"  id ="{{$item_price->item_id}}"  class="btn btn-warning btn-xs" name="more" data-toggle="modal" data-target="#modal_price_chart">More</button>
                                            <button type="button"  id ="{{$item_price->item_id}}"  class="btn btn-success btn-xs" name="save" >Save</button>



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




{{-- modal start --}}

<!-- Modal -->
<div id="modal_price_chart" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      </canvas><canvas id="myChart"></canvas>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
{{-- modal end --}}





@endsection


@section('script')

  <script>

    $("button[name='more']").click(function(){
        var item_name=$(this).closest('tr').find('td:eq(0)').text()
        var item_id=$(this).attr('id');
        $(".modal-title").html("<strong>"+item_name+"</strong> price history");
        $.ajax({
          type:'GET',
          url: '/item_price_history',
          data:"item_id="+item_id,
          success:function(data){
            var dates=new Array();
            var prices=new Array();
            data.forEach(function(entry) {
                console.log(entry);
                dates.push(entry.created_at);
                prices.push(entry.price);
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: dates,
                datasets: [{
                  label: 'price(Rs.)',
                  data: prices,
                  backgroundColor: "rgba(153,255,51,0.4)"

                }]
              }
            });

          }
      });

    });


    $('[name="save"]').click(function(){
        var clicked_button=$(this);

        var item_id=$(this).attr('id');
        var price=$(this).closest('tr').find('input[name="price"]').val();

        $.ajax({
          type: 'post',
          url: '/item_price_store',
          data: {

                  '_token': $('input[name=_token]').val(),
                  'price': price,
                  'item_id': item_id
              },
              success: function(data) {
                  if ((data.errors)) {

                      $(document).trigger("add-alerts", [
                     {
                     "message":data.errors.rejected+"<br>"+data.errors.amount,
                     "priority": 'danger'
                     }
                     ]);
                  } else {
                    $(document).trigger("add-alerts", [
                   {
                   "message":'sucessfully updated',
                   "priority": 'success'
                   }
                   ]);

                  clicked_button.closest('tr').find('td:eq(2)').text(price);
                  }
              },
          });

        });






    $(function () {

    var table=  $('#example1').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      })

      $('#name_search').on( 'keyup', function () {
        table.columns(0).search( this.value ).draw();
      });

      $('#cat_search').on( 'keyup', function () {
        table.columns(1).search( this.value ).draw();
      });

      $('#user_search').on( 'keyup', function () {
        table.columns(3).search( this.value ).draw();
      });
    })

  </script>
@endsection
