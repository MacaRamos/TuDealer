@extends("theme.$theme.layout")
@section('titulo')
    Compra
@endsection
@section('tituloContenido')
    <p class="text-center">¡¡ Compra Realizada Exitosamente !!</p>
    <p class="text-center">{{ $publicacion->titulo }}</p>
@endsection

@section('header')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset("assets/$theme/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet"
        href="{{ asset("assets/$theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">
@endsection

@section('scripts')
@endsection

@section('contenido')
    <div class="container">
        <dl class="row mx-auto w-25">
            <dt class="col-sm-6">Vendedor:</dt>
            <dd class="col-sm-6 text-left">
                {{ $vendedor->nombre ?? ('' . ' ' . $vendedor->apellido_paterno ?? ('' . ' ' . $vendedor->apellido_materno ?? '')) }}
            </dd>
            <dt class="col-sm-6">Celular:</dt>
            <dd class="col-sm-6 text-left">{{ $vendedor->celular ?? '' }}</dd>
            <dt class="col-sm-6">Email:</dt>
            <dd class="col-sm-6 text-left">{{ $vendedor->email ?? '' }}</dd>
        </dl>

        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Resumen compra</h3>
            </div>
            <article class="card-body border-top">

                <dl class="row">
                    <dt class="col-sm-10">Total parcial:<span
                            class="float-right text-muted">{{ $compra->unidades ?? '' }} unidades</span></dt>
                    <dd class="col-sm-2 text-right"><strong>$
                            {{ $compra->precio_total ? number_format($compra->precio_total, 0, ',', '.') : '' }}</strong>
                    </dd>

                    <dt class="col-sm-10">Descuento:<span class="float-right text-muted">Sin descuento</span></dt>
                    <dd class="col-sm-2 text-danger text-right"><strong>$0</strong></dd>

                    <dt class="col-sm-10">Gastos de envío:<span class="float-right text-muted">Por pagar</span></dt>
                    <dd class="col-sm-2 text-right"><strong>$0</strong></dd>

                    <dt class="col-sm-10">Impuesto:<span class="float-right text-muted">Sin impuesto aplicado</span>
                    </dt>
                    <dd class="col-sm-2 text-right text-success"><strong>$0</strong></dd>

                    <dt class="col-sm-10">Total</dt>
                    <dd class="col-sm-2 text-right"><strong class="h5 text-dark">$
                            {{ $compra->precio_total ? number_format($compra->precio_total, 0, ',', '.') : '' }}</strong>
                    </dd>
                </dl>

            </article>
        </div>
        <div class="row mt-2">
            <div class="col text-center">
                <a href="{{ route('inicio') }}" class="btn btn-primary">Voler a Inicio</a>
            </div>
        </div>
    </div>
@endsection
