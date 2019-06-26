<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Recharge My Plan Dashboard{{--config('app.name', 'Recharge My Plan Dashboard')--}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-red.min.css')}}">
  <!-- Morris chart -->
  
  <!-- jvectormap -->
  
  <!-- Date Picker -->
  
  <!-- Daterange picker -->
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{  asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- Custom Css -->
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Custom css for plan-list.blade.php view -->
  @yield('plans_styles')
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
  @if(Auth::check() && Auth::user()->title == "Administrator")
  @include('admin.header')
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    @include('admin.sidebar')
    <!-- /.sidebar -->
  </aside>
  @endif
  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
  @if(Auth::check() && Auth::user()->title == "Administrator")
  <footer class="main-footer">
    @include('admin.footer')
  </footer>
  @endif
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables for plan list page-->
@yield('datatables')
<!-- Morris.js charts -->

<!-- Sparkline -->

<!-- jvectormap -->

<!-- jQuery Knob Chart -->

<!-- daterangepicker -->

<!-- datepicker -->

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->

<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>
<!-- Custom JS-->
<script src="{{ asset('js/custom.js')}}"></script>
<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script> 
<script>
  $(document).ready(function() {
      $('.summernote').summernote();
  });
</script>
</body>
</html>