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

            $('.filtrarCheckbox').on('click', function(e){
                filtrar();
            })
        });

        function filtrar(){
            var tipos = $('input:checkbox:checked').map(function(){return $(this).val();}).get();
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
                <div class="row">
                    <aside class="col-md-3">
                        <div class="card">
                            <div class="filter-group">
                                <div class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true"
                                        class="">
                                        <h6 class="title">Semillas <i class="fa fa-chevron-down float-right"></i>
                                        </h6>
                                    </a>
                                </div>
                                <div class="filter-content collapse show" id="collapse_2" style="">
                                    <div class="card-body">
                                        @foreach ($tipos as $tipo)
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input filtrarCheckbox"
                                                    name="tipos[]" value="{{ $tipo->tipo_semilla_id }}">
                                                <div class="custom-control-label filtrarCheckbox">{{ $tipo->tipo_semilla_nombre }}
                                                    <span class="badge badge-pill badge-light float-right">{{ $tipo->publicaciones->count() }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div> <!-- card-body.// -->
                                </div>
                            </div>
                        </div> <!-- card.// -->
                    </aside> <!-- col.// -->
                    <main class="col-md-9">

                        <div class="border-bottom mb-4 pb-3">
                            <div class="form-inline">
                                <span class="mr-md-auto">{{count($publicaciones)}} publicaciones</span>
                                <select class="mr-2 form-control">
                                    <option>Menor precio</option>
                                    <option>Mayor precio</option>
                                    <option>Recomendado</option>
                                    <option>Comentarios</option>
                                </select>
                                <div class="btn-group">
                                    <a href="#" id="view-list" class="btn btn-outline-secondary active"
                                        data-toggle="tooltip" title="" data-original-title="List view">
                                        <i class="fa fa-bars"></i></a>
                                    {{-- <a href="#" id="view-grid" class="btn  btn-outline-secondary" data-toggle="tooltip"
                                        title="" data-original-title="Grid view">
                                        <i class="fa fa-th"></i></a> --}}
                                </div>
                            </div>
                        </div><!-- sect-heading -->
                        <div id="publicaciones">
                            @include('publicaciones')
                        </div>

                        

                    </main> <!-- col.// -->

                </div>

            </div> <!-- container .//  -->
        </section>
    </div>
@endsection
