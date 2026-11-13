<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>@yield('titulo', 'Panel Principal') - DISFARMA Honduras</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
            <a class="navbar-brand ps-3 fw-bold" href="{{ route('dashboard') }}">
                <i class="fas fa-pills me-2"></i>DISFARMA
            </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="navbar-nav ms-auto me-3 me-lg-4 align-items-center">
                <li class="nav-item text-white me-3">
                    <i class="fas fa-user-md me-1"></i>
                    <span>{{ Auth::user()->name ?? 'Invitado' }}</span>
                </li>
                @auth
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">
                            <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                        </button>
                    </form>
                </li>
                @endauth
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Principal</div>
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Módulos Operativos</div>
                            <a class="nav-link {{ request()->routeIs('medicamentos.*') ? 'active' : '' }}" href="{{ route('medicamentos.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-capsules"></i></div>
                                Medicamentos
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Sistema Integral</div>
                        DISFARMA Honduras
                    </div>
                </nav>
            </div>

            <!-- Contenedor Principal de Inyección -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 pt-4">
                        @yield('contenido')
                    </div>
                </main>

                <!-- Pie de Página Institucional -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">
                                &copy; {{ date('Y') }} Droguería y Distribuidora Farmacéutica San Rafael S. de R.L. (DISFARMA Honduras)
                            </div>
                            <div class="text-muted">
                                Bulevar Suyapa, Tegucigalpa &bull; Bulevar del Norte, SPS
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>