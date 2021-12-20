@extends("theme.$theme.layout")
@section('titulo')
    Editar Publicación
@endsection
@section('tituloContenido')
    Editar Publicación
@endsection

@section('header')
    <link rel="stylesheet"
        href="{{ asset("assets/$theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">
    <!-- dropzone -->
    <link rel="stylesheet" href="{{ asset("assets/$theme/plugins/dropzone/min/dropzone.min.css") }}">
    <!-- bootstrap-toggle -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <!-- InputMask -->
    <script src="{{ asset("assets/$theme/plugins/moment/moment.min.js") }}"></script>
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <!-- dropzonejs -->
    <script src="{{ asset("assets/$theme/plugins/dropzone/min/dropzone.min.js") }}"></script>
    <!-- bootstrap-toggle -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        $(function() {
            var fotos = $('input[name^="fotos"]').map(function() {
                if ($(this).val() != '') {
                    return $(this).val();
                }
            }).get();
            var sizes = $('input[name^="sizes"]').map(function() {
                if ($(this).val() != '') {
                    return $(this).val();
                }
            }).get();

            if (@json(old('fotos'))) {
                var fotos = @json(old('fotos'));
                var sizes = @json(old('sizes'));
                fotos.forEach(function(item, index) {
                    $('#form-general').append('<input type="hidden" name="fotos[]" value="' + item + '">')
                    $('#form-general').append('<input type="hidden" name="sizes[]" value="' + sizes[index] +
                        '">')
                });
            }

            //validación con expresión regular con la librería o plugin inputmask
            $("#porcentaje_THC,  #porcentaje_CBD")
                .inputmask('Regex', {
                    regex: "^[1-9]([,.][0-9]{1})|^[1-9][0-9]([,.][0-9]{1})|^100$",
                });
            //validación con expresión regular con la librería o plugin inputmask
            $("#porcentaje_indica, #porcentaje_sativa, #porcentaje_ruderalis")
                .inputmask('Regex', {
                    regex: "^[0-9]([,.][0-9]{1})|^[1-9][0-9]([,.][0-9]{1})|^100$",
                });

            $('#tiempo_floracion, #unidad_tiempo_floracion, #produccion_interior, #produccion_exterior, #altura, #semillas_paquete, #stock')
                .inputmask('numeric', {
                    groupSeparator: '.',
                    autoGroup: true,
                    digits: 0,
                    radixPoint: ",",
                    digitsOptional: false,
                    allowMinus: false,
                    rightAlign: false
                });

            $('#precio').inputmask('numeric', {
                groupSeparator: '.',
                autoGroup: true,
                digits: 0,
                radixPoint: ",",
                digitsOptional: false,
                allowMinus: false,
                prefix: '$ ',
                rightAlign: false
            });

            // DropzoneJS Demo Code Start
            var dataUrl = "{{ route('subirFotos') }}";
            $("#subirFotos").dropzone({
                url: dataUrl,
                autoQueue: true,
                addRemoveLinks: true,
                maxFiles: 6,
                parallelUploads: 2,
                thumbnailHeight: 120,
                thumbnailWidth: 120,
                maxFilesize: 3,
                filesizeBase: 1000,
                dictRemoveFile: "Quitar archivo",
                init: function() {
                    thisDropzone = this;
                    if (fotos) {
                        fotos.forEach(function(item, index) {
                            var mockFile = {
                                name: item,
                                myCustomName: item,
                                size: sizes[index]
                            };
                            thisDropzone.emit("addedfile", mockFile);
                            thisDropzone.emit("thumbnail", mockFile, document.location.origin +
                                '/storage/' + item);
                            $('[data-dz-thumbnail]').css('height', '120');
                            $('[data-dz-thumbnail]').css('width', '120');
                            $('[data-dz-thumbnail]').css('object-fit', 'cover');

                            thisDropzone.emit("complete", mockFile);
                            console.log(mockFile.myCustomName);
                        });
                    }
                },
                sending: function(file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function(file, response) {
                    file.myCustomName = response.value;
                    console.log(file.name);
                    $('#form-general').append('<input type="hidden" name="fotos[]" value="' + response
                        .value + '">')
                    $('#form-general').append('<input type="hidden" name="sizes[]" value="' + response
                        .size + '">')
                    $('.dz-message').css('display', 'none');

                },
                removedfile: function(file) {
                    var name = file.myCustomName;
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('eliminarFoto') }}/" + @json($publicacion->publicacion_id),
                        data: {
                            name: name,
                            request: 2,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response == 'ok') {
                                $('input[name^="fotos"]').map(function(value, index) {
                                    // console.log($(this).val(), name, $(this).val().split('storage/')[1]);
                                    if ($(this).val() == name) {
                                        $(this).remove();
                                        $(this).next().remove();
                                    }
                                });
                                if ($('input[name^="fotos"]').length > 0) {
                                    $('.dz-message').css('display', 'none');
                                } else {
                                    $('.dz-message').css('display', 'block');
                                }
                            }
                        }
                    });
                    var _ref;
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file
                        .previewElement) : void 0;
                }
            });


            // DropzoneJS Demo Code End

            $('#actualizar').on('click', function() {
                $('#tipo_id').attr('disabled', false);
                $('#form-general').submit();
            });
        });
    </script>
@endsection

@section('contenido')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Información semilla</h6>
                <div class="card-tools pull-right">
                    <a href="{{ route('publicaciones.index') }}" class="btn btn-block text-white bg-consex btn-sm ">
                        <i class="fas fa-reply"></i> publicaciones
                    </a>
                </div>
            </div>
            <!-- form start -->
            <form action="{{ route('publicaciones.update', ['publicacione' => $publicacion->publicacion_id]) }}"
                id="form-general" class="form-horizontal" method="POST" autocomplete="off">
                @csrf @method('put')
                <div class="card-body">
                    @include('publicaciones.form')
                </div>
                <!-- /.card-body -->
                <div class="card-footer mt-2">
                    <div class="row float-right">
                        @include('includes.boton-form-editar')
                    </div>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
@endsection
