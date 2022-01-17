@if (count($ventas) > 0)
    @foreach ($ventas as $venta)
        <div class="card">
            <div class="card-header">
                @inject('constants', 'App\Models\Compra\EstadoCompra')
                @php
                    switch ($venta->estado_compra_id) {
                        case $constants::EN_PROCESO:
                            $estado = 'text-dark';
                            break;
                        case $constants::EN_CAMINO:
                            $estado = 'text-warning';
                            break;
                        case $constants::ENTREGADA:
                            $estado = 'text-green';
                            break;
                        default:
                            break;
                    }
                @endphp
                <h3 class="card-title text-bold {{ $estado }}">{{ $venta->estado->estado_compra_nombre ?? '' }}
                </h3>
                @if ($venta->estado_compra_id == $constants::EN_PROCESO)
                    <div class="card-tools">
                        <div class="btn-group">
                            <button type="button" class="btn btn-tool" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('enviar', ['compra_id' => $venta->compra_id])}}" class="dropdown-item">Marcar como enviada</a>
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
                                src="{{ isset($venta->publicacion->fotos) && count($venta->publicacion->fotos) > 0 ? asset('storage/' . $venta->publicacion->fotos[0]->foto) : asset('assets/img/sin-imagen.jpg') }}"
                                width="100%" height="auto" style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="col-md-4 pl-2 position-relative">
                        <div class="info-venta">
                            <p class="h5 text-bold">{{ $venta->publicacion->titulo ?? '' }}</p>
                            <p class="size-12 subtitle">{{ $venta->publicacion->nombre_semilla ?? '' }}</p>
                        </div>
                    </div>
                    <div class="col-md-2 position-relative">
                        <p class="text-gray size-14 info-venta">
                            $ {{ $venta->precio_total ? number_format($venta->precio_total, 0, ',', '.') : '' }}
                        </p>
                    </div>
                    <div class="col-md-2 position-relative">
                        <p class="text-gray size-14 info-venta">
                            {{ $venta->unidades ? ($venta->unidades > 1 ? $venta->unidades . ' unidades' : $venta->unidades . ' unidad') : '' }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p class="text-gray size-14">{{ $venta->comprador->nombre ?? '' }}
                            {{ $venta->comprador->apellido_paterno ?? '' }}
                            {{ $venta->comprador->apellido_materno ?? '' }}
                            <br>
                            <span class="text-bold">Comprador</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $ventas->links() }}
@else
    <div class="card bg-gray-light">
        <div class="card-body">
            <p>Aún no haz vendido nada :(</p>
        </div>
    </div>
@endif
