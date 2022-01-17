@extends("theme.$theme.layout")
@section('titulo')
    Mis Ventas
@endsection
@section('tituloContenido')
    Mis Ventas
@endsection

@section('header')

@endsection

@section('scripts')
    @include('includes.mensaje')
    @include('includes.error-form')
    <script>
        $(function() {});
    </script>
@endsection

@section('contenido')
    <div class="container">
       @include('ventas.lista')
    </div>
@endsection
