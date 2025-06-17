<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('images/ico/logoFiori.ico') }}">

    <title>Centro Médico Fiori | @yield('title')</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('css/horizontal-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skin_color.css') }}">

</head>

<body class="layout-top-nav dark-skin theme-success fixed">

    <!-- wrapper -->
    <div class="wrapper">
        <div id="loader"></div>
        <!-- Section Header -->
        @include('app.header')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                {{-- @if (flash()->message)
                    <div class="{{ flash()->class }}">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> {{ flash()->message }}
                    </div>
                @endif --}}
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="me-auto">
                            <h3 class="page-title"> @yield('caption')</h3>
                        </div>
                    </div>
                </div>
                <!-- Main content -->
                @yield('content')
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Section Footer -->
        @include('app.footer')

    </div>
    <!-- ./wrapper -->

    <!-- Modal -->
    <!-- Modal-View-PDF -->
    <div class="modal center-modal fade" id="modal-view-pdf" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vista de la Orden - PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-1">
                        <div class="col">
                            <div class="text-center">
                                {{-- <embed id="pdfViewer" width="100%" height="500px"> --}}
                                <iframe id="pdfViewer" width="100%" height="500px"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS -->

    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/vendor_plugins/jQueryUI/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>



    {{-- librerias necesarias para el dropdownlist search --}}
    <script src="{{ asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>




    <!-- Rhythm Admin App -->
    <script src="{{ asset('js/jquery.smartmenus.js') }}"></script>
    <script src="{{ asset('js/menus.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
{{-- librerias necesarias para el dropdownlist search --}}
    {{-- <script src="{{ asset('js/pages/advanced-form-element.js') }}"></script> --}}

    <!-- -->
    {{-- <script src="{{ asset('js/pages/data-table.js') }}"></script> --}}
    @yield('page-script')
    {{-- <script>
        $('#list_patients').DataTable();
        
        $(document).on('click', '#btn-PDF', function(e){
            e.preventDefault();
            // var pdfUrl = window.location.origin +  $(this).val();
            // var pdfUrl = $(this).val()+'?v={{ uniqid() }}';
            var pdfUrl = $(this).val();
            console.log(pdfUrl);
            $("#pdfViewer").attr("src", pdfUrl);
            $('#modal-view-pdf').modal('show');
        });
    </script> --}}
</body>

</html>
