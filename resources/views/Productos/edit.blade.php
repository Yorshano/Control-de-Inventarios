<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>El Ché | @yield('titulo', 'Editar Producto')</title>
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
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
            background-color: rgb(255, 255, 255);
            display: flex;
            flex-direction: column;
        }

        .masthead {
            padding: 2rem 0;
        }

        .page-section {
            padding: 2rem 0;
            flex: 1;
            /* Ensures this section takes up the remaining space */
        }

        .copyright {
            padding: 1rem 0;
            background-color: #343a40;
        }
    </style>
</head>

<body id="page-top">
    <!-- Masthead-->
    <header class="masthead bg-secondary text-white text-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2 text-align: left">
                    <!-- Botón Home -->
                    <a class="navbar-brand" href="{{ route('welcome') }}">Home</a>
                </div>
                <div class="col-md-8">
                    <!-- Título -->
                    <h1 class="masthead-heading text-uppercase mb-0" style="font-size: 2rem; margin-bottom: 1rem;">
                        @yield('titulo', 'Editar Producto')
                    </h1>
                </div>
                <div class="col-md-2">
                    <!-- Espacio reservado para iconos adicionales -->
                </div>
            </div>
        </div>
    </header>

    <div class="content">
        <div class="container">
            <div class="page-section portfolio">
                <h2>Editar Producto</h2>
                <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="codigo_barras">Código Barras</label>
                        <input type="text" class="form-control" id="codigo_barras" name="codigo_barras"
                            value="{{ $producto->codigo_barras }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ $producto->nombre }}" required>
                    </div>
                    <div class="form-group">
                        <label for="stock_minimo">Stock Mínimo</label>
                        <input type="text" class="form-control" id="stock_minimo" name="stock_minimo"
                            value="{{ $producto->stock_minimo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="stock_maximo">Stock Máximo</label>
                        <input type="text" class="form-control" id="stock_maximo" name="stock_maximo"
                            value="{{ $producto->stock_maximo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_id">Tipo</label>
                        <select class="form-control" id="tipo_id" name="tipo_id" required>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}"
                                    {{ $producto->tipo_id == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nombre . " -  " . $tipo->caracterizacion->nombre}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
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
