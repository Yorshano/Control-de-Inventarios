<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Consultas</title>
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
    <header class="masthead bg-secondary text-white text-center" style="padding: 2rem 0;">
        <div class="container d-flex align-items-center flex-column">
            <a class="navbar-brand" href="{{ route('welcome') }}">Home</a>
            <h1 class="masthead-heading text-uppercase mb-0" style="font-size: 2rem; margin-bottom: 1rem;">
                Consultas
            </h1>
        </div>
    </header>

    <div class="page-section portfolio">
        <div class="container">
            <h1>Consultas</h1>
            <!-- Formulario de Filtros -->
            <form method="GET" action="{{ route('consultas.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tipo_consulta">Tipo de Consulta</label>
                            <select name="tipo_consulta" id="tipo_consulta" class="form-control" onchange="mostrarFiltrosAdicionales()">
                                <option value="">Seleccionar</option>
                                <option value="entradas" {{ $tipoConsulta === 'entradas' ? 'selected' : '' }}>Entradas</option>
                                <option value="salidas" {{ $tipoConsulta === 'salidas' ? 'selected' : '' }}>Salidas</option>
                                <option value="productos" {{ $tipoConsulta === 'productos' ? 'selected' : '' }}>Productos</option>
                                <option value="proveedores" {{ $tipoConsulta === 'proveedores' ? 'selected' : '' }}>Proveedores</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="filtro-fecha-inicio" style="display: none;">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
                        </div>
                    </div>
                    <div class="col-md-3" id="filtro-fecha-fin" style="display: none;">
                        <div class="form-group">
                            <label for="fecha_fin">Fecha Fin</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
                        </div>
                    </div>
                    <div class="col-md-3" id="filtro-caracterizacion" style="display: none;">
                        <div class="form-group">
                            <label for="caracterizacion_id">Filtro Caracterización</label>
                            <select name="caracterizacion_id" id="caracterizacion_id" class="form-control">
                                <option value="">Seleccionar</option>
                                @foreach ($caracterizaciones as $caracterizacion)
                                    <option value="{{ $caracterizacion->id }}" {{ request('caracterizacion_id') == $caracterizacion->id ? 'selected' : '' }}>
                                        {{ $caracterizacion->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Buscar</button>
                    </div>
                </div>
            </form>
    
            <!-- Tablas de Resultados -->
            @if ($tipoConsulta === 'entradas')
                <h2>Entradas</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entradas as $entrada)
                            <tr>
                                <td>{{ $entrada->id }}</td>
                                <td>{{ $entrada->producto->nombre }}</td>
                                <td>{{ $entrada->cantidad }}</td>
                                <td>{{ $entrada->fecha }}</td>
                                <td>{{ $entrada->proveedor->nombre }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
    
            @if ($tipoConsulta === 'salidas')
                <h2>Salidas</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salidas as $salida)
                            <tr>
                                <td>{{ $salida->id }}</td>
                                <td>{{ $salida->producto->nombre }}</td>
                                <td>{{ $salida->cantidad }}</td>
                                <td>{{ $salida->fecha }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
    
            @if ($tipoConsulta === 'productos')
                <h2>Productos</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código de Barras</th>
                            <th>Nombre</th>
                            <th>Stock Mínimo</th>
                            <th>Stock Máximo</th>
                            <th>Stock</th>
                            <th>Tipo</th>
                            <th>Caracterización</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
    
            @if ($tipoConsulta === 'proveedores')
                <h2>Proveedores</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                            <tr>
                                <td>{{ $proveedor->id }}</td>
                                <td>{{ $proveedor->nombre }}</td>
                                <td>{{ $proveedor->direccion }}</td>
                                <td>{{ $proveedor->telefono }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    
    <script>
        function mostrarFiltrosAdicionales() {
            const tipoConsulta = document.getElementById('tipo_consulta').value;
            const mostrarFecha = tipoConsulta === 'entradas' || tipoConsulta === 'salidas';
            const mostrarCaracterizacion = tipoConsulta === 'entradas';
    
            document.getElementById('filtro-fecha-inicio').style.display = mostrarFecha ? 'block' : 'none';
            document.getElementById('filtro-fecha-fin').style.display = mostrarFecha ? 'block' : 'none';
            document.getElementById('filtro-caracterizacion').style.display = mostrarCaracterizacion ? 'block' : 'none';
        }
    
        // Llamar a la función para establecer el estado inicial de los filtros
        mostrarFiltrosAdicionales();
    </script>

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
