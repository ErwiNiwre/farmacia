<header class="main-header">
    <!-- Section Logo and User -->
    <div class="inside-header">
        <div class="d-flex align-items-center logo-box justify-content-start">
            <!-- Logo -->
            <a href="{{ route('welcome') }}" class="logo">
                <!-- logo-->
                <div class="logo-lg">
                    {{-- <span class="light-logo"><img src="../images/logo-dark-text.png" alt="logo"></span>
                            --}}
                    <span class="dark-logo"><img src="{{ asset('images/cmFioriWhite.png') }}" alt="logo"
                            height="45px"></span>
                </div>
            </a>
        </div>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <div class="app-menu">
                <ul class="header-megamenu nav">
                    <li class="btn-group d-lg-inline-flex d-none">
                        &nbsp;
                    </li>
                </ul>
            </div>

            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                    <li class="btn-group nav-item d-lg-inline-flex d-none">
                        <a href="{{ route('login') }}"
                            class="waves-effect waves-light nav-link full-screen btn-warning-light"
                            title="Iniciar Sesión">
                            <i class="fa fa-sign-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<nav class="main-nav" role="navigation">

    <!-- Mobile menu toggle button (hamburger/x icon) -->
    <input id="main-menu-state" type="checkbox" />
    <label class="main-menu-btn" for="main-menu-state">
        <span class="main-menu-btn-icon"></span> Toggle main menu visibility
    </label>

    <!-- Sample menu definition -->
    <ul id="main-menu" class="sm sm-blue">
        <li>
            <a href="{{ route('extranet.farmacia') }}">
                <i data-feather="settings"></i>Farmacia
            </a>
        </li>
        <li>
            <a href="{{ route('extranet.servicios') }}">
                <i data-feather="settings"></i>Servicios
            </a>
        </li>
    </ul>
</nav>
