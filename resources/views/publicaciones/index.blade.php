@extends("theme.$theme.layout")
@section('titulo')
    Mis Publicaciones
@endsection
@section('tituloContenido')
    Mis Publicaciones
@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset("assets/$theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css") }}">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset("assets/$theme/plugins/datatables/jquery.dataTables.js") }}"></script>
    <script type="text/javascript" src="{{ asset("assets/$theme/plugins/datatables-bs4/js/dataTables.bootstrap4.js") }}">
    </script>
    <!-- sweetaler -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('includes.mensaje')
    @include('includes.error-form')
    <script>
        $(function() {

            $(".form-eliminar").on('submit', function() {
                event.preventDefault();
                const form = $(this);
                swal({
                    title: '¿Está seguro que desea eliminar el registro ?',
                    text: "Esta acción no se puede deshacer!",
                    icon: 'warning',
                    buttons: {
                        cancel: "Cancelar",
                        confirm: "Aceptar"
                    },
                    dangerMode: true,
                }).then((value) => {
                    if (value) {
                        ajaxRequest(form);
                    }
                });
            });

            function ajaxRequest(form) {
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(notificacion) {
                        if (notificacion.tipo == "success") {
                            form.parents('tr').remove();
                            var table = $("#tabla-data").DataTable();
                            table.row(form.parents('tr')).remove().draw();
                            toastr.options = {
                                closeButton: true,
                                newestOnTop: true,
                                positionClass: 'toast-top-right',
                                preventDuplicates: true,
                                timeOut: '5000'
                            };
                            toastr.success(notificacion.mensaje, notificacion.titulo);
                        } else {
                            toastr.options = {
                                closeButton: true,
                                newestOnTop: true,
                                positionClass: 'toast-top-right',
                                preventDuplicates: true,
                                timeOut: '5000'
                            };
                            toastr.error(notificacion.mensaje, notificacion.titulo);
                        }

                    },
                    error: function() {}
                });
            }

        });
    </script>
@endsection

@section('contenido')
    <div class="container">
        <div class="card-header with-border border-consex">
            <div class="card-tools pull-right">
                <a href="{{ route('publicaciones.create') }}" class="btn btn-block btn-sm">
                    <i class="fas fa-plus-circle"></i> Nueva
                </a>
            </div>
        </div>
        <div class="card-body">
            @include('publicaciones.lista')
        </div>
    </div>
@endsection
