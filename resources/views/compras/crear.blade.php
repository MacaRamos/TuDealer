@extends("theme.$theme.layout")
@section('titulo')
    Compra
@endsection
@section('tituloContenido')
    Compra
@endsection

@section('header')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset("assets/$theme/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet"
        href="{{ asset("assets/$theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">
@endsection

@section('scripts')
    <!-- InputMask -->
    <script src="{{ asset("assets/$theme/plugins/moment/moment.min.js") }}"></script>
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <!-- Select2 -->
    <script src="{{ asset("assets/$theme/plugins/select2/js/select2.full.min.js") }}"></script>
    <script>
        $(function() {
            //INICIALIZAR SELECTS CON PLUGIN SELECT2
            $(".select2").select2();
            $('.select2').select2({
                theme: 'bootstrap4'
            });
            //inicializa el medio de pago
            $('#medioPago').text($('.form-check-input:radio:checked').val());

            //inicializa el total
            var unidades = parseInt($('#unidades').val());
            var precio = parseInt(@json($publicacion->precio));
            $('.total').text(new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
                minimumFractionDigits: 0
            }).format(precio * unidades));
            // direccionEnvio();

            $('#region_id').on('change', function() {
                $('#direccionEnvio').text($('#direccionEnvio').text() + $('#region_id option:selected')
                    .text().trim());
                $.ajax({
                    type: 'GET',
                    url: "{{ route('getComunas') }}/" + $('#region_id').val()
                }).done(function(comunas) {
                    var selectComunas = '<option value="">Seleccione...</option>';
                    comunas.forEach(comuna => {
                        selectComunas += '<option value="' + comuna.comuna_id + '">' +
                            comuna
                            .comuna + '</option>';
                    });
                    $('#comuna_id').html(selectComunas);
                    $('#comuna_id').trigger('change');
                    if (@json(old('comuna_id'))) {
                        $('#comuna_id').val(@json(old('comuna_id'))).trigger('change');
                    }
                    direccionEnvio();
                }).fail(function(xhr) {

                });
            });

            if (@json(old('comuna_id'))) {
                $('#region_id').trigger("change");
            }

            $('#comuna_id').on('change', function() {
                direccionEnvio();
            });

            $('.form-check-input').on('click', function() {
                $('#medioPago').text($('.form-check-input:radio:checked').val());
            });

            $('#button-mas').on('click', function() {
                unidades = parseInt($('#unidades').val());
                var stock = parseInt(@json($publicacion->stock));
                precio = parseInt(@json($publicacion->precio));
                if (unidades < stock) {
                    unidades = unidades + 1;
                    var total = precio * unidades;
                    $('#unidades').val(unidades);
                    $('.total').text(new Intl.NumberFormat('es-CL', {
                        style: 'currency',
                        currency: 'CLP',
                        minimumFractionDigits: 0
                    }).format(total));
                }
            });

            $('#button-menos').on('click', function() {
                unidades = parseInt($('#unidades').val());
                precio = parseInt(@json($publicacion->precio));
                if (unidades > 1) {
                    unidades = unidades - 1;
                    var total = precio * unidades;
                    $('#unidades').val(unidades);
                    $('.total').text(new Intl.NumberFormat('es-CL', {
                        style: 'currency',
                        currency: 'CLP',
                        minimumFractionDigits: 0
                    }).format(total));
                }
            });

            $('#calle, #numero_direccion, #numero_departamento').on('input', function() {
                direccionEnvio();
            });

            $('#celular_recibe').inputmask('(+56) 999999999');
            $('#RUT_recibe').keypress(function(tecla) {
                var rut = $(this).val();
                if (rut.length > 6) {
                    if ((tecla.charCode > 47 && tecla.charCode < 58) || (tecla.charCode == 75) || (tecla
                            .charCode == 107)) {
                        return true;
                    }
                    return false;
                } else {
                    if (tecla.charCode > 47 && tecla.charCode < 58) {
                        return true;
                    }
                    return false;
                }
            });
            $('#numero_direccion, #numero_departamento').inputmask('numeric', {
                placeholder: '',
                groupSeparator: '',
                autoGroup: true,
                digits: 0,
                radixPoint: ",",
                rightAlign: false,
                negative: false
            });

        });

        function direccionEnvio() {
            var comuna = '',
                calle = '',
                nroDireccion = '',
                numero_departamento = '',
                region = '';
            if ($('#comuna_id').select2('data')[0].text.trim() != 'Seleccione...') {
                comuna = $('#comuna_id').select2('data')[0].text.trim() + ', ';
            }
            if ($('#numero_departamento').val() != '') {
                numero_departamento = 'numero_departamento ' + $('#numero_departamento').val() + ', ';
            }
            if ($('#calle').val() != '') {
                calle = $('#calle').val() + ', ';
            }
            if ($('#numero_direccion').val() != '') {
                nroDireccion = $('#numero_direccion').val() + ', ';
            }
            $('#direccionEnvio').text(calle + nroDireccion + numero_departamento + comuna + $('#region_id option:selected')
                .text()
                .trim());
        }

        function checkRut(input) {
            console.log('hola', $(input).val());
            var rut = $(input).val();
            var actual = rut.replace(/^0+/, "");
            if (actual != '' && actual.length > 1) {
                var sinPuntos = actual.replace(/\./g, "");
                var actualLimpio = sinPuntos.replace(/-/g, "");
                var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
                var rutPuntos = "";
                var i = 0;
                var j = 1;
                for (i = inicio.length - 1; i >= 0; i--) {
                    var letra = inicio.charAt(i);
                    rutPuntos = letra + rutPuntos;
                    if (j % 3 == 0 && j <= inicio.length - 1) {
                        rutPuntos = "." + rutPuntos;
                    }
                    j++;
                }
                var dv = actualLimpio.substring(actualLimpio.length - 1);
                $(input).val(rutPuntos + "-" + dv);
            }
        }
    </script>
@endsection

@section('contenido')
    <div class="container">
        <form action="{{ route('compras.store') }}" id="form-general" class="form-horizontal" method="POST"
            autocomplete="off">
            @csrf @method('post')
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-default-danger alert-dismissible fade show" role="alert">
                        <strong>Error:</strong> {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif
            @include('compras.form')
        </form>
    </div>
@endsection
