<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>El Ché | @yield('titulo', 'Añadir Salida')</title>
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
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Heading-->
            <a class="navbar-brand" href="{{ route('welcome') }}">Home</a>
            <h1 class="masthead-heading text-uppercase mb-0" style="font-size: 2rem; margin-bottom: 1rem;">
                @yield('titulo', 'Añadir Salida')</h1>
            <!-- Icon Divider-->
        </div>
    </header>

    <div class="content">
        <div class="container">
            <h2>Registrar Salida</h2>
            <form action="{{ route('salidas.store') }}" method="POST" id="form-salida">
                @csrf
                <div class="form-group">
                    <label for="producto_id">Producto</label>
                    <input type="number" class="form-control" id="search_producto"
                        placeholder="Buscar por código de barras">
                    <select class="form-control mt-2" id="producto_id" name="producto_id" required disabled>
                        <!-- Options will be populated by JavaScript -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
            <div id="stock-alert" class="alert alert-danger mt-3" style="display: none;">
                La cantidad no puede reducir el stock por debajo del stock mínimo.
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search_producto').addEventListener('input', function() {
            const search = this.value;
            fetch('{{ route('salidas.searchProduct') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        search: search
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const productoSelect = document.getElementById('producto_id');
                    productoSelect.innerHTML = '';
                    data.forEach(producto => {
                        const option = document.createElement('option');
                        option.value = producto.id;
                        option.setAttribute('data-stock', producto.stock);
                        option.setAttribute('data-stockmin', producto.stock_minimo);
                        option.textContent = `${producto.codigo_barras} - ${producto.nombre}`;
                        productoSelect.appendChild(option);
                    });
                    productoSelect.disabled =
                    false; // Habilitar el campo una vez se haya seleccionado un producto
                });
        });

        document.getElementById('cantidad').addEventListener('input', function() {
            const cantidad = parseInt(this.value);
            const productoSelect = document.getElementById('producto_id');
            const selectedOption = productoSelect.options[productoSelect.selectedIndex];

            if (selectedOption) {
                const stock = parseInt(selectedOption.getAttribute('data-stock'));
                const stockMin = parseInt(selectedOption.getAttribute('data-stockmin'));
                const stockAlert = document.getElementById('stock-alert');

                if (stock - cantidad < stockMin) {
                    stockAlert.style.display = 'block';
                    document.getElementById('form-salida').addEventListener('submit', function(event) {
                        event.preventDefault(); // Evitar que se envíe el formulario si hay error
                    });
                } else {
                    stockAlert.style.display = 'none';
                }
            }
        });

        // Script para establecer la fecha actual en el campo de fecha al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const fechaInput = document.getElementById('fecha');
            const fechaActual = new Date().toISOString().split('T')[
                0]; // Obtiene la fecha actual en formato YYYY-MM-DD

            fechaInput.value = fechaActual; // Establece la fecha actual como valor por defecto
        });
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
