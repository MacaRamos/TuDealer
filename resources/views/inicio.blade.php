@extends("theme.$theme.layout")

@section('titulo')
    Inicio
@endsection

@section('tituloContenido')
    Publicaciones
@endsection

@section('styles')
    <style>
    </style>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#buscar').on('click', function(e) {
                e.preventDefault();
                filtrar();
            });

            $('.filtrarCheckbox').on('click', function(e) {
                filtrar();
            })
        });

        function filtrar() {
            var tipos = $('input:checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            console.log(tipos);
            $.ajax({
                type: 'GET',
                url: "{{ route('inicio') }}",
                data: {
                    busqueda: $('#busqueda').val(),
                    tipos: tipos
                }
            }).done(function(respuesta) {

                //ACTUALIZAR TABLAS DE LOS CALENDARIOS
                $('#publicaciones').html(respuesta);

            }).fail(function(xhr) {
                console.log(xhr);
                // if (xhr.status == 422) {
                //     $.each(xhr.responseJSON.errors, function(key, value) {
                //         $('#errores').append(
                //             '<div class="alert alert-default-danger alert-dismissible fade show" role="alert"><b>' +
                //             key + '</b>: ' + value +
                //             '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                //             '<span aria-hidden="true">&times;</span>' +
                //             '</button></div');
                //     });
                //     $(".alert").fadeTo(8000, 500).slideUp(500, function() {
                //         $(".alert").alert('close');
                //     });
                // }
            });
        }
    </script>
@endsection

@section('contenido')
    <div class="card">
        <section class="py-5">
            <div class="container">
                <div id="publicaciones">
                    @include('publicaciones')
                </div>
            </div> <!-- container .//  -->
        </section>
    </div>
@endsection
