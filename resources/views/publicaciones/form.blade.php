<div class="row mt-3">
    <div class="col-md-6">
        <div class="form-group">
            <label class="font-weight-normal requerido">Título</label>
            <input type="text" class="form-control" name="titulo" id="titulo"
                value="{{ old('titulo', $publicacion->titulo ?? '') }}" maxlength="100" required>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="form-group">
            <label class="font-weight-normal requerido">Nombre semilla</label>
            <input type="text" class="form-control" name="nombre_semilla" id="nombre_semilla"
                value="{{ old('nombre_semilla', $publicacion->nombre_semilla ?? '') }}" maxlength="100" required>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-3">
        <div class="form-group">
            <label class="font-weight-normal requerido">Tipo semilla</label>
            <select class="form-control" name="tipo_semilla_id" id="tipo_semilla_id" required>
                <option value="">Seleccione...</option>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->tipo_semilla_id }}"
                        {{ isset($publicacion) && $publicacion->tipo_semilla_id == $tipo->tipo_semilla_id ? 'selected' : '' }}
                        {{ old('tipo_semilla_id') == $tipo->tipo_semilla_id ? 'selected' : '' }}>
                        {{ $tipo->tipo_semilla_nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="font-weight-normal requerido">Precio</label>
            <input type="text" class="form-control" name="precio" id="precio"
                value="{{ old('precio', $publicacion->precio ?? '') }}" maxlength="15" required>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-2">
        <div class="form-group">
            <label class="font-weight-normal requerido">% THC</label>
            <input type="text" class="form-control" name="porcentaje_THC" id="porcentaje_THC"
                value="{{ old('porcentaje_THC', $publicacion->porcentaje_THC ?? '') }}" maxlength="4" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="font-weight-normal requerido">% CBD</label>
            <input type="text" class="form-control" name="porcentaje_CBD" id="porcentaje_CBD"
                value="{{ old('porcentaje_CBD', $publicacion->porcentaje_CBD ?? '') }}" maxlength="4" placeholder=" " required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="font-weight-normal requerido">% Indica</label>
            <input type="text" class="form-control" name="porcentaje_indica" id="porcentaje_indica"
                value="{{ old('porcentaje_indica', $publicacion->porcentaje_indica ?? '') }}" maxlength="4"  required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="font-weight-normal requerido">% Sativa</label>
            <input type="text" class="form-control" name="porcentaje_sativa" id="porcentaje_sativa"
                value="{{ old('porcentaje_sativa', $publicacion->porcentaje_sativa ?? '') }}" maxlength="4" placeholder=" " required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="font-weight-normal requerido">% Ruderalis</label>
            <input type="text" class="form-control" name="porcentaje_ruderalis" id="porcentaje_ruderalis"
                value="{{ old('porcentaje_ruderalis', $publicacion->porcentaje_ruderalis ?? '') }}" maxlength="4" placeholder=" " required>
        </div>
    </div>
    <div class="col-md-2">
        <label class="font-weight-normal requerido">Tiempo floración</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="tiempo_floracion" id="tiempo_floracion"
                value="{{ old('tiempo_floracion', $publicacion->tiempo_floracion ?? '') }}" maxlength="6" required>

            <div class="input-group-prepend">
                <label class="input-group-text" for="semanas">semanas</label>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-2">
        <label class="font-weight-normal requerido">Producción interior</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="produccion_interior" id="produccion_interior"
                value="{{ old('produccion_interior', $publicacion->produccion_interior ?? '') }}" maxlength="6" required>

            <div class="input-group-prepend">
                <label class="input-group-text" for="semanas">semanas</label>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <label class="font-weight-normal requerido">Producción exterior</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="produccion_exterior" id="produccion_exterior"
                value="{{ old('produccion_exterior', $publicacion->produccion_exterior ?? '') }}" maxlength="6" required>

            <div class="input-group-prepend">
                <label class="input-group-text" for="semanas">semanas</label>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <label class="font-weight-normal">Altura</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="altura" id="altura"
                value="{{ old('altura', $publicacion->altura ?? '') }}" maxlength="6">
            <div class="input-group-prepend">
                <label class="input-group-text" for="cm">cm</label>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="font-weight-normal requerido">Semillas x paquete</label>
            <input type="text" class="form-control" name="semillas_paquete" id="semillas_paquete"
                value="{{ old('semillas_paquete', $publicacion->semillas_paquete ?? '') }}" maxlength="6" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="font-weight-normal requerido">Stock</label>
            <input type="text" class="form-control" name="stock" id="stock"
                value="{{ old('stock', $publicacion->stock ?? '') }}" maxlength="6" required>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <div class="form-group">
            <label class="font-weight-normal requerido">Descripción</label>
            <textarea class="form-control" rows="5" name="descripcion" id="descripcion"
                minlength="0">{{ old('descripcion', isset($publicacion) ? $publicacion->descripcion : '') }}</textarea>
        </div>
    </div>
</div>

<div class="row mt-3 mt-3">
    <div class="col-md-12">
        <div id="subirFotos" class="dropzone">
            <div class="dz-message text-center" data-dz-message>
                @if (!isset($publicacion) || count($publicacion->fotos) == 0)
                    <i class="fas fa-images"></i><span> Agregar Fotos</span>
                @endif
            </div>
        </div>
    </div>
</div>
@if (isset($publicacion) && count($publicacion->fotos) > 0)
    @foreach ($publicacion->fotos as $foto)
        <input type="hidden" name="fotos[]" value="{{ $foto->foto }}">
        <input type="hidden" name="sizes[]" value="{{ $foto->size ?? 0 }}">
    @endforeach
@endif