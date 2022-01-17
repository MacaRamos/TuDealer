<div class="row">
    <div class="col-md-8">
        <div class="card card-body mb-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="row">
                        <input type="hidden" name="publicacion_id" value="{{ $publicacion->publicacion_id }}">
                        <div class="mr-2"><img
                                src="{{ isset($publicacion->fotos) && count($publicacion->fotos) > 0 ? asset('storage/' . $publicacion->fotos[0]->foto) : asset('assets/img/sin-imagen.jpg') }}"
                                width="80px" height="auto" style="border-radius: 5px;"></div>
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
                        <input type="text" class="form-control text-center border border-gray" id="unidades"
                            name="unidades" value="{{ $unidades }}" style="max-width: 46px;">
                        <div class="input-group-append">
                            <button class="btn btn-light border border-gray" type="button" id="button-mas"> <i
                                    class="fa fa-plus"></i> </button>
                        </div>
                    </div> <!-- input-group.// -->
                </div> <!-- col.// -->
                <div class="col">
                    <div class="price h5 total"> $
                        {{ $publicacion->precio ? number_format($publicacion->precio * $unidades, 0, ',', '.') : '' }}
                    </div>
                </div>
                {{-- <div class="col flex-grow-0 text-right">
                <a href="#" class="btn btn-light"> <i class="fa fa-times"></i> </a>
            </div> --}}
            </div> <!-- row.// -->
        </div>


        <div class="card mb-4">
            <div class="card-header">Información de quien recibe</div>
            <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="requerido">Nombre</label>
                            <input type="text" name="nombre_recibe" placeholder="Nombre"
                                class="form-control" value="{{old('nombre_recibe', ucfirst(Auth::user()->nombre).' '.ucfirst(Auth::user()->apellido_paterno).' '.ucfirst(Auth::user()->apellido_materno) ?? '') }}" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="requerido">RUT</label>
                            <input type="text" id="RUT_recibe" name="RUT_recibe" placeholder="RUT" class="form-control"
                                value="{{old('RUT_recibe',  Auth::user()->RUT ?? '') }}" oninput="checkRut(this)" maxlength="12" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="requerido">Celular</label>
                            <input type="text" id="celular_recibe" name="celular_recibe" class="form-control"
                                value="{{old('celular_recibe', Auth::user()->celular ?? '') }}" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="requerido">Email</label>
                            <input type="email" name="email_recibe" class="form-control"
                                value="{{ old('email_recibe', Auth::user()->email ?? '') }}" required>
                        </div>
                    </div> <!-- row.// -->
            </div> <!-- card-body.// -->
        </div> <!-- card.// -->

        <div class="card mb-4">
            <div class="card-header">Dirección de envío</div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Región</label>
                        <select id="region_id" name="region_id" class="form-control requerido"
                            required>
                            @if (count($regiones) > 0)
                                @foreach ($regiones as $index =>  $region)
                                    <option value="{{ $region->region_id }}"
                                        {{ old('region_id') == $region->region_id ? 'selected' : '' }}
                                        {{ !old('region_id') && $index == 0 ? 'selected' : ''}}>{{ $region->region }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Comuna</label>
                        <select id="comuna_id" name="comuna_id"
                            class="form-control select2 requerido" required>
                            @if (count($comunas) > 0){
                                <option value="">Seleccione...</option>
                                @foreach ($comunas as $comuna)
                                    <option value="{{ $comuna->comuna_id }}"
                                        {{ old('comuna_id') == $comuna->comuna_id ? 'selected' : '' }}>{{ $comuna->comuna }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-sm-8 requerido">
                        <label>Calle</label>
                        <input type="text" placeholder="Av. Manuel Rodriguez" class="form-control" id="calle"
                            name="calle" value="{{ old('calle') }}" required>
                    </div>
                    <div class="form-group col-sm-4 requerido">
                        <label>Número</label>
                        <input type="text" placeholder="" class="form-control" id="numero_direccion"
                            name="numero_direccion" value="{{ old('numero_direccion') }}" maxlength="5" required>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Departamento </label>
                        <input type="text" placeholder="" class="form-control" id="numero_departamento"
                            name="numero_departamento" value="{{ old('numero_departamento') }}" maxlength="5">
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
                        <input class="form-check-input" name="medio_pago" checked="" type="radio"
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
                        <input class="form-check-input" name="medio_pago" type="radio"
                            value="Tarjeta de crédito">
                        <h6 class="form-check-label"> Tarjeta Crédito </h6>
                    </label>
                </header>
                <div id="pay_payme" class="collapse" data-parent="#accordion_pay" style="">
                    <div class="card-body">
                        <p class="alert alert-success">Ingrese información de tarjeta</p>
                            <input type="text" class="form-control mr-2" placeholder="xxxx-xxxx-xxxx-xxxx"
                                name="">
                            <input type="text" class="form-control mr-2" style="width: 100px"
                                placeholder="dd/yy" name="">
                            <input type="number" maxlength="3" class="form-control mr-2" style="width: 100px"
                                placeholder="cvc" name="">
                            <button class="btn btn btn-success">Button</button>
                    </div> <!-- card body .// -->
                </div> <!-- collapse .// -->
            </div> <!-- card.// -->
            <div class="card">
                <header class="card-header">
                    <img src="{{ asset('assets/img/transferencia.png') }}" class="float-right"
                        height="24">
                    <label class="form-check collapsed" data-toggle="collapse" data-target="#pay_card"
                        aria-expanded="false">
                        <input class="form-check-input" name="medio_pago" type="radio"
                            value="Transferencia bancaria">
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

    </div> <!-- col.// -->
    <div class="col-md-4">
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
                    <p class="h5 total"></p>
                </dl>
                <hr>
                <p class="small mb-3 text-muted">Al hacer clic, está de acuerdo con los términos de condición.
                </p>
                <button type="submit" class="btn btn-primary btn-block"> Pagar </button>

            </div> <!-- card-body.// -->
        </div> <!-- card.// -->
    </div> <!-- col.// -->
</div>