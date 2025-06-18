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
                                                <tbody>
                                                    @foreach ($medicamentos as $medicamento)
                                                        <tr>
                                                            <td>{{ $medicamento->id }}</td>
                                                            <td>{{ $medicamento->producto }}</td>
                                                            <td>{{ $medicamento->generico }}</td>
                                                            <td>{{ $medicamento->marca == 'NINGUNO' ? '' : $medicamento->marca }}
                                                            </td>
                                                            <td>{{ $medicamento->presentacion == 'NINGUNO' ? '' : $medicamento->presentacion }}
                                                            </td>
                                                            <td>{{ $medicamento->accion_terapeutica == 'NINGUNO' ? '' : $medicamento->accion_terapeutica }}
                                                            </td>
                                                            <td class="text-center">
                                                                {!! match ($medicamento->estado) {
                                                                    'A' => '<span class="badge badge-pill badge-danger">AGOTADO</span>',
                                                                    'M' => '<span class="badge badge-pill badge-warning">MENOR-STOCK</span>',
                                                                    'D' => '<span class="badge badge-pill badge-success">DISPONIBLE</span>',
                                                                    default => '<span class="badge badge-pill badge-danger">DESCONOCIDO</span>',
                                                                } !!}
                                                            </td>
                                                            <td class="text-center">{{ $medicamento->cantidad }}</td>
                                                            <td class="text-end">{{ $medicamento->precio_venta }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
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
                                                <tbody>
                                                    @foreach ($insumos as $insumo)
                                                        <tr>
                                                            <td>{{ $insumo->id }}</td>
                                                            <td>{{ $insumo->producto }}</td>
                                                            <td>{{ $insumo->marca }}</td>
                                                            <td>{{ $insumo->presentacion == 'NINGUNO' ? '-' : $insumo->presentacion }}
                                                            </td>
                                                            <td class="text-center">
                                                                {!! match ($insumo->estado) {
                                                                    'A' => '<span class="badge badge-pill badge-danger">AGOTADO</span>',
                                                                    'M' => '<span class="badge badge-pill badge-warning">MENOR-STOCK</span>',
                                                                    'D' => '<span class="badge badge-pill badge-success">DISPONIBLE</span>',
                                                                    default => '<span class="badge badge-pill badge-danger">DESCONOCIDO</span>',
                                                                } !!}
                                                            </td>
                                                            <td class="text-center">{{ $insumo->cantidad }}</td>
                                                            <td class="text-end">{{ $insumo->precio_venta }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
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
                "order": [
                    [0, 'desc']
                ],
                "columnDefs": [{
                    "targets": 0, // Primera columna (índice 0)
                    "visible": false // Ocultar la primera columna
                }],
                pageLength: 5,
                lengthChange: false,
                "language": {
                    "url": "{{ asset('lang/datatable.es-ES.json') }}"
                }
            });

            $('#tbl_insumos').DataTable({
                "order": [
                    [0, 'desc']
                ],
                "columnDefs": [{
                    "targets": 0, // Primera columna (índice 0)
                    "visible": false // Ocultar la primera columna
                }],
                pageLength: 5,
                lengthChange: false,
                "language": {
                    "url": "{{ asset('lang/datatable.es-ES.json') }}"
                }
            });
        });
    </script>
@endsection
