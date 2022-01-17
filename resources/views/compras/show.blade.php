@extends("theme.$theme.layout")
@section('titulo')
    {{ $compra->publicacion->titutlo ?? '' }} - {{ $compra->fecha_compra }}
@endsection

@section('header')
@endsection

@section('scripts')
     <script>
        $(document).ready(function() {
           
        });
    </script>
@endsection

@section('contenido')
    <div class="container">

    </div>
@endsection
