@extends("theme.$theme.layout")
@section('titulo')
    {{ $publicacion->nombre_semilla ?? '' }} - {{ $publicacion->titulo }}
@endsection

@section('header')
    <!-- ZOOM -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/$theme/plugins/gallery-image-zoom/css/style.css") }}"
        media="all" />
@endsection

@section('scripts')
    <!-- ZOOM JQUERY PLUGIN  -->
    <script type="text/javascript" src="{{ asset("assets/$theme/plugins/gallery-image-zoom/js/zoom-slideshow.js") }}">
    </script>
    <script>
        $(document).ready(function() {
            $('#view').setZoomPicture({
                thumbsContainer: '#pics-thumbs',
                prevContainer: '#nav-left-thumbs',
                nextContainer: '#nav-right-thumbs',
                zoomContainer: '#zoom',
                zoomLevel: 2.5,
                loadMsg: 'cargando...'
            });

            $('#button-mas').on('click', function() {
                unidades = parseInt($('#unidades').val());
                var stock = parseInt(@json($publicacion->stock));
                precio = parseInt(@json($publicacion->precio));
                if (unidades < stock) {
                    unidades = unidades + 1;
                    var total = precio * unidades;
                    $('#unidades').val(unidades);
                    $('#total').text('$ ' + total);
                }
            });

            $('#button-menos').on('click', function() {
                unidades = parseInt($('#unidades').val());
                precio = parseInt(@json($publicacion->precio));
                if (unidades > 1) {
                    unidades = unidades - 1;
                    var total = precio * unidades;
                    $('#unidades').val(unidades);
                    $('#total').text('$ ' + total);
                }
            });

            $('#comprar').on('click', function() {
                window.location.href =
                    "{{ route('compras.create', ['publicacion_id' => $publicacion->publicacion_id]) }}/" +
                    $('#unidades').val();
            });
        });
    </script>
@endsection

@section('contenido')
    <div class="container">
        <div class="card position-static">
            <div class="card-body">
                <div class="row">
                    <article class="col-md-6 position-static text-center">
                        <div id="zoom"></div>
                        <div id="content">
                            <div id="view">
                                <img src="{{ isset($publicacion->fotos) && count($publicacion->fotos) > 0 ? asset('storage/' . $publicacion->fotos[0]->foto) : asset('assets/img/sin-imagen.jpg') }}"
                                    alt="" />
                            </div>
                            <div id="thumbs">
                                <div id="nav-left-thumbs">
                                    < </div>
                                        <div id="pics-thumbs">
                                            @if (count($publicacion->fotos) > 0)
                                                @foreach ($publicacion->fotos as $key => $foto)
                                                    <img src="{{ asset('storage/' . $foto->foto) }}"
                                                        alt="Foto{{ $key }}" />
                                                @endforeach
                                            @endif
                                        </div>
                                        <div id="nav-right-thumbs">></div>
                                </div>
                            </div>
                    </article>
                    <main class="col-md-6">
                        <article>
                            <a href="#"
                                class="text-primary btn-link">{{ $publicacion->tipo->tipo_semilla_nombre ?? '' }}</a>
                            <h3 class="text-bold">{{ $publicacion->titulo ?? '' }}</h3>
                            <div class="row">
                                @php
                                    if (count($publicacion->resenas) > 0) {
                                        $promedio = $publicacion->resenas->sum('puntaje') / $publicacion->resenas->count('puntaje');
                                    } else {
                                        $promedio = 0;
                                    }
                                @endphp
                                <ul class="list-unstyled ml-2">
                                    <li class="stars-active">
                                        @for ($i = 0; $i < $promedio; $i++)
                                            <i class="fa fa-star text-orange"></i>
                                        @endfor
                                        @for ($i = $promedio; $i < 5; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    </li>
                                </ul>
                                <span class="ml-2">{{ $promedio ?? '' }}/5</span>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <span class="price h4 text-bold">$
                                    {{ $publicacion->precio ? number_format($publicacion->precio, 0, ',', '.') : '' }}</span>
                            </div>
                            <div class="mb-3">
                                <h6>Información semilla</h6>
                                <dl class="row">
                                    <dt class="col-sm-3"><i class="fas fa-check text-green mx-3 size-12"></i>THC</dt>
                                    <dd class="col-sm-9">{{ $publicacion->porcentaje_THC . '%' ?? '' }}</dd>

                                    <dt class="col-sm-3"><i class="fas fa-check text-green mx-3 size-12"></i>CBD</dt>
                                    <dd class="col-sm-9">{{ $publicacion->porcentaje_CBD . '%' ?? '' }}</dd>

                                    <dt class="col-sm-3"><i class="fas fa-check text-green mx-3 size-12"></i>Indica
                                    </dt>
                                    <dd class="col-sm-9">{{ $publicacion->porcentaje_indica . '%' ?? '' }}</dd>

                                    <dt class="col-sm-3"><i class="fas fa-check text-green mx-3 size-12"></i>Sativa
                                    </dt>
                                    <dd class="col-sm-9">{{ $publicacion->porcentaje_sativa . '%' ?? '' }}</dd>

                                    <dt class="col-sm-3"><i class="fas fa-check text-green mx-3 size-12"></i>Ruderalis
                                    </dt>
                                    <dd class="col-sm-9">{{ $publicacion->porcentaje_ruderalis . '%' ?? '' }}</dd>
                                </dl>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <div class="input-group input-spinner">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-light border border-gray" type="button"
                                                id="button-menos"> <i class="fa fa-minus"></i> </button>
                                        </div>
                                        <input type="text" class="form-control text-center border border-gray" id="unidades"
                                            name="unidades" value="1" style="max-width: 46px;">
                                        <div class="input-group-append">
                                            <button class="btn btn-light border border-gray" type="button" id="button-mas">
                                                <i class="fa fa-plus"></i> </button>
                                        </div>
                                    </div> <!-- input-group.// -->
                                </div> <!-- col.// -->
                            </div>
                            <div class="row">
                                <button type="button" id="comprar" class="btn btn-primary"> Comprar </button>
                            </div>

                        </article> <!-- product-info-aside .// -->
                    </main> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- card-body.// -->
        </div>

        {{-- más informacion del producto --}}
        <article class="card">
            <div class="card-header">
                <h5 class="card-title">Características </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <aside class="col-md-9">
                        <dl class="row">
                            <dt class="col-sm-3">Tipo Semilla</dt>
                            <dd class="col-sm-9">{{ $publicacion->tipo->tipo_semilla_nombre ?? '' }}</dd>

                            <dt class="col-sm-3">Tiempo floración</dt>
                            <dd class="col-sm-9">
                                {{ $publicacion->tiempo_floracion . ' semanas' ?? 'Sin información' }}
                            </dd>

                            <dt class="col-sm-3">Producción interior</dt>
                            <dd class="col-sm-9">
                                {{ $publicacion->produccion_interior . ' semanas' ?? 'Sin información' }}</dd>

                            <dt class="col-sm-3">Producción exterior</dt>
                            <dd class="col-sm-9">
                                {{ $publicacion->produccion_exterior . ' semanas' ?? 'Sin información' }}</dd>

                            <dt class="col-sm-3">Altura</dt>
                            <dd class="col-sm-9">{{ $publicacion->altura . ' cm' ?? 'Sin información' }}</dd>

                            <dt class="col-sm-3">Semillas x paquete</dt>
                            <dd class="col-sm-9">
                                {{ $publicacion->semillas_paquete . ' unidades' ?? 'Sin información' }}</dd>
                        </dl>
                    </aside>
                </div> <!-- row.// -->
                <hr>
                <p>
                    {{ $publicacion->descripcion ?? 'Sin descripción' }}
                </p>
            </div> <!-- card-body.// -->
        </article>

        <h3>Reseñas</h3>
        @foreach ($publicacion->resenas as $resena)
            <div class="row">
                <div class="col-md-9">
                    <div class="card mb-3">
                        <div class="row card-header">
                            <div class="row" style="margin-bottom: -20px;">
                                <div class="col-md-12">
                                    <h5 class="card-title">{{ $resena->compra->comprador->nombre ?? '' }}
                                        {{ $resena->compra->comprador->apellido_paterno }}
                                        {{ $resena->compra->comprador->apellido_materno }}</h5>
                                </div>
                                <div class="col-md-12">
                                    <ul class="list-unstyled">
                                        <li class="stars-active">
                                            @for ($i = 0; $i < $resena->puntaje; $i++)
                                                <i class="fa fa-star text-orange"></i>
                                            @endfor
                                            @for ($i = $resena->puntaje; $i < 5; $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $resena->resena ?? '' }}
                            </p>
                        </div>
                    </div>
                </div> <!-- col.// -->
            </div>
        @endforeach
    </div>
@endsection
