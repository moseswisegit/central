<meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::id() }}">
    <title>@lang('quickadmin.quickadmin_title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/family.css')}}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('AdminLTE3/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('AdminLTE3/plugins/ekko-lightbox/ekko-lightbox.css')}}">
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css')}}">
    <!-- Add other stylesheets here as needed -->

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE3/dist/css/adminlte.min.css')}}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('AdminLTE3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/select.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/jquery-ui-timepicker-addon.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.standalone.min.css')}}"/>
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('AdminLTE3/plugins/toastr/toastr.min.css')}}">

      <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE3/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('AdminLTE3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">


    <link rel="stylesheet" href="{{ asset('AdminLTE3/plugins/summernote/summernote-bs4.css')}}">

    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('AdminLTE3/plugins/fullcalendar/main.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-daygrid/main.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-timegrid/main.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar-bootstrap/main.min.css')}}">
    <!-- Dans votre fichier layout ou directement dans la vue -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


  @yield('style')
    <!-- Add other stylesheets here as needed -->


