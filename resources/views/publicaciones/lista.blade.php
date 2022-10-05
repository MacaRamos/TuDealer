@if (count($publicaciones) > 0)
    @foreach ($publicaciones as $publicacion)
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5">
                        <h3 class="card-title">Información de la publicación</h3>
                    </div>
                    <div class="col-md-5">
                        Información de la semilla
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1">
                        <div class="border border-gray position-relative"
                            style="width: 80px; height: 80px; border-radius: 5px;">
                            <img class="img-compra"
                                src="{{ isset($publicacion->fotos) && count($publicacion->fotos) > 0 ? asset('storage/' . $publicacion->fotos[0]->foto) : asset('assets/img/sin-imagen.jpg') }}"
                                width="100%" height="auto" style="border-radius: 5px;">
                        </div>
                    </div>
                    <div class="col-md-4 pl-2">
                        <span class="text-gray size-12">#{{ $publicacion->publicacion_id ?? '' }}</span>
                        <p class="h5 text-bold">{{ $publicacion->titulo ?? '' }}</p>
                        <span class="right badge badge-info">{{ $publicacion->tipo->tipo_semilla_nombre ?? '' }}</span>
                        <p class="text-gray size-12">
                            {{ $publicacion->stock ? ($publicacion->stock > 1 ? $publicacion->stock . ' unidades' : $publicacion->stock . ' unidad') : '' }}
                        </p>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-sm-6">Precio:</dt>
                                    <dd class="col-sm-6 text-info">$
                                        {{ $publicacion->precio ? number_format($publicacion->precio, 0, ',', '.') : '' }}
                                    </dd>
                                    <dt class="col-sm-6">THC</dt>
                                    <dd class="col-sm-6">{{ $publicacion->porcentaje_THC . '%' ?? '' }}</dd>

                                    <dt class="col-sm-6">CBD</dt>
                                    <dd class="col-sm-6">{{ $publicacion->porcentaje_CBD . '%' ?? '' }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-sm-6">Indica
                                    </dt>
                                    <dd class="col-sm-6">{{ $publicacion->porcentaje_indica . '%' ?? '' }}</dd>

                                    <dt class="col-sm-6">Sativa
                                    </dt>
                                    <dd class="col-sm-6">{{ $publicacion->porcentaje_sativa . '%' ?? '' }}</dd>

                                    <dt class="col-sm-6">Ruderalis
                                    </dt>
                                    <dd class="col-sm-6">{{ $publicacion->porcentaje_ruderalis . '%' ?? '' }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 float-right">
                        <a href="{{ route('publicaciones.edit', ['publicacione' => $publicacion->publicacion_id]) }}"
                            class="btn btn-primary btn-block">Editar</a>
                        <form
                            action="{{ route('publicaciones.destroy', ['publicacione' => $publicacion->publicacion_id]) }}"
                            class="d-inline form-eliminar" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-block mt-2">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $publicaciones->links() }}
@else
    <div class="card bg-gray-light">
        <div class="card-body">
            <p>Aún no ha realizado ninguna publicación, crea tu primera publicación <a href="{{ route('publicaciones.create') }}">
                aquí
            </a></p>
            
        </div>
    </div>
@endif
