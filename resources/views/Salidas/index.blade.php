<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>El Ché | @yield('titulo', 'Salidas')</title>
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
            <a class="navbar-brand" href="{{route('welcome')}}">Home</a>
            <h1 class="masthead-heading text-uppercase mb-0" style="font-size: 2rem; margin-bottom: 1rem;">
                @yield('titulo', 'Salidas')</h1>
            <!-- Icon Divider-->
        </div>
    </header>

    <div class="page-section portfolio">
        <div class="container">
            <h2>Salidas</h2>
            <a href="{{ route('salidas.create') }}" class="btn btn-primary">Registrar Salida</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salidas as $salida)
                    <tr>
                        <td>{{ $salida->id }}</td>
                        <td>{{ $salida->producto->nombre }}</td>
                        <td>{{ $salida->cantidad }}</td>
                        <td>{{ $salida->fecha }}</td>
                        <td>{{ $salida->descripcion }}</td>
                        <td>
                            <a href="{{ route('salidas.edit', $salida->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('salidas.destroy', $salida->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Footer-->
    <!-- Copyright Section-->
    <div class="py-4 bg-dark">
        <div class="container text-center">
            <small class="text-muted">Copyright &copy; Your Website 2023</small>
        </div>
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
