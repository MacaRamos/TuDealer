@foreach ($publicaciones as $publicacion)
    <div class="card">
        <div class="row">
            <div class="col-md-3">
                <a href="#">
                    @php
                        $foto = $publicacion->fotos[0]->foto;
                    @endphp
                    <img class="img-list p-2"
                        src="{{ isset($publicacion->fotos) && count($publicacion->fotos) > 0 ? asset('storage/' . $publicacion->fotos[0]->foto) : asset('assets/img/sin-imagen.jpg') }}">
                </a>
            </div> <!-- col.// -->
            <div class="col-md-6 pt-4">
                <a href="#" class="title-product">{{ $publicacion->titulo ?? '' }}</a>
                <div class="row">
                    <ul class="list-unstyled ml-2">
                        <li class="stars-active">
                            <i class="fa fa-star text-orange"></i>
                            <i class="fa fa-star text-orange"></i>
                            <i class="fa fa-star text-orange"></i>
                            <i class="fa fa-star text-orange"></i>
                            <i class="fa fa-star text-orange"></i>
                        </li>
                    </ul>
                    <small class="ml-1 mt-1 text-muted">132 reviews</small>
                </div>
                <p>{{ $publicacion->descripcion ?? '' }}</p>
        </div> <!-- col.// -->
        <div class="col-sm-3">
            <div class="price-wrap mt-2">
                <span
                    class="price h5">$ {{ $publicacion->precio ? number_format($publicacion->precio, 0, ',', '.') : '' }}</span>
                {{-- <del class="price-old"> $98</del> --}}
            </div> <!-- info-price-detail // -->

            <p class="small text-success"> Envío gratis </p>
            <br>
            <p>
                <a href="{{route('compras.create', ['publicacion_id' => $publicacion->publicacion_id])}}" class="btn btn-primary"> Comprar </a>
                <a href="#" class="btn btn-light"> Detalles </a>
            </p>
        </div>
    </div> <!-- row.// -->
    </div>
@endforeach
