<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assessment</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/iCheck/flat/blue.css') }}">

    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/colorpicker/bootstrap-colorpicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/dataTables.bootstrap.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('plugins/select2/select2.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>AS</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Assessment</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <div class="navbar-custom-menu" style="float:right;">
            <ul class="nav navbar-nav">


              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ URL::asset('uploads/'.Auth::user()->image) }}" class="user-image" alt="User Image">
                   @if (Auth::user())
                  <span class="hidden-xs">{{ Auth::user()->name }} {{ Auth::user()->last_name }} </span>
                  @endif
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ URL::asset('uploads/'.Auth::user()->image) }}" class="img-circle" alt="User Image">
                    <p>
                    @if (Auth::user())
                      {{ Auth::user()->name }} {{ Auth::user()->last_name }}
                      <small>Member since Nov. 2012</small>
                    </p>
                    @endif
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ URL::asset('uploads/'.Auth::user()->image) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              Bienvenido:
               @if (Auth::user())<p>{{ Auth::user()->name }} {{ Auth::user()->last_name }} </p>@endif
            </div>
          </div>


          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">NAVEGACIÓN PRINCIPAL</li>
            <li>
              <a href="{!! URL::asset( 'admin' ) !!}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>

            <li>
              <a href="{!! URL::asset( 'clients' ) !!}">
                <i class="ion ion-ios-people"></i> <span>Clientes</span>
                <small class="label pull-right bg-blue">{{ $clientCount }}</small>
              </a>
            </li>

            <li>
              <a href="{!! URL::asset( 'users' ) !!}">
                <i class="ion ion-person-add"></i> <span>Usuarios</span>
                <small class="label pull-right bg-red">{{ $userCount }}</small>
              </a>
            </li>
            <li>
                <a href="{!! URL::asset( 'competencies' ) !!}">
                  <i class="ion ion-stats-bars"></i>Competencias
                  <small class="label pull-right bg-blue">{{ $ratingCount }}</small>
                </a>
            </li>
            <li>
              <a href="{!! URL::asset( 'evaluations' ) !!}">
                <i class="ion ion-ios-paper"></i> <span>Evaluaciones</span>
                <small class="label pull-right bg-blue">{{ $evaluationCount }}</small>
              </a>
            </li>
            <li>
              <a href="{!! URL::asset( 'exercises' ) !!}">
                <i class="ion ion-ios-paper"></i> <span>Ejercicios</span>
                <small class="label pull-right bg-blue">{{ $evaluationCount }}</small>
              </a>
            </li>
            <li>
              <a href="{!! URL::asset( 'questionaries' ) !!}">
                <i class="ion ion-ios-email"></i> <span>Cuestionarios</span>
                <small class="label pull-right bg-orange">2</small>
              </a>
            </li>
            <li>
              <a href="{!! URL::asset( 'messages' ) !!}">
                <i class="ion ion-ios-email"></i> <span>Mensajes</span>
                <small class="label pull-right bg-orange">2</small>
              </a>
            </li>

            <li>
                <a href="{!! URL::asset( 'ratings' ) !!}">
                  <i class="ion ion-stats-bars"></i>Ratings
                  <small class="label pull-right bg-blue">{{ $ratingCount }}</small>
                </a>
            </li>
            <!--<li>
                <a href="{!! URL::asset( 'admin/trackings' ) !!}">
                  <i class="ion ion-arrow-graph-up-right"></i> Tracking
                  <small class="label pull-right bg-red">{{ $ratingCount }}</small>
                </a>
            </li>-->

            </ul>
        </section>
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                @yield('content')
            </div>
        </section>
    </div>

    </div>






    <!-- JavaScripts -->


    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <!--<script src="{{ URL::asset('plugins/morris/morris.min.js') }}"></script>-->
    <!-- Sparkline -->
    <script src="{{ URL::asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ URL::asset('plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
    <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ URL::asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('js/app.min.js') }}"></script>

    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>
      
    <script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ URL::asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ URL::asset('plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/select2/select2.full.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    
    <script src="{{ URL::asset('js/admin.js') }}"></script>

    <script>
        
        var BASE_URL = '{!! url('/') !!}';
      $(function () {

        $('.search-table').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "oLanguage": {
                  "oPaginate": {
                  "sFirst": "First page", // This is the link to the first page
                  "sPrevious": "<", // This is the link to the previous page
                  "sNext": ">", // This is the link to the next page
                  "sLast": "Last page" // This is the link to the last page
                  },
                  "sSearch" : '<i class="fa fa-search"></i>'
          }


        });
          
        $(".colorpicker").colorpicker();
        $(".datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        $(".hourmask").inputmask("hh:mm", {"placeholder": "hh:mm"});
          

          
      });
    </script>
</body>
</html>
