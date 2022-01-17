@if (count($compras) > 0)
    @foreach ($compras as $compra)
        @include('compras.evaluar')
        <div class="card">
            <div class="card-header">
                @php
                    $fecha = new DateTime($compra->fecha_compra);
                @endphp
                @inject('constants', 'App\Models\Compra\EstadoCompra')
                <h3 class="card-title">{{ strftime('%d de %B de %Y', $fecha->getTimestamp()) }}</h3>
                @if ($compra->estado_compra_id == $constants::EN_CAMINO)
                    <div class="card-tools">
                        <div class="btn-group">
                            <button type="button" class="btn btn-tool" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('recepcion', ['compra_id' => $compra->compra_id]) }}"
                                    class="dropdown-item">Informar Recepción</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1">
                        <div class="border border-gray position-relative"
                            style="width: 80px; height: 80px; border-radius: 5px;">
                            <img class="img-compra"
                                src="{{ isset($compra->publicacion->fotos) && count($compra->publicacion->fotos) > 0 ? asset('storage/' . $compra->publicacion->fotos[0]->foto) : asset('assets/img/sin-imagen.jpg') }}"
                                width="100%" height="auto" style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="col-md-4 pl-2">
                        <p class="text-green text-bold size-14">{{ $compra->estado->estado_compra_nombre ?? '' }}
                        </p>
                        <span class="size-14 text-bold">{{ $compra->publicacion->titulo ?? '' }}</span>
                        <p class="text-gray size-12">
                            {{ $compra->unidades ? ($compra->unidades > 1 ? $compra->unidades . ' unidades' : $compra->unidades . ' unidad') : '' }}
                        </p>
                    </div>
                    <div class="col-md-5">
                        <p class="text-gray size-14">{{ $compra->publicacion->vendedor->nombre ?? '' }}
                            {{ $compra->publicacion->vendedor->apellido_paterno ?? '' }}
                            {{ $compra->publicacion->vendedor->apellido_materno ?? '' }}
                            <br>
                            <span class="text-bold">Vendedor</span>
                        </p>
                    </div>
                    <div class="col-md-2 float-right">
                        <button type="button" class="btn btn-primary btn-block">Ver compra</button>
                        @switch($compra->estado_compra_id)
                            @case($constants::EN_PROCESO)
                                <button type="button" class="btn btn-default btn-block">Cancelar compra</button>
                            @break
                            @case($constants::EN_CAMINO)
                                <button type="button" class="btn btn-default btn-block">Seguimiento</button>
                            @break
                            @case($constants::ENTREGADA)
                                <button type="button" class="btn btn-default btn-block" data-toggle="modal"
                                    data-target="#evaluarModal">Evaluar</button>
                            @break
                            @default

                        @endswitch

                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $compras->links() }}
@else
    <div class="card bg-gray-light">
        <div class="card-body">
            <p>Aún no ha realizado ninguna compra</p>
        </div>
    </div>
@endif
