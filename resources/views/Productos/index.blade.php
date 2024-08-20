<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>El Ché | @yield('titulo', 'Productos')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('theme/proyecto/css/styles.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Masthead-->
    <header class="masthead bg-secondary text-white text-center" style="padding: 2rem 0;">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Heading-->
            <a class="navbar-brand" href="{{ route('welcome') }}">Home</a>
            <h1 class="masthead-heading text-uppercase mb-0" style="font-size: 2rem; margin-bottom: 1rem;">
                @yield('titulo', 'Lista de Productos')</h1>
            <!-- Icon Divider-->
        </div>
    </header>

    <div class="page-section portfolio">
        <div class="container">
            <h2>Listado de Productos</h2>
            <form method="GET" action="{{ route('productos.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Buscar por Código de Barras o Nombre" value="{{ request()->input('search') }}">
                    <button type="submit" class="btn btn-secondary">Buscar</button>
                </div>
            </form>
            <a href="{{ route('productos.create') }}" class="btn btn-primary">Añadir Nuevo Producto</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código Barras</th>
                        <th>Nombre</th>
                        <th>Stock Mínimo</th>
                        <th>Stock Máximo</th>
                        <th>Stock</th>
                        <th>Tipo</th>
                        <th>Caracterización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->codigo_barras }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->stock_minimo }}</td>
                            <td>{{ $producto->stock_maximo }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>{{ $producto->tipo->nombre }}</td>
                            <td>{{ $producto->tipo->caracterizacion->nombre }}</td>
                            <td>
                                <a href="{{ route('productos.edit', $producto->id) }}"
                                    class="btn btn-primary">Editar</a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                                @if ($producto->stock <= $producto->stock_minimo)
                                    <a href="https://api.whatsapp.com/send?phone=573158329883&text={{ urlencode('El producto ' . $producto->nombre . ' tiene un stock actual de ' . $producto->stock . ' (stock mínimo: ' . $producto->stock_minimo . '). Se recomienda surtir.') }}"
                                        class="btn btn-outline-dark rounded-circle" target="_blank"><i
                                            class="fab fa-whatsapp"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Footer-->
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; Your Website 2023</small></div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('theme/proyecto/js/scripts.js') }}"></script>
    <!-- SB Forms JS-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    @if (session('alerta'))
        <script>
            alert('La operacion ha sido exitosa')
        </script>
    @endif
</body>

</html>
    