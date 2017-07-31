<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SCS | Stocks</title>


    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    {{-- datatables --}}
   	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">

    @yield('head')
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        .table {
            border-radius: 5px;

            margin: 0px auto;
            float: none;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
      <a class="navbar-brand" href="{{ url('/home') }}">
         <strong>SCS </strong> | <small>Sarathchandra Catering Services</small>
      </a>
        <div class="container">
          <!-- Branding Image -->

            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      SUPPLY
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ url('/suppliers') }}">Suppliers</a></li>
                      <li><a href="{{ url('/orders') }}">Orders</a></li>
                      <li><a href="{{ url('/grns') }}">GRNs</a></li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      SALES
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ url('/customers') }}">Customers</a></li>
                      <li><a href="{{ url('/orders') }}">Quotations</a></li>
                      <li><a href="{{ url('/sales') }}">Sale Order</a></li>
                    
                    </ul>
                  </li>

                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      RETURNINGS
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ url('/customers') }}">Returnings</a></li>
                      <li><a href="{{ url('/orders') }}">Damages</a></li>

                    </ul>
                  </li>
                  <li><a href="settings/user">PAYMENTS</a></li>
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      ITEMS
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ url('/cats') }}">categories</a></li>
                      <li><a href="{{ url('/items/create') }}">Add item</a></li>
                      <li><a href="{{ url('/change_prices') }}">Set item prices</a></li>
                      <li><a href="{{ url('/huts') }}">huts</a></li>

                    </ul>
                  </li>

                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      STOCKS
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ url('/customers') }}">Customers</a></li>
                      <li><a href="{{ url('/orders') }}">Quotations</a></li>
                      <li><a href="{{ url('/sales') }}">Sale Order</a></li>
                      <li><a href="{{ url('/grns') }}">Item Returns</a></li>
                    </ul>
                  </li>

                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      REPORTS
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ url('/customers') }}">Customers</a></li>
                      <li><a href="{{ url('/orders') }}">Quotations</a></li>
                      <li><a href="{{ url('/sales') }}">Sale Order</a></li>
                      <li><a href="{{ url('/grns') }}">Item Returns</a></li>
                    </ul>
                  </li>


                </ul>
<?php // TODO: add unit for customers create store page seect day button whend user select day from that input and then it will show the all the orders grn sale happens?>
<?php // TODO: show all item current stock section in store and user can select all-G O R below reorder O R below min Rbutton and full search options  ?>
<?php // TODO: save karanne nathuwa yanna hadaddi warning ekak denna hadanna  ?>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                       <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        <li><a href="settings/user">settings</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @include('layouts.alerts')
    <div data-alerts="alerts" data-titles='{"warning": "<em>Warning!</em>", "error": "Error!"}' data-ids="myid" data-fade="3000"></div>
    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('js/jquery.bsAlerts.min.js') }}"></script>


   	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js">
	</script>




  <script>
  $( function() {
    $( ".datepicker" ).datepicker({ minDate: "-1M", maxDate: "+6M", dateFormat:"yy-mm-dd" });
  } );
  </script>


   @yield('script')

</body>

</html>
