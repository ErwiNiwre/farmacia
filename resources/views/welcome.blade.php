<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('images/ico/logoFiori.ico')}}">

    <title>Centro Médico Fiori | @yield('title')</title>
    
    <link rel="stylesheet" href="{{ asset('css/vendors_css.css') }}">

    <link rel="stylesheet" href="{{ asset('css/horizontal-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skin_color.css') }}">

</head>

<body class="layout-top-nav dark-skin theme-success fixed">

    <!-- wrapper -->
    <div class="wrapper">
        <div id="loader"></div>
        <!-- Section Header -->
        <header class="main-header">
            <!-- Section Logo and User -->
            <div class="inside-header">
                <div class="d-flex align-items-center logo-box justify-content-start">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="logo">
                        <!-- logo-->
                        <div class="logo-lg">
                            {{-- <span class="light-logo"><img src="../images/logo-dark-text.png" alt="logo"></span>
                            --}}
                            <span class="dark-logo"><img src="{{ asset('images/cmFioriWhite.png')}}" alt="logo" height="45px"></span>
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
                                <a href="{{ route('login') }}" class="waves-effect waves-light nav-link full-screen btn-warning-light" title="Iniciar Sesión">
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
                    <a href="#">
                        <i data-feather="settings"></i>Farmacia
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i data-feather="settings"></i>Servicios
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <h3 class="page-title"> <i class="ti-home me-2"></i> Bienvenidos</h3>
                        </div>
                    </div>
                </div>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="productorder" class="table table-hover no-wrap product-order" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>Customer</th>
                                                <th>Order ID</th>
                                                <th>Photo</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-1.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>17</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-success">Paid</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-2.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>12</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-warning">Pending</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-3.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>15</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-success">Paid</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-4.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>19</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-danger">Failed</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-5.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>24</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-success">Pending</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-6.png" alt="product" width="50"></td>
                                                <td>Product Title</td>

                                                <td>04</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-danger">Failed</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-7.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>10</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-success">Paid</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-8.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>11</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-warning">Pending</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-9.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>13</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-success">Paid</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-10.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>34</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-warning">Pending</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-11.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>22</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-danger">Failed</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Maical Roy</td>
                                                <td>#12485791</td>
                                                <td><img src="../images/product/product-12.png" alt="product" width="50"></td>
                                                <td>Product Title</td>
                                                <td>12</td>
                                                <td>24-01-2018</td>
                                                <td><span class="badge badge-pill badge-warning">Pending</span></td>
                                                <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                        <i class="ti-marker-alt"></i>
                                                    </a> 
                                                    <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                        </tbody>						
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Section Footer -->
        <footer class="main-footer">
            <div class="pull-right d-none d-sm-inline-block">
                <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                    <li class="nav-item">
                        <a class="nav-link">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">PHP v{{ PHP_VERSION }}</a>
                    </li>
                </ul>
            </div>
            &copy; {{ date('Y') }} <a href="http://cmfdev00/farmacia/">Centro Médico Fiori</a>. Todos los derechos reservados.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- Vendor JS -->
    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/vendor_plugins/jQueryUI/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>

    <!-- Rhythm Admin App -->
    <script src="{{ asset('js/jquery.smartmenus.js') }}"></script>
    <script src="{{ asset('js/menus.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script>
        $(document).ready(function(){

            $('#productorder').DataTable({
                "order": [[0, 'desc']],
                "columnDefs": [
                    {
                        "targets": 0, // Primera columna (índice 0)
                        "type": "num",
                        "visible": false // Ocultar la primera columna
                    },
                    {
                        "targets": -1, // Última columna
                        "orderable": false,
                        "searchable": false
                    }
                ],
                pageLength: 5,
                lengthChange: false,
                "language": {
                    "url": "{{ asset('lang/datatable.es-ES.json') }}"
                }
            });


        });
    </script>
</body>

</html>