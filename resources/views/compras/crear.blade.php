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
            $('#total').text('$ '+precio*unidades);

            $('#region_id').on('change', function() {
                $('#direccionEnvio').text($('#direccionEnvio').text()+$('#region_id option:selected').text().trim());
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
                    direccionEnvio();
                }).fail(function(xhr) {

                });
            });

            $('#comuna_id').on('change', function() {
                direccionEnvio();
            });

            $('.form-check-input').on('click', function(){
                $('#medioPago').text($('.form-check-input:radio:checked').val());
            });

            $('#button-mas').on('click', function(){
                unidades = parseInt($('#unidades').val());
                var stock = parseInt(@json($publicacion->stock));
                precio = parseInt(@json($publicacion->precio));
                if(unidades < stock){
                    unidades = unidades + 1;
                    var total = precio*unidades;
                    $('#unidades').val(unidades);
                    $('#total').text('$ '+ total);
                }                
            });

            $('#button-menos').on('click', function(){
                unidades = parseInt($('#unidades').val());
                precio = parseInt(@json($publicacion->precio));
                if(unidades > 1){
                    unidades = unidades - 1;
                    var total = precio*unidades;
                    $('#unidades').val(unidades);
                    $('#total').text('$ '+ total);
                }                
            });

            $('#calle, #numeroDireccion, #departamento').on('input', function(){
                direccionEnvio();
            });
        });

        function direccionEnvio(){
            $('#direccionEnvio').text($('#calle').val() + ' ' + $('#numeroDireccion').val() + ', dpto.' + $('#departamento').val()+ ', '+  $('#comuna_id').select2('data')[0].text.trim() + ', ' + $('#region_id option:selected').text().trim());
        }
    </script>
@endsection

@section('contenido')
    <div class="container">
        <div class="row">
            <main class="col-md-8">

                <div class="card card-body mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="mr-2"><img
                                        src="{{ isset($publicacion->fotos) && count($publicacion->fotos) > 0 ? asset('storage/' . $publicacion->fotos[0]->foto) : asset('assets/img/sin-imagen.jpg') }}"
                                        width="80px" height="80px"></div>
                                <div class="">
                                    <span class="text-muted">{{ $publicacion->nombre_semilla ?? '' }}</span>
                                    <br>
                                    <a href="#" class="title text-dark"><label>{{ $publicacion->titulo ?? '' }}
                                        </label></a>
                                </div>
                            </div>
                        </div> <!-- col.// -->
                        <div class="col">
                            <div class="input-group input-spinner">
                                <div class="input-group-prepend">
                                    <button class="btn btn-light border border-gray" type="button" id="button-menos"> <i
                                            class="fa fa-minus"></i> </button>
                                </div>
                                <input type="text" class="form-control text-center border border-gray" id="unidades" name="unidades" value="1"
                                    style="max-width: 46px;">
                                <div class="input-group-append">
                                    <button class="btn btn-light border border-gray" type="button" id="button-mas"> <i
                                            class="fa fa-plus"></i> </button>
                                </div>
                            </div> <!-- input-group.// -->
                        </div> <!-- col.// -->
                        <div class="col">
                            <div class="price h5"> $
                                {{ $publicacion->precio ? number_format($publicacion->precio, 0, ',', '.') : '' }} </div>
                        </div>
                        {{-- <div class="col flex-grow-0 text-right">
                            <a href="#" class="btn btn-light"> <i class="fa fa-times"></i> </a>
                        </div> --}}
                    </div> <!-- row.// -->
                </div>


                <div class="card mb-4">
                    <div class="card-header">Información de contacto</div>
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="requerido">Nombre</label>
                                    <input type="text" placeholder="Type here" class="form-control" value="{{Auth::user()->nombre ?? ''}}" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="requerido">Celular</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->celular ?? ''}}" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="requerido">Email</label>
                                    <input type="email" class="form-control" value="{{Auth::user()->email ?? ''}}" required>
                                </div>
                            </div> <!-- row.// -->
                        </form>
                    </div> <!-- card-body.// -->
                </div> <!-- card.// -->

                <div class="card mb-4">
                    <div class="card-header">Dirección de envío</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Región</label>
                                <select name="region" id="region_id" class="form-control requerido" required>
                                    @if (count($regiones) > 0){
                                        @foreach ($regiones as $region)
                                            <option value="{{ $region->region_id }}">{{ $region->region }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Comuna</label>
                                <select name="comuna" id="comuna_id" class="form-control select2 requerido" required>
                                    @if (count($comunas) > 0){
                                        <option value="">Seleccione...</option>
                                        @foreach ($comunas as $comuna)
                                            <option value="{{ $comuna->comuna_id }}">{{ $comuna->comuna }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-sm-8 requerido">
                                <label>Calle</label>
                                <input type="text" placeholder="Av. Manuel Rodriguez" class="form-control" id="calle" required>
                            </div>
                            <div class="form-group col-sm-4 requerido">
                                <label>Número</label>
                                <input type="text" placeholder="" class="form-control" id="numeroDireccion" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Departamento </label>
                                <input type="text" placeholder="" class="form-control" id="departamento">
                            </div>
                        </div> <!-- row.// -->
                    </div> <!-- card-body.// -->
                </div> <!-- card.// -->

                <div class="accordion" id="accordion_pay">
                    <div class="card">
                        <header class="card-header">
                            <img src="{{ asset('assets/img/paypal.png') }}" class="float-right" height="24">
                            <label class="form-check" data-toggle="collapse" data-target="#pay_paynet"
                                aria-expanded="true">
                                <input class="form-check-input" name="payment-option" checked="" type="radio"
                                    value="PayPal">
                                <h6 class="form-check-label">
                                    Paypal
                                </h6>
                            </label>
                        </header>
                        <div id="pay_paynet" class="collapse show" data-parent="#accordion_pay" style="">
                            <div class="card-body">
                                <p class="text-center text-muted">Conecte su cuenta de PayPal y utilícela para pagar sus
                                    compras. Será redirigido a PayPal.</p>
                                <p class="text-center">
                                    <a href="#"><img src="{{ asset('assets/img/btn-paypal.png') }}" height="32"></a>
                                    <br><br>
                                </p>
                            </div> <!-- card body .// -->
                        </div> <!-- collapse .// -->
                    </div> <!-- card.// -->
                    <div class="card">
                        <header class="card-header">
                            <img src="{{ asset('assets/img/tarjeta.png') }}" class="float-right" height="24">
                            <label class="form-check collapsed" data-toggle="collapse" data-target="#pay_payme"
                                aria-expanded="false">
                                <input class="form-check-input" name="payment-option" type="radio" value="Tarjeta de crédito">
                                <h6 class="form-check-label"> Tarjeta Crédito </h6>
                            </label>
                        </header>
                        <div id="pay_payme" class="collapse" data-parent="#accordion_pay" style="">
                            <div class="card-body">
                                <p class="alert alert-success">Ingrese información de tarjeta</p>
                                <form class="form-inline">
                                    <input type="text" class="form-control mr-2" placeholder="xxxx-xxxx-xxxx-xxxx" name="">
                                    <input type="text" class="form-control mr-2" style="width: 100px" placeholder="dd/yy"
                                        name="">
                                    <input type="number" maxlength="3" class="form-control mr-2" style="width: 100px"
                                        placeholder="cvc" name="">
                                    <button class="btn btn btn-success">Button</button>
                                </form>
                            </div> <!-- card body .// -->
                        </div> <!-- collapse .// -->
                    </div> <!-- card.// -->
                    <div class="card">
                        <header class="card-header">
                            <img src="{{ asset('assets/img/transferencia.png') }}" class="float-right" height="24">
                            <label class="form-check collapsed" data-toggle="collapse" data-target="#pay_card"
                                aria-expanded="false">
                                <input class="form-check-input" name="payment-option" type="radio" value="Transferencia bancaria">
                                <h6 class="form-check-label"> Transferencia bancaria </h6>
                            </label>
                        </header>
                        <div id="pay_card" class="collapse" data-parent="#accordion_pay" style="">
                            <div class="card-body">
                                <p class="text-muted">Datos Cuenta Corriente </p>
                                <p style="white-space: pre-line;">
                                    BANCO: Scotiabank
                                    N° CTA: 12-234567-89
                                    RUT: 11.111.111-1
                                    Correo a notificar: email@email.cl
                                </p>
                            </div> <!-- card body .// -->
                        </div> <!-- collapse .// -->
                    </div> <!-- card.// -->
                </div>
                <!-- accordion end.// -->

            </main> <!-- col.// -->
            <aside class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="mb-3">Resumen</h4>
                        <dl class="dlist-align">
                            <div class="text-muted">Dirección envío:</div>
                            <p id="direccionEnvio"></p>
                        </dl>
                        <dl class="dlist-align">
                            <div class="text-muted">Medio de pago:</div>
                            <p id="medioPago"></p>
                        </dl>
                        <hr>
                        <dl class="dlist-align">
                            <div>Total:</div>
                            <p id="total" class="h5"></p>
                        </dl>
                        <hr>
                        <p class="small mb-3 text-muted">Al hacer clic, está de acuerdo con los términos de condición.</p>
                        <a href="#" class="btn btn-primary btn-block"> Pagar </a>

                    </div> <!-- card-body.// -->
                </div> <!-- card.// -->
            </aside> <!-- col.// -->
        </div>
    </div>
@endsection
