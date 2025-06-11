@extends('app.app')


@section('title')
    Productos
@endsection


@section('caption')
    <i class="ti-home me-2"></i> Modulo Productos
@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                <div class="box">
                    <div class="box-header middle">
                        <h3 class="box-title">Lista de Productos</h3>
                        <a class="btn btn-success pull-right" data-bs-toggle="tooltip" data-container="body" title=""
                            data-bs-original-title="Nuevo Rol" href="{{ route('productos.create') }}"><i
                                class="fa fa-plus"></i></a>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tbl_Producto" class="table" style="width:100%;">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Id</th>
                                        <th>Producto</th>
                                        <th>Generico</th>
                                        <th>Tipo</th>
                                        <th class="text-end">P. Compra (Bs.)</th>
                                        <th class="text-end">Porcentaje (%)</th>
                                        <th class="text-end">P. Venta (Bs.)</th>
                                        <th>Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->id }}</td>
                                            <td>{{ $producto->producto }}</td>
                                            <td>{{ $producto->generico }}</td>
                                            <td>{{ $producto->tipo_producto == 'M' ? 'Medicamento' : 'Insumo' }}</td>
                                            <td class="text-end">{{ $producto->precio_unitario }}</td>
                                            <td class="text-end">{{ number_format($producto->porcentaje, 0) . '%' }}</td>
                                            <td class="text-end">{{ $producto->precio_venta }}</td>
                                            <td class="text-center">{{ $producto->estado }}</td>
                                            <td class="text-center">
                                                <div class="d-block text-dark flexbox">
                                                    <button type="button" id="btn_read" value="{{ $producto->id }}"
                                                        class="btn btn-info" data-bs-toggle="tooltip" data-container="body"
                                                        data-bs-original-title="Ver Producto">
                                                        <i class="mdi mdi-eye"></i></button>
                                                    <a class="btn btn-secondary" data-bs-toggle="tooltip"
                                                        data-container="body" title=""
                                                        data-bs-original-title="Editar Produto"
                                                        href="{{ route('productos.edit', $producto->id) }}">
                                                        <i class="fa fa-edit"></i></a>
                                                    <button type="button" id="btn_delete" value="{{ $producto->id }}"
                                                        class="btn btn-danger" data-bs-toggle="tooltip"
                                                        data-container="body" data-bs-original-title="Eliminar Produto">
                                                        <i class="mdi mdi-delete"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Read Roles -->
    <div class="modal center-modal fade" id="modal-read" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-end">
                        <button type="button" class="btn-close end-100" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <div class="row">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Producto:</dt>
                                            <dd id="producto"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Generico:</dt>
                                            <dd id="generico"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Concentracion:</dt>
                                            <dd id="concentracion"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Marca:</dt>
                                            <dd id="marca"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Presentacion:</dt>
                                            <dd id="presentacion"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Unidad Medida:</dt>
                                            <dd id="unidadMedida"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Accion Terapeutica:</dt>
                                            <dd id="accionTerapeutica"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Stock:</dt>
                                            <dd id="stock"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Precio Bs.:</dt>
                                            <dd id="precio"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Porcentaje %:</dt>
                                            <dd id="porcentaje"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Precio Venta Bs.:</dt>
                                            <dd id="precioVenta"></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-uniform">
                        <button type="button" class="btn btn-danger pull-right" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-script')
    <script>
        $(document).ready(function() {
            $('#tbl_Producto').DataTable({
                "order": [
                    [0, 'asc']
                ],
                "columnDefs": [{
                        "targets": 0, // Primera columna (índice 0)
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
@endsection
