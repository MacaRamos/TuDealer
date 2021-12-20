@extends("theme.$theme.layout")

@section('contenido')
    <div class="container">
        <div class="row justify-content-center">
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="card card-login">
                    <div class="card-body login-card-body">
                        <div class="login-logo">
                            <a href="../../index2.html"><b>Tu</b>Dealer</a>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">x</button>
                                <div class="alert-text">
                                    @foreach ($errors->all() as $error)
                                        <span>{{ $error }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="post" autocomplete="off">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="nombre_usuario" class="form-control" placeholder="Usuario">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Contraseña">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        Recordarme
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary float-right">Inciar sesión</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
