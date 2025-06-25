@extends('app.app')

@section('title')
    Productos
@endsection

@section('caption')
    <i class="fa fa-fw fa-shopping-basket me-2"></i>Farmacia
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tab_medicamentos" role="tab">
                                    <span class="hidden-sm-up"><i class="fa fa-fw fa-medkit"></i></span>
                                    <span class="hidden-xs-down">Medicamentos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab_insumos" role="tab">
                                    <span class="hidden-sm-up"><i class="fa fa-fw fa-shopping-cart"></i></span>
                                    <span class="hidden-xs-down">Insumos</span></a>
                            </li>
                        </ul>
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="tab_medicamentos" role="tabpanel">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                        <div class="table-responsive">
                                            <table id="tbl_medicamentos" class="table" style="width: 100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Id</th>
                                                        <th>Nombre Comercial</th>
                                                        <th>Nombre Generico</th>
                                                        <th>Marca</th>
                                                        <th>Presentacion</th>
                                                        <th>Accion Terapeutica</th>
                                                        <th>Stock</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_insumos" role="tabpanel">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                        <div class="table-responsive">
                                            <table id="tbl_insumos" class="table" style="width: 100%;">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Id</th>
                                                        <th>Nombre Comercial</th>
                                                        <th>Marca</th>
                                                        <th>Presentacion</th>
                                                        <th>Stock</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            $('#tbl_medicamentos').DataTable({
                data: @json($medicamentos),
                order: [
                    [0, 'desc']
                ],
                columns: [{
                        data: 'id',
                        visible: false
                    },
                    {
                        data: 'producto'
                    },
                    {
                        data: 'generico'
                    },
                    {
                        data: 'marca',
                        render: function(data) {
                            return data === 'NINGUNO' ? '' : data;
                        }
                    },
                    {
                        data: 'presentacion',
                        render: function(data) {
                            return data === 'NINGUNO' ? '' : data;
                        }
                    },
                    {
                        data: 'accion_terapeutica',
                        render: function(data) {
                            return data === 'NINGUNO' ? '' : data;
                        }
                    },
                    {
                        data: 'estado',
                        className: 'text-center',
                        render: function(data) {
                            switch (data) {
                                case 'A':
                                    return '<span class="badge badge-pill badge-danger">AGOTADO</span>';
                                case 'M':
                                    return '<span class="badge badge-pill badge-warning">MENOR-STOCK</span>';
                                case 'D':
                                    return '<span class="badge badge-pill badge-success">DISPONIBLE</span>';
                                default:
                                    return '<span class="badge badge-pill badge-danger">DESCONOCIDO</span>';
                            }
                        }
                    },
                    {
                        data: 'cantidad',
                        className: 'text-center'
                    },
                    {
                        data: 'precio_venta',
                        className: 'text-end'
                    }
                ],
                pageLength: 5,
                lengthChange: false,
                language: {
                    url: "{{ asset('lang/datatable.es-ES.json') }}"
                }
            });

            $('#tbl_insumos').DataTable({
                data: @json($insumos),
                order: [
                    [0, 'desc']
                ],
                columns: [{
                        data: 'id',
                        visible: false
                    },
                    {
                        data: 'producto'
                    },
                    {
                        data: 'marca',
                        render: function(data) {
                            return data === 'NINGUNO' ? '' : data;
                        }
                    },
                    {
                        data: 'presentacion',
                        render: function(data) {
                            return data === 'NINGUNO' ? '' : data;
                        }
                    },
                    {
                        data: 'estado',
                        className: 'text-center',
                        render: function(data) {
                            switch (data) {
                                case 'A':
                                    return '<span class="badge badge-pill badge-danger">AGOTADO</span>';
                                case 'M':
                                    return '<span class="badge badge-pill badge-warning">MENOR-STOCK</span>';
                                case 'D':
                                    return '<span class="badge badge-pill badge-success">DISPONIBLE</span>';
                                default:
                                    return '<span class="badge badge-pill badge-danger">DESCONOCIDO</span>';
                            }
                        }
                    },
                    {
                        data: 'cantidad',
                        className: 'text-center'
                    },
                    {
                        data: 'precio_venta',
                        className: 'text-end'
                    }
                ],
                pageLength: 5,
                lengthChange: false,
                language: {
                    url: "{{ asset('lang/datatable.es-ES.json') }}"
                }
            });
        });
    </script>
@endsection
