<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('titulo', config('app.name', 'Laravel'))</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("assets/$theme/plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset("assets/$theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("assets/$theme/dist/css/adminlte.min.css") }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font: Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset("assets/$theme/plugins/toastr/toastr.min.css") }}">
    <!-- Mis estilos -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <script src="https://kit.fontawesome.com/7379ba20a1.js" crossorigin="anonymous"></script>
    @yield('header')
    @yield('styles')
</head>

<body class="layout-top-nav">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!--Inicio header-->
        @include("theme/$theme/header")
        <!--Fin header-->
        <!--Inicio iside-->
        {{-- @include("theme/$theme/aside") --}}
        <!--Fin aside-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 164px;">
            <!--Miga de pan-->
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="title-page">@yield('tituloContenido')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div>
            @yield('contenido')
            <!-- /.content -->
        </div>
        <!--Inicio Footer-->
        @include("theme/$theme/footer")
        <!--Fin Footer-->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset("assets/$theme/plugins/jquery/jquery.min.js") }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset("assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset("assets/$theme/dist/js/adminlte.min.js") }}"></script>
    <!-- Toastr -->
    <script src="{{ asset("assets/$theme/plugins/toastr/toastr.min.js") }}"></script>
    @yield('scripts')

</body>

</html>
