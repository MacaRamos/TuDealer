@extends("theme.$theme.layout")
@section('titulo')
    Tus Publicaciones
@endsection
@section('tituloContenido')
    Tus Publicaciones
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
            $("#tabla-data").DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered": "(Filtrado de _MAX_ total registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                pageLength: 20,
                lengthMenu: [
                    [20, 50, 100, -1],
                    [20, 50, 100, "Todos"]
                ]
            });

            $("#tabla-data").on('submit', '.form-eliminar', function() {
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
    <div class="card">
        <div class="container">
            <div class="card-header with-border border-consex">
                <div class="card-tools pull-right">
                    <a href="{{ route('publicaciones.create') }}" class="btn btn-block btn-sm">
                        <i class="fas fa-plus-circle"></i> Nueva
                    </a>
                </div>
            </div>
            <div class="card-body">
                @include('publicaciones.table')
            </div>
        </div>
    </div>
@endsection
