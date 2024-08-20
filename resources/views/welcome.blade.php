<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>El Ché | @yield('titulo', 'home')</title>
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
            <h1 class="masthead-heading text-uppercase mb-0" style="font-size: 2rem; margin-bottom: 1rem;">
                @yield('titulo', 'home')</h1>
            <!-- Icon Divider-->
        </div>
    </header>

    <!-- Main Content Section with new classes -->
    <div class="page-section portfolio">
        <div class="container">
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <!-- Portfolio Item 1-->
                <div class="col-md-6 col-lg-6 mb-5">
                    <div class="portfolio-item mx-auto">
                        <a href="{{ route('configuracion') }}" class="text-decoration-none">
                            <div
                                class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid rounded-circle"
                                src="{{ asset('theme/proyecto/assets/img/portfolio/config.png') }}" alt="..."
                                style="width: 125px; height: 125px; object-fit: cover; display: block; margin: 0 auto;" />
                        </a>
                    </div>
                </div>
                <!-- Portfolio Item 2-->
                <div class="col-md-6 col-lg-6 mb-5">
                    <div class="portfolio-item mx-auto">
                        <a href="{{ route('entradas.index') }}" class="text-decoration-none">
                            <div
                                class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid rounded-circle"
                                src="{{ asset('theme/proyecto/assets/img/portfolio/entrada.png') }}" alt="..."
                                style="width: 125px; height: 125px; object-fit: cover; display: block; margin: 0 auto;" />
                        </a>
                    </div>
                </div>
                <!-- Portfolio Item 3-->
                <div class="col-md-6 col-lg-6 mb-5">
                    <div class="portfolio-item mx-auto">
                        <a href="{{ route('salidas.index') }}" class="text-decoration-none">
                            <div
                                class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid rounded-circle"
                                src="{{ asset('theme/proyecto/assets/img/portfolio/salida.png') }}" alt="..."
                                style="width: 125px; height: 125px; object-fit: cover; display: block; margin: 0 auto;" />
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 mb-5">
                    <div class="portfolio-item mx-auto">
                        <a href="{{ route('consultas.index') }}" class="text-decoration-none">
                            <div
                                class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white">
                                    <i class="fas fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <img class="img-fluid rounded-circle"
                                src="{{ asset('theme/proyecto/assets/img/portfolio/consultas.png') }}" alt="..."
                                style="width: 125px; height: 125px; object-fit: cover; display: block; margin: 0 auto;" />
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
