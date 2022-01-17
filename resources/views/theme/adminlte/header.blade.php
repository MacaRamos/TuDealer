<nav class="main-header navbar navbar-expand navbar-light navbar-white">
    <div class="container">
        <a href="{{ route('inicio') }}" class="navbar-brand">
            <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
        </a>
        @if (!Request::is('register') && !Request::is('login'))
            <div class="collapse navbar-collapse order-1" id="navbarCollapse">
                <!-- SEARCH FORM -->
                <form class="mx-2 my-auto d-inline @auth w-75 @endauth @guest w-50 @endguest">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Buscar"
                            aria-label="Buscar" id="busqueda">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit" id="buscar">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endif

        <!-- Right navbar links -->
        <ul class="order-2 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Left navbar links -->
            @auth
                <li class="nav-item">
                    <a href="{{ route('compras.index') }}"
                        class="nav-link {{ Request::is('compras') ? 'active' : '' }}">Mis compras</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('publicaciones.index') }}"
                        class="nav-link {{ Request::is('publicaciones') ? 'active' : '' }}">Mis publicaciones </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ventas.index') }}"
                        class="nav-link {{ Request::is('ventas') ? 'active' : '' }}">Mis Ventas </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="perfil" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">{{ Auth::user()->nombre }}</a>
                    <ul aria-labelledby="perfilSubMenu1" class="dropdown-menu border-0 shadow"
                        style="left: 0px; right: inherit;">
                        <li><a href="#" class="dropdown-item">Mi cuenta </a></li>

                        <li class="dropdown-divider"></li>

                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        <!-- End Level two -->
                    </ul>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Registrarse</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
