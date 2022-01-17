@extends("theme.$theme.layout")
@section('titulo')
    Mis Compras
@endsection
@section('tituloContenido')
    Mis Compras
@endsection

@section('header')

@endsection

@section('scripts')
    @include('includes.mensaje')
    @include('includes.error-form')
    <script>
        $(function() {
            $('[data-toggle2="tooltip"]').tooltip()
        });
    </script>
@endsection

@section('contenido')
    <div class="container">
        @include('compras.lista')
    </div>
@endsection
