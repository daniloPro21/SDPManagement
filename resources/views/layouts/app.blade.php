<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>

        @toastr_css
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
    <script src="{{ asset('dist/js/chart.min.js') }}" charset="utf-8"></script>
    <link rel="stylesheet" href="{{ asset('dist/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/buttons.dataTables.min.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition  sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>S</b>DP</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>SDP</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    @admin
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{  auth()->user()->unreadNotifications->count() }}</span>
                        </a>
                        <ul class="dropdown-menu">
                        <li class="header">Vous avez {{ count(auth()->user()->unreadNotifications) }} nouveaux dossier(s)</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                            @foreach (auth()->user()->unreadNotifications as $dossier)
                                <li>
                                <a href="{{ route('dossier.detail', ['id' => $dossier->id]) }}">
                                    <i class="fa fa-users text-aqua"></i> {{ $dossier->nom }} - {{ $dossier->type->name }}
                                </a>
                                </li>
                            @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    @endadmin
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('dist/img/armoirie.png') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="color: #222  !important">
                            <img src="{{ asset('dist/img/armoirie.png') }}" class="img-circle" alt="User Image">

                            <p style="color: #222  !important">
                            {{ auth()->user()->name}} - {{ auth()->user()->role}}
                            <small>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', auth()->user()->created_at)->diffForHumans() }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                                </form>
                            </div>
                        </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                    </ul>
                </div>
                </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar bg-success ">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar text-white">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                <img src="{{ asset('dist/img/armoirie.png') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="{{ route('dossier.result') }}" method="GET" class="sidebar-form">
                <div class="input-group">
                <input type="text" name="recherche" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                        <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">NAVIGATION</li>
            @admin
                <li class="text-white">
                <a href="{{ route('admin.home')}}">
                    <i class="fa fa-dashboard"></i> <span>{{ __("Panneau de contrôle")}}</span>
                </a>
                </li>
                <li>
                <a href="{{ route('dossiers.all')}}">
                <i class="fa fa-book"></i>
                <span>{{ __("Dossiers")}}</span>
                </a>
            </li>

            <li>
            <a href="{{ route('dossiers.find')}}">
                <i class="fa fa-search"></i>
                <span>{{ __("Recherche")}}</span>
            </a>
            </li>


            </li>
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>{{ __("Configuration")}}</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('type.index') }}"><i class="fa fa-circle-o"></i> Type de Dossiers</a></li>
                    <li><a href="{{ route('service.index') }}"><i class="fa fa-circle-o"></i> Services</a></li>
                <li><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> Utilisateurs</a></li>
                </ul>
                </li>

                @endadmin

            @secretaire
                <li>
                    <a href="{{ route('secretaire.home') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>home</span>
                    </a>
                </li>
                </li>
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Dossier</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('dossiers.list', 'coter') }}"><i class="fa fa-circle-o"></i> Coter</a></li>
                    <li><a href="{{ route('dossiers.list', 'non-coter') }}"><i class="fa fa-circle-o"></i> Non Coter</a></li>
                    <li><a href="{{ route('dossiers.list', 'traiter') }}"><i class="fa fa-circle-o"></i>traiter</a></li>
                </ul>
                </li>
                <li>
                    <a href="{{ route('dossier.group') }}">
                        <i class="fa fa-address-card"></i> <span>Types Dossiers</span>
                    </a>
                </li>
                <li>
                <a href="{{ route('admin.home')}}">
                    <i class="fa fa-dashboard"></i> <span>{{ __("Statistiques")}}</span>
                </a>
                </li>


            @endsecretaire

            @service
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION {{  auth()->user()->role }}</li>
                <li class="active">
                <a href="{{ route('service.home') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
                </li>
                </li>
                <li>
                <a href="{{ route('service.coter') }}">
                    <i class="fa fa-book"></i>
                    <span>Dossier Coter</span>
                </a>
                </li>

            @endservice

            </ul>
            </section>
            <!-- /.sidebar -->
        </aside>





        <!-- Content Wrapper. Contains page content -->

            <div class="contant-wrapper">

                    <section class="justify-content-center">
                        @yield('content')
                      </section>
            </div>






    </div>
    <!-- ./wrapper -->
    @yield('javascript')
    @jquery
    @toastr_js
    @toastr_render
    <!-- jQuery 3 -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    <script src="{{ asset('dist/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dist/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('dist/js/jszip.min.js') }}"></script>
    <script src="{{ asset('dist/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dist/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dist/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dist/js/buttons.print.min.js') }}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : false,
                'info'        : true,
                'autoWidth'   : false,
            })
        })
        $(function () {
            $('#example3').DataTable()
            $('#example4').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })

        $(document).ready(function() {
          $('#example').DataTable( {
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          } );
      } );
    </script>

</body>

</html>
