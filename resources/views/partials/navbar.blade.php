<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow-sm">
    <div class="container">


        <a class="navbar-brand" href="{{ url('/') }}">
            {{-- <img src="" width="30" height="30" class="d-inline-block align-top" alt="Logo"> --}}
            OLIVA
            DISEÑO E IMPRENTA
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                {{-- <li class="nav-item active">
          <a class="nav-link" href="#">Inicio</a>
        </li> --}}
                <li class="nav-item">
                    {{-- <a class="nav-link" href="#">Productos</a> --}}
                    {{-- <a href="http://"></a> --}}
                    <form class="form-inline my-2 my-lg-0" action="{{ route('busqueda') }}" method="GET">
                        <input name="buscar" class="form-control  mr-sm-2 " type="text" placeholder="Buscar"
                            aria-label="Buscar">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Categorías</a>
                </li> --}}

            </ul>

            <!-- Barra de búsqueda -->


            <br><br>
            {{-- </nav> --}}


            {{-- --------------------------------------------------- --}}

            @guest
                <ul class="navbar-nav">
                    {{-- <li class="nav-item">
                  <a class="nav-link" href="#">Carrito</a>
                </li> --}}
                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('register') }}">Crear cuenta</a>
                    </li>
                    {{-- </ul>
                <ul class="navbar-nav">
                    {{-- <li class="nav-item">
                  <a class="nav-link" href="#">Carrito</a>
                </li> --}} -
                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('login') }}">Ingresar</a>
                    </li>
                </ul>
            @else
                {{-- <ul class="navbar-nav">
                    <li class="nav-item" style="color:grey">asdasdasda</li>
                </ul> --}}
                <ul class="navbar-nav">
                    <div class="dropdown">
                        <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Menu
                        </a>

                        <div class="dropdown-menu">
                            @role(['admin', 'empresa'])
                                <a class="dropdown-item" href="/welcome">Administracion</a>
                            @endrole
                            @role('proveedor')
                                <a class="dropdown-item" href="{{ route('demandas.index') }}">Proveedor</a>
                            @endrole
                            @role('cliente')
                                {{-- <a class="dropdown-item" href="{{ route('miperfil') }}">Mi perfil</a> --}}
                                <hr>
                                <a class="dropdown-item" href="{{ route('pedidoCliente') }}">Pedidos</a>
                            @endrole
                            <hr>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                        this.closest('form').submit();">
                                    Logout
                                </a>
                            </form>

                        </div>
                    </div>

                </ul>

            @endguest




            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('shop') }}">TIENDA</a> --}}
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="badge badge-pill badge-dark">
                                <i class="fa fa-shopping-cart"></i> {{ \Cart::getTotalQuantity() }}
                            </span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"
                            style="width: 450px; padding: 0px; border-color: #9DA0A2">
                            <ul class="list-group" style="margin: 20px;">
                                @include('partials.cart-drop')
                            </ul>

                        </div>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</nav>
