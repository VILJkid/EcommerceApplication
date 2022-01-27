{{-- All the required css needs to be added here. --}}

<!-- Head -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!--Bootstrap switch-->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.css') }}">
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!--CSV-->
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/dt/dt-1.11.3/b-2.1.1/b-html5-2.1.1/datatables.min.css" />
<!--Bootstrap Dark-->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-dark/css/dark-mode.css') }}">
<!-- /.Head -->

{{-- Experimental dark mode feature. You can ignore this. --}}

<style>
    [data-theme="dark"] {
        background-color: rgb(255, 0, 0) !important;
        color: rgb(255, 255, 255);
        /* color: #eee; */
    }

    [data-theme="dark"] .bg-light {
        background-color: rgb(0, 0, 0) !important;
        color: rgb(255, 255, 255);
    }

    [data-theme="dark"] .bg-white {
        background-color: rgb(0, 0, 0) !important;
        color: white;
    }

    [data-theme="dark"] .bg-black {
        background-color: #eee !important;
        color: black;
    }

</style>
