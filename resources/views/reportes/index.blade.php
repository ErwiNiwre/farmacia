@extends('app.app')

@section('title')
    Reportes
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Reportes
@endsection

@section('content')
    <section class="content">

        <div class="row">

            <div class="col-12 col-xl-6">
                <div class="box">
                    <div class="box-header bg-success">
                        <h4 class="box-title text-white">REPORTES DE VENTAS</h4>
                    </div>
                    <div class="box-body px-0 bg-success rounded-0">
                        <div id="spark1" class="text-dark"></div>
                    </div>
                    <div class="box-body up-mar60 pb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                                    <span class="mdi mdi-cash d-block fs-40"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span></span>
                                    <a href="#" class="text-white fw-500 fs-18" data-bs-toggle="modal"
                                        data-bs-target="#modal-ventas-fecha">
                                        Ventas por Fecha
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                                    <span class="mdi mdi-cash-multiple d-block fs-40"><span class="path1"></span><span
                                            class="path2"></span></span>
                                    <a href="#" class="text-white fw-500 fs-18" data-bs-toggle="modal"
                                        data-bs-target="#modal-productos-vendidos">
                                        Productos mas Vendidos
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                                    <span class="mdi mdi-currency-usd d-block fs-40"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span></span>
                                    <a href="#" class="text-white fw-500 fs-18" data-bs-toggle="modal"
                                        data-bs-target="#modal-ventas-totales">
                                        Ventas Totales por Fecha
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="box">
                    <div class="box-header bg-primary">
                        <h4 class="box-title text-white">REPORTE DE COMPRAS</h4>

                    </div>
                    <div class="box-body px-0 bg-primary rounded-0">
                        <div id="spark2" class="text-dark"></div>
                    </div>
                    <div class="box-body up-mar60 pb-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                                    <span class="mdi mdi-cart d-block fs-40"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span></span>
                                    <a href="#" class="text-primary fw-500 fs-18" data-bs-toggle="modal"
                                        data-bs-target="#modal-compras-fecha">
                                        Compras por Fecha
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                                    <span class="mdi mdi-cart-plus d-block fs-40"><span class="path1"></span><span
                                            class="path2"></span></span>
                                    <a href="#" class="text-primary fw-500 fs-18" data-bs-toggle="modal"
                                        data-bs-target="#modal-productos-mas-comprados">
                                        Productos mas Comprados
                                    </a>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-xl-6">
                    <div class="box">
                        <div class="box-header bg-warning">
                            <h4 class="box-title text-white">REPORTES DE PRODUCTOS</h4>

                        </div>
                        <div class="box-body px-0 bg-warning rounded-0">
                            <div id="spark1" class="text-dark"></div>
                        </div>
                        <div class="box-body up-mar60 pb-0">
                            <div class="row">
                                <div class="col-6">
                                    <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                                        <span class="mdi mdi-close-octagon d-block fs-40"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span></span>
                                        <a href="#" class="text-warning fw-500 fs-18" data-bs-toggle="modal"
                                            data-bs-target="#modal-productos-caducos">
                                            Productos Caducados
                                        </a>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="bg-lightest px-30 py-40 rounded20 mb-20">
                                        <span class="mdi  mdi-clock-alert d-block fs-40"><span class="path1"></span><span
                                                class="path2"></span></span>
                                        <a href="#" class="text-warning fw-500 fs-18" data-bs-toggle="modal"
                                            data-bs-target="#modal-productos-por-caducar">
                                            Productos por Caducar
                                        </a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Modal-Exportacion-Rango-Producto -->
    <div class="modal center-modal fade" id="modal-ventas-fecha" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <form id="reporteVentasFecha" autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">REPORTE DE VENTAS POR FECHA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center bg-warning-light rounded p-15 mb-10 bold " style="font-size: 20px">
                               Ingrese el rango de fecha 
                            </div> --}}

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Desde</label>
                                            <input id="fecha_inicio" class="form-control" type="date"
                                                value="{{ date('Y-m-d') }}" name="fecha_inicio">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Hasta</label>
                                            <input id="fecha_fin" type="date" class="form-control"
                                                value="{{ date('Y-m-d') }}" name="fecha_fin">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Formato</label>
                                            <select id ="formato_ventas_fecha" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">PDF</option>
                                                <option>Excel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Tipo de Movimiento</label>
                                            <select id ="tipo_movimiento" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">Todos</option>
                                                <option>Venta</option>
                                                <option>Salida Directa</option>
                                                <option>Cuentas por Cobrar</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary float-end">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal-Exportacion-Rango-Producto -->
    <div class="modal center-modal fade" id="modal-ventas-totales" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <form id="reporteVentasTotales" autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">REPORTE DE VENTAS TOTALES POR FECHA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center bg-warning-light rounded p-15 mb-10 bold " style="font-size: 20px">
                               Ingrese el rango de fecha 
                            </div> --}}

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Desde</label>
                                            <input id="fecha_inicio_totales" class="form-control" type="date"
                                                value="{{ date('Y-m-d') }}" name="fecha_inicio">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Hasta</label>
                                            <input id="fecha_fin_totales" type="date" class="form-control"
                                                value="{{ date('Y-m-d') }}" name="fecha_fin">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Formato</label>
                                            <select id ="formato_ventas_fecha_totales" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">PDF</option>
                                                <option>Excel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Tipo de Movimiento</label>
                                            <select id ="tipo_movimiento_totales" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">Todos</option>
                                                <option>Venta</option>
                                                <option>Salida Directa</option>
                                                <option>Cuentas por Cobrar</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary float-end">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal center-modal fade" id="modal-productos-vendidos" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <form id="reporteProductosVendidos" autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">PRODUCTOS MAS VENDIDOS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center bg-warning-light rounded p-15 mb-10 bold " style="font-size: 20px">
                               Ingrese el rango de fecha 
                            </div> --}}

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Desde</label>
                                            <input id="fecha_inicio_p_v" class="form-control" type="date"
                                                value="{{ date('Y-m-d') }}" name="fecha_inicio_p_v">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Hasta</label>
                                            <input id="fecha_fin_p_v" type="date" class="form-control"
                                                value="{{ date('Y-m-d') }}" name="fecha_fin_p_v">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Formato</label>
                                            <select id ="formato_p_v" class="form-control select2" style="width: 100%;">
                                                <option selected="selected">PDF</option>
                                                <option>Excel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Tipo de Movimiento</label>
                                            <select id ="tipo_movimiento_p_v" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">Todos</option>
                                                <option>Venta</option>
                                                <option>Salida Directa</option>
                                                <option>Cuentas por Cobrar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Cantidad de Productos</label>
                                            <input id="cantidad_p_v" type="number" class="form-control" value="10"
                                                name="cantidad_p_v">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary float-end">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal center-modal fade" id="modal-productos-caducos" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <form id="reporteProductosCaducos" autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">PRODUCTOS POR CADUCAR</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center bg-warning-light rounded p-15 mb-10 bold " style="font-size: 20px">
                               Ingrese el rango de fecha 
                            </div> --}}

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Formato</label>
                                            <select id ="formato_p_c" class="form-control select2" style="width: 100%;">
                                                <option selected="selected">PDF</option>
                                                <option>Excel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Tipo de Movimiento</label>
                                            <select id ="tipo_movimiento_p_c" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">Todos</option>
                                                <option>Compra</option>
                                                <option>Ingreso Directo</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary float-end">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal center-modal fade" id="modal-productos-por-caducar" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <form id="reporteProductosPorCaducar" autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">PRODUCTOS POR CADUCAR</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center bg-warning-light rounded p-15 mb-10 bold " style="font-size: 20px">
                               Ingrese el rango de fecha 
                            </div> --}}

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Fecha Limite</label>
                                            <input id="fecha_limite_p_p_c" class="form-control" type="date"
                                                value="{{ date('Y-m-d') }}" name="fecha_inicio_p_v">

                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Formato</label>
                                            <select id ="formato_p_p_c" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">PDF</option>
                                                <option>Excel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Tipo de Movimiento</label>
                                            <select id ="tipo_movimiento_p_p_c" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">Todos</option>
                                                <option>Compra</option>
                                                <option>Ingreso Directo</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary float-end">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal-Exportacion-Rango-Producto -->
    <div class="modal center-modal fade" id="modal-compras-fecha" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <form id="reporteComprasFecha" autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">REPORTE DE COMPRAS POR FECHA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center bg-warning-light rounded p-15 mb-10 bold " style="font-size: 20px">
                               Ingrese el rango de fecha 
                            </div> --}}

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Desde</label>
                                            <input id="fecha_inicio_c" class="form-control" type="date"
                                                value="{{ date('Y-m-d') }}" name="fecha_inicio">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Hasta</label>
                                            <input id="fecha_fin_c" type="date" class="form-control"
                                                value="{{ date('Y-m-d') }}" name="fecha_fin">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Formato</label>
                                            <select id ="formato_c" class="form-control select2" style="width: 100%;">
                                                <option selected="selected">PDF</option>
                                                <option>Excel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Tipo de Movimiento</label>
                                            <select id ="tipo_movimiento_c" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">Todos</option>
                                                <option>Compra</option>
                                                <option>Ingreso Directo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary float-end">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal center-modal fade" id="modal-productos-mas-comprados" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <form id="reporteProductosMasComprados" autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">PRODUCTOS MAS COMPRADOS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center bg-warning-light rounded p-15 mb-10 bold " style="font-size: 20px">
                               Ingrese el rango de fecha 
                            </div> --}}

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Desde</label>
                                            <input id="fecha_inicio_p_m_c" class="form-control" type="date"
                                                value="{{ date('Y-m-d') }}" name="fecha_inicio_p_m_c">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Hasta</label>
                                            <input id="fecha_fin_p_m_c" type="date" class="form-control"
                                                value="{{ date('Y-m-d') }}" name="fecha_fin_p_m_c">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Formato</label>
                                            <select id ="formato_p_m_c" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">PDF</option>
                                                <option>Excel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Tipo de Movimiento</label>
                                            <select id ="tipo_movimiento_p_m_c" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected">Todos</option>
                                                <option>Compra</option>
                                                <option>Ingreso Directo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Cantidad de Productos</label>
                                            <input id="cantidad_p_m_c" type="number" class="form-control"
                                                value="10" name="cantidad_p_v">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary float-end">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('page-script')
    <script>
        $(document).ready(function() {


            $('.select2').select2({
                dropdownParent: $('#modal-ventas-fecha')
            });
            $('#modal-ventas-totales .select2').select2({
                dropdownParent: $('#modal-ventas-totales')
            });

            $('#modal-productos-vendidos .select2').select2({
                dropdownParent: $('#modal-productos-vendidos')
            });
            $('#modal-productos-caducos .select2').select2({
                dropdownParent: $('#modal-productos-caducos')
            });
            $('#modal-productos-por-caducar .select2').select2({
                dropdownParent: $('#modal-productos-por-caducar')
            });
            $('#modal-compras-fecha .select2').select2({
                dropdownParent: $('#modal-compras-fecha')
            });
            $('#modal-productos-mas-comprados .select2').select2({
                dropdownParent: $('#modal-productos-mas-comprados')
            });


            $('#reporteVentasFecha').on('submit', function(event) {
                event.preventDefault();

                let fecha_inicio = $('#fecha_inicio').val();
                let fecha_fin = $('#fecha_fin').val();
                let tipo_formato = $('#formato_ventas_fecha').val();
                let tipo_movimiento = $('#tipo_movimiento').val();

                if (!fecha_inicio || !fecha_fin) {
                    alert('Ingrese fechas validas');
                    return;
                }

                let url =
                    "{{ route('reportes.reporteVentasFecha', ['fecha_inicio' => ':fecha_inicio', 'fecha_fin' => ':fecha_fin', 'formato_ventas_fecha' => ':formato_ventas_fecha', 'tipo_movimiento' => ':tipo_movimiento']) }}";
                url = url.replace(':fecha_inicio', fecha_inicio).replace(':fecha_fin', fecha_fin).replace(
                        ':formato_ventas_fecha', tipo_formato)
                    .replace(':tipo_movimiento', tipo_movimiento);


                window.open(url, '_blank');

                $('#modal-ventas-fecha').modal('hide');
            });

            $('#reporteProductosVendidos').on('submit', function(event) {
                event.preventDefault();

                let fecha_inicio_p_v = $('#fecha_inicio_p_v').val();
                let fecha_fin_p_v = $('#fecha_fin_p_v').val();
                let formato_p_v = $('#formato_p_v').val();
                let tipo_movimiento_p_v = $('#tipo_movimiento_p_v').val();
                let cantidad_p_v = $('#cantidad_p_v').val();

                if (!fecha_inicio || !fecha_fin) {
                    alert('Ingrese fechas validas');
                    return;
                }

                let url =
                    "{{ route('reportes.reporteProductosVendidos', ['fecha_inicio' => ':fecha_inicio', 'fecha_fin' => ':fecha_fin', 'formato' => ':formato', 'tipo_movimiento' => ':tipo_movimiento', 'cantidad' => ':cantidad']) }}";
                url = url.replace(':fecha_inicio', fecha_inicio_p_v).replace(':fecha_fin', fecha_fin_p_v)
                    .replace(':formato', formato_p_v)
                    .replace(':tipo_movimiento', tipo_movimiento_p_v).replace(':cantidad', cantidad_p_v);


                window.open(url, '_blank');

                $('#modal-ventas-fecha').modal('hide');
            });
            $('#reporteVentasTotales').on('submit', function(event) {

                event.preventDefault();

                let fecha_inicio = $('#fecha_inicio_totales').val();
                let fecha_fin = $('#fecha_fin_totales').val();
                let tipo_formato = $('#formato_ventas_fecha_totales').val();
                let tipo_movimiento = $('#tipo_movimiento_totales').val();

                if (!fecha_inicio || !fecha_fin) {
                    alert('Ingrese fechas validas');
                    return;
                }

                let url =
                    "{{ route('reportes.reporteVentasTotales', ['fecha_inicio' => ':fecha_inicio', 'fecha_fin' => ':fecha_fin', 'formato_ventas_fecha' => ':formato_ventas_fecha', 'tipo_movimiento' => ':tipo_movimiento']) }}";
                url = url.replace(':fecha_inicio', fecha_inicio).replace(':fecha_fin', fecha_fin).replace(
                        ':formato_ventas_fecha', tipo_formato)
                    .replace(':tipo_movimiento', tipo_movimiento);

                console.log(url);
                window.open(url, '_blank');

                $('#modal-ventas-totales').modal('hide');
            });

            $('#reporteProductosCaducos').on('submit', function(event) {
                event.preventDefault();


                let formato_p_c = $('#formato_p_c').val();
                let tipo_movimiento_p_c = $('#tipo_movimiento_p_c').val();
                if (!fecha_inicio || !fecha_fin) {
                    alert('Ingrese fechas validas');
                    return;
                }

                let url =
                    "{{ route('reportes.reporteProductosCaducados', ['tipo_movimiento' => ':tipo_movimiento', 'formato' => ':formato']) }}";
                url = url.replace(':tipo_movimiento', tipo_movimiento_p_c).replace(':formato', formato_p_c);


                window.open(url, '_blank');

                $('#modal-ventas-fecha').modal('hide');
            });


            $('#reporteProductosPorCaducar').on('submit', function(event) {
                event.preventDefault();

                let fecha_limite_p_p_c = $('#fecha_limite_p_p_c').val();
                let formato_p_p_c = $('#formato_p_p_c').val();
                let tipo_movimiento_p_p_c = $('#tipo_movimiento_p_p_c').val();
                if (!fecha_inicio || !fecha_fin) {
                    alert('Ingrese fechas validas');
                    return;
                }

                let url =
                    "{{ route('reportes.reporteProductosPorCaducar', ['fecha_limite' => ':fecha_limite', 'tipo_movimiento' => ':tipo_movimiento', 'formato' => ':formato']) }}";
                url = url.replace(':fecha_limite', fecha_limite_p_p_c).replace(':tipo_movimiento',
                    tipo_movimiento_p_p_c).replace(':formato', formato_p_p_c);


                window.open(url, '_blank');

                $('#modal-ventas-fecha').modal('hide');
            });

            $('#reporteComprasFecha').on('submit', function(event) {
                event.preventDefault();

                let fecha_inicio_c = $('#fecha_inicio_c').val();
                let fecha_fin_c = $('#fecha_fin_c').val();
                let formato_c = $('#formato_c').val();
                let tipo_movimiento_c = $('#tipo_movimiento_c').val();
                if (!fecha_inicio || !fecha_fin) {
                    alert('Ingrese fechas validas');
                    return;
                }

                let url =
                    "{{ route('reportes.reporteComprasFecha', ['fecha_inicio' => ':fecha_inicio', 'fecha_fin' => ':fecha_fin', 'formato' => ':formato', 'tipo_movimiento' => ':tipo_movimiento']) }}";
                url = url.replace(':fecha_inicio', fecha_inicio_c).replace(':fecha_fin', fecha_fin_c)
                    .replace(':formato', formato_c)
                    .replace(':tipo_movimiento', tipo_movimiento_c);

                window.open(url, '_blank');

                $('#modal-ventas-fecha').modal('hide');
            });

            $('#reporteProductosMasComprados').on('submit', function(event) {
                event.preventDefault();

                let fecha_inicio_p_m_c = $('#fecha_inicio_p_m_c').val();
                let fecha_fin_p_m_c = $('#fecha_fin_p_m_c').val();
                let formato_p_m_c = $('#formato_p_m_c').val();
                let tipo_movimiento_p_m_c = $('#tipo_movimiento_p_m_c').val();
                let cantidad_p_m_c = $('#cantidad_p_m_c').val();

                if (!fecha_inicio || !fecha_fin) {
                    alert('Ingrese fechas validas');
                    return;
                }

                let url =
                    "{{ route('reportes.reporteProductosMasComprados', ['fecha_inicio' => ':fecha_inicio', 'fecha_fin' => ':fecha_fin', 'formato' => ':formato', 'tipo_movimiento' => ':tipo_movimiento', 'cantidad' => ':cantidad']) }}";
                url = url.replace(':fecha_inicio', fecha_inicio_p_m_c).replace(':fecha_fin',
                        fecha_fin_p_m_c).replace(':formato', formato_p_m_c)
                    .replace(':tipo_movimiento', tipo_movimiento_p_m_c).replace(':cantidad',
                    cantidad_p_m_c);


                window.open(url, '_blank');

                $('#modal-ventas-fecha').modal('hide');
            });

        });
    </script>
@endsection
