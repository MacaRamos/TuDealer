<div class="card-body table-responsive">
    <table class="table table-hover py-5" id="tabla-data">
        <thead class="border-bottom-3 border-black">
            <tr>
                <th style="white-space: pre !important;">ID</th>
                <th style="white-space: pre !important;">Nombre</th>
                <th style="white-space: pre !important;">Tipo Semilla</th>
                <th style="white-space: pre !important;">Fecha creación</th>
                <th style="width: 100px"></th>
            </tr>
        </thead>
        <tbody class="border-bottom">
            @foreach ($publicaciones as $publicacion)
            <tr>
                <td>{{$publicacion->publicacion_id ?? ''}}</td>
                <td>{{$publicacion->titulo ?? ''}}</td>
                <td>{{$publicacion->tipo->tipo_semilla_nombre ?? ''}}</td>
                <td>{{isset($publicacion->fecha_creacion) ? date('d-m-Y H:i:s', strtotime($publicacion->fecha_creacion)) : ''}}</td>
                <td>
                    <a href="{{route('publicaciones.edit', ['publicacione' => $publicacion->publicacion_id])}}"
                        class="btn btn-default btn-xs rounded mr-2" style="width: 24px; height: 24px;">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <form action="{{route('publicaciones.destroy', ['publicacione' => $publicacion->publicacion_id])}}"
                        class="d-inline form-eliminar" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-default btn-xs rounded"
                            style="width: 24px; height: 24px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>