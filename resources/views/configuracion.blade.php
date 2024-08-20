<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>El Ché | @yield('titulo', 'configuracion')</title>
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
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
            background-color: rgb(255, 255, 255);
        }
        .masthead {
            padding: 2rem 0;
        }
        .page-section {
            padding: 2rem 0;
        }
        .copyright {
            padding: 1rem 0;
            background-color: #343a40; /* Un color diferente para el pie de página */
        }
    </style>
</head>

<body id="page-top">
    <!-- Masthead-->
    <header class="masthead bg-secondary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Heading-->
            <a class="navbar-brand" href="{{route('welcome')}}">Home</a>
            <h1 class="masthead-heading text-uppercase mb-0" style="font-size: 2rem; margin-bottom: 1rem;">@yield('titulo', 'configuracion')</h1>
            <!-- Icon Divider-->
        </div>
    </header>

    <div class="content">
        <div class="page-section portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3 text-center">
                        <a href="{{ route('tipos.create') }}" class="btn btn-primary">
                            Añadir Nuevo Tipo
                        </a>
                    </div>
                    <div class="col-md-4 mb-3 text-center">
                        <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
                            Añadir Nuevo Proveedor
                        </a>
                    </div>
                    <div class="col-md-4 mb-3 text-center">
                        <a href="{{ route('productos.create') }}" class="btn btn-primary">
                            Añadir Nuevo Producto
                        </a>
                    </div>
                    <div class="col-md-4 mb-3 text-center">
                        <a href="{{ route('tipos.index') }}" class="btn btn-info">
                            Ver Tipos
                        </a>
                    </div>
                    <div class="col-md-4 mb-3 text-center">
                        <a href="{{ route('proveedores.index') }}" class="btn btn-info">
                            Ver Proveedores
                        </a>
                    </div>
                    <div class="col-md-4 mb-3 text-center">
                        <a href="{{ route('productos.index') }}" class="btn btn-info">
                            Ver Productos
                        </a>
                    </div>
                    <div class="col-md-12 mb-3 text-center">
                        <a href="{{ route('caracterizacions.create') }}" class="btn btn-primary">
                            Añadir Nueva Caracterizacion
                        </a>
                    </div>
                    <div class="col-md-12 mb-3 text-center">
                        <a href="{{ route('caracterizacions.index') }}" class="btn btn-info">
                            Ver caracterizaciones
                        </a>
                    </div>
                </div>
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
