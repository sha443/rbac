<!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html>
    <head>
        <meta charset="UTF-8">
        <title>RBAC | Dashboard</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">

        <!-- Bootstrap 3.3.2 -->
        <link href="{{ asset('/vendor/rbac/vendor/admin-lte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <!-- <link href="https://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" /> -->
        <!-- Theme style -->
        <link href="{{ asset('/vendor/rbac/vendor/admin-lte/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('/vendor/rbac/vendor/admin-lte/dist/css/skins/skin-blue.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/vendor/rbac/vendor/admin-lte/dist/css/skins/_all-skins.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- google font -->
        <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">

        <!-- Select2 -->
        <link href="{{ asset('/vendor/rbac/vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />


        <!-- jQuery 2.1.3 -->
        <!-- Must be on top of the markup -->
        <script src="{{ asset ('/vendor/rbac/vendor/admin-lte/plugins/jquery/jquery-2.1.3.min.js') }}"></script>

        <script src="https://code.jquery.com/jquery-2.1.3.min.js" integrity="sha256-ivk71nXhz9nsyFDoYoGf2sbjrR9ddh+XDkCcfZxjvcM=" crossorigin="anonymous"></script>

        <style type="text/css">
          html{
            scroll-behavior: smooth;
          }
        </style>

        
    </head>
    <!-- use fixed style for not scrolling sidebar-->
    <!-- skin-blueskin-blue-lightskin-yellowskin-yellow-lightskin-greenskin-green-lightskin-purpleskin-purple-lightskin-redskin-red-lightskin-blackskin-black-light -->
    <body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">

        @include('rbac::layouts.header')
        @include('rbac::layouts.sidebar')
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
    
            <!-- Main content -->
            <section class="content">
            <!-- <div class="pull-right">
			         <a href="{{ url()->previous() }}" class="btn btn-warning"> <i class="fa fa-arrow-left"></i> Back</a>
            	 <p><br></p>
            </div> -->
            @include ('rbac::layouts.messages')
                <!-- Your Page Content Here -->
                @yield('content')

            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <!-- Main Footer -->  
        @include('rbac::layouts.footer')

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- <script src="{{ asset ('/vendor/rbac/vendor/jquery/dist/jquery.min.js') }}"></script> -->
    

    <!-- check all / uncheck all script-->
    <script src="{{ asset ('/vendor/rbac/js/checkall.js') }}"></script>
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset ('/vendor/rbac/vendor/admin-lte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset ('/vendor/rbac/vendor/admin-lte/dist/js/app.min.js') }}" type="text/javascript"></script>

    <!-- SimScroll -->
    <script src="{{ asset ('/vendor/rbac/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>


  <!-- page independent scripts here -->
  @yield('script')
  
    </body>
</html>