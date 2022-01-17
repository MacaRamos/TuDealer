<div class="border-bottom mb-4 pb-3">
    <div class="form-inline">
        <span class="mr-md-auto">{{ count($publicaciones) }} publicaciones</span>
        <select class="mr-2 form-control">
            <option>Menor precio</option>
            <option>Mayor precio</option>
            <option>Recomendado</option>
            <option>Comentarios</option>
        </select>
        <div class="btn-group">
            <a href="#" id="view-list" class="btn btn-outline-secondary active" data-toggle="tooltip" title=""
                data-original-title="List view">
                <i class="fa fa-bars"></i></a>
            {{-- <a href="#" id="view-grid" class="btn  btn-outline-secondary" data-toggle="tooltip"
                    title="" data-original-title="Grid view">
                    <i class="fa fa-th"></i></a> --}}
        </div>
    </div>
</div><!-- sect-heading -->
@foreach ($publicaciones as $publicacion)
    <div class="card">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('publicaciones.show', ['publicacion_id' => $publicacion->publicacion_id]) }}">
                    <img class="img-list p-2"
                        src="{{ isset($publicacion->fotos) && count($publicacion->fotos) > 0 ? asset('storage/' . $publicacion->fotos[0]->foto) : asset('assets/img/sin-imagen.jpg') }}">
                </a>
            </div> <!-- col.// -->
            <div class="col-md-6 pt-1">
                <a href="{{ route('publicaciones.show', ['publicacion_id' => $publicacion->publicacion_id]) }}"
                    class="title-product">{{ $publicacion->titulo ?? '' }}</a>
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
                    <small class="ml-1 mt-1 text-muted">{{ $publicacion->resenas->count('puntaje') ?? 0 }}
                        reseñas</small>
                    <small class="ml-1 mt-1"><span class="right badge badge-warning">{{ $publicacion->tipo->tipo_semilla_nombre ?? '' }}</span></small>
                </div>
                <p>{{ mb_strimwidth($publicacion->descripcion ?? '', 0, 230, '...') }}</p>
            </div> <!-- col.// -->
            <div class="col-sm-3 align-self-center">
                <div class="price-wrap">
                    <span class="price h5">$
                        {{ $publicacion->precio ? number_format($publicacion->precio, 0, ',', '.') : '' }}</span>
                    {{-- <del class="price-old"> $98</del> --}}
                </div> <!-- info-price-detail // -->

                <p class="small text-success"> Envío gratis </p>
                <a href="{{ route('compras.create', ['publicacion_id' => $publicacion->publicacion_id]) }}"
                    class="btn btn-primary"> Comprar </a>
                <a href="{{ route('publicaciones.show', ['publicacion_id' => $publicacion->publicacion_id]) }}"
                    class="btn btn-light"> Detalles </a>
            </div>
        </div> <!-- row.// -->
    </div>
@endforeach
