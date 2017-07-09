@include('layouts.reportheader')



 
print time: {{date("Y-m-d H:i:sa")}} report create time:{{$issue->created_at->format('Y-m-d H:i:sa')}} issue id:{{$issue->id}}


   <div class="wrapper">
        <div class="row">
        <div class="col-xs-1"></div>
            <div class="col-xs-10">
            <h3>  <p class="text-center" >කැස්බෑව නගර සභාව-පිලියන්දල<br><u><font size="6">නිකුත් කිරීමේ නියෝගය</font></u></p></h2>
        
            </div>
        </div>

        <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-11">
                <p>{{$issue->description}} වැඩ සදහා පහත සදහන් ද්‍රව්‍ය {{$issue->issue_date}} දින ඉල්ලුම්පතකින් ඉල්ලා ඇත.</p>
            </div>
            
        </div>

         <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-7">
              <p><strong>අංකය : <font size="4">{{$issue->id}}</font></strong></p>
            </div>
            
            <div class="col-xs-4">
               <p><strong><font size="3">{{$issue->officer->name}}</font><br>ඉල්ලුම් කරන නිලධාරි තැන</strong></p> 
            </div>
            
        </div>

        
        <div class="panel-body">
            @if(count($issue->items)>0)
                <table class="table table-bordered "style="width: 50%" >
                    
                    <tr>
                        <th style="width: 50%">ද්‍රව්‍ය විස්තරය</th>
                        <th style="width: 15%">code</th>
                        <th style="width: 15%">ප්‍රමාණය</th>
                     
                            
                    </tr>

                    @foreach($issue->items as $issue_item)
                        <tr>
                            <td>{{$issue_item->name}}</td>
                            <td>{{$issue_item->code}}</a></td>
                            <td>{{$issue_item->pivot->amount}}</a></td>
                           
                        </tr>
                    @endforeach
                </table>
                
            @else
            no items
            
            @endif
        </div>
        {{-- <div class="row">
             <div class="col-xs-1"></div>
            <div class="col-xs-11">
               <p >...............................<br>  කැස්බෑව නගර සභාව </p> 
        
            </div>
        </div> --}}

         

    </div>


</body>


</html>


  