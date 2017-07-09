@include('layouts.reportheader')
<body  onload="window.print();">
<p>print time: {{date("Y-m-d H:i:sa")}} report create time:{{$reportrequest->created_at->format('Y-m-d H:i:sa')}} request report id:{{$reportrequest->id}}</p>
    <div class="wrapper">
        <div class="row">
         <div class="col-xs-9"></div>
            <div class="col-xs-3">
               <p>කැනස /AC/ ගබඩා /......<br> කැස්බෑව නගර සභාව,<br>2016/11/01</p> 
        
            </div>
        </div>
        <div class="row">
        <div class="col-xs-1"></div>
            <div class="col-xs-10">
               <p >ලේකම්,<br>කැස්බෑව නගර සභාව,</p> 
        
            </div>
        </div>
        <div class="row">
         <div class="col-xs-1"></div>
            <div class="col-xs-10">
               <p class="heading"><h4><u><strong>{{$reportrequest->created_at->format('Y F')}} මාසය සදහා ගබඩාවට භාණ්ඩ ලබා ගැනීම</strong></u></p></h4> 
        
            </div>
        </div>
        <div class="row">
         <div class="col-xs-1"></div>
            <div class="col-xs-10">
                <p>
                    {{$reportrequest->created_at->format('Y F')}} මාසය සදහා පහත සදහන් භාණ්ඩ ලබා ගැනීමට අවශ්‍යව ඇත. ඒ සදහා අනුමැතිය ලබා දෙන මෙන් කාරුණිකව ඉල්ලා සිටිමි. 
                </p> 
        
            </div>
        </div>
        <div class="panel-body">
            @if(count($reportrequest->items_reportrequest)>0)
                <table class="table table-bordered "style="width: 75%" >
                   
                    <tr>
                        <th style="width: 10%">අනු අංකය</th>
                        <th style="width: 30%">ඉල්ලුම් කරන භාණ්ඩ</th>
                        <th style="width: 15%">ඉල්ලුම් කරන ප්‍රමාණය</th>
                        <th style="width: 15%">{{$reportrequest->created_at->format('Y-m-d')}} දිනට ශේෂය</th>
                            
                    </tr>

                    @foreach($reportrequest->items as $items_reportrequest)
                        <tr>
                            <td>{{$items_reportrequest->code}}</td>
                            <td>{{$items_reportrequest->name}}</a></td>
                            <td>{{$items_reportrequest->pivot->requested_amount}}</a></td>
                            <td>{{$items_reportrequest->pivot->amount_in_store}}</td>
                        </tr>
                    @endforeach
                </table>
                
            @else
            no officers<br>click add officer button
            
            @endif
        </div>
        <div class="row">
             <div class="col-xs-1"></div>
            <div class="col-xs-11">
               <p >අත්සන :- ........................<br>ගබඩා භාරකරු<br>දිනය :- 20__/__/__</p> 
        
            </div>
        </div>

         <div class="row">
            <div class="col-xs-1"></div>
            <div class="col-xs-8">
               <p >සැපයුම් නිලධාරි,<br>ඉහත භාණ්ඩ ලබා දීමට අවශ්‍ය කටයුතු කරන්න<br>දිනය :- 20__/__/__ </p> 
        
            </div>
            <div class="col-xs-3">
               <p >.................................<br>ලේකම්<br>කැස්බෑව නගර සභාව </p> 
        
            </div>
        </div>

    </div>


</body>


</html>


  