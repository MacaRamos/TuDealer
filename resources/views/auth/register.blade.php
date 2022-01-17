@extends("theme.$theme.layout")

@section('header')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

@endsection

@section('scripts')
    <!-- InputMask -->
    <script src="{{ asset("assets/$theme/plugins/moment/moment.min.js") }}"></script>
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script>
        $(function() {

            $('#celular').inputmask('(+56) 999999999');
            $('#fecha_nacimiento').inputmask("date", {
                mask: "1-2-y",
                placeholder: "DD-MM-YYYY",
                leapday: "-02-29",
                separator: "-",
                alias: "dd-mm-yyyy"
            });

            $('#RUT').keypress(function(tecla) {
                var rut = $(this).val();
                if (rut.length > 6) {
                    if ((tecla.charCode > 47 && tecla.charCode < 58) || (tecla.charCode == 75) || (tecla
                            .charCode == 107)) {
                        return true;
                    }
                    return false;
                } else {
                    if (tecla.charCode > 47 && tecla.charCode < 58) {
                        return true;
                    }
                    return false;
                }
            });

        });

        function checkRut(input) {
            console.log('hola', $(input).val());
            var rut = $(input).val();
            var actual = rut.replace(/^0+/, "");
            if (actual != '' && actual.length > 1) {
                var sinPuntos = actual.replace(/\./g, "");
                var actualLimpio = sinPuntos.replace(/-/g, "");
                var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
                var rutPuntos = "";
                var i = 0;
                var j = 1;
                for (i = inicio.length - 1; i >= 0; i--) {
                    var letra = inicio.charAt(i);
                    rutPuntos = letra + rutPuntos;
                    if (j % 3 == 0 && j <= inicio.length - 1) {
                        rutPuntos = "." + rutPuntos;
                    }
                    j++;
                }
                var dv = actualLimpio.substring(actualLimpio.length - 1);
                $(input).val(rutPuntos + "-" + dv);
            }
        }
    </script>
@endsection

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ingresa tu información</div>
                    <div class="card-body login-card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="nombre_usuario" class="col-md-4 col-form-label text-md-right">Nombre
                                    Usuario</label>

                                <div class="col-md-6">
                                    <input id="nombre_usuario" type="text"
                                        class="form-control @error('nombre_usuario') is-invalid @enderror"
                                        name="nombre_usuario" value="{{ old('nombre_usuario') }}" required
                                        autocomplete="name" autofocus>

                                    @error('nombre_usuario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="RUT" class="col-md-4 col-form-label text-md-right">RUT</label>

                                <div class="col-md-6">
                                    <input id="RUT" type="text" class="form-control @error('RUT') is-invalid @enderror"
                                        name="RUT" value="{{ old('RUT') }}" required autocomplete="name" autofocus
                                        oninput="checkRut(this)" maxlength="12">

                                    @error('RUT')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        value="{{ old('nombre') }}" required autocomplete="name" autofocus>

                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellido_paterno" class="col-md-4 col-form-label text-md-right">Primer
                                    Apellido</label>

                                <div class="col-md-6">
                                    <input id="apellido_paterno" type="text"
                                        class="form-control @error('apellido_paterno') is-invalid @enderror"
                                        name="apellido_paterno" value="{{ old('apellido_paterno') }}" required
                                        autocomplete="name" autofocus>

                                    @error('apellido_paterno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellido_materno" class="col-md-4 col-form-label text-md-right">Segundo
                                    Apellido</label>

                                <div class="col-md-6">
                                    <input id="apellido_materno" type="text"
                                        class="form-control @error('apellido_materno') is-invalid @enderror"
                                        name="apellido_materno" value="{{ old('apellido_materno') }}" required
                                        autocomplete="name" autofocus>

                                    @error('apellido_materno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fecha_nacimiento" class="col-md-4 col-form-label text-md-right">Fecha
                                    nacimiento</label>

                                <div class="col-md-6">
                                    <input id="fecha_nacimiento" type="text"
                                        class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                        name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required
                                        autocomplete="name" autofocus>

                                    @error('fecha_nacimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="celular" class="col-md-4 col-form-label text-md-right">Celular</label>

                                <div class="col-md-6">
                                    <input id="celular" type="text"
                                        class="form-control @error('celular') is-invalid @enderror" name="celular"
                                        value="{{ old('celular') }}" required autocomplete="name" autofocus>

                                    @error('celular')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirmar
                                    contreseña</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Registrarse
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
