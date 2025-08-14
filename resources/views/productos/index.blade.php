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
                        @can('producto.create')
                            <a class="waves-effect waves-light btn btn-success-light pull-right" data-bs-toggle="tooltip"
                                data-container="body" title="" data-bs-original-title="Nuevo Producto"
                                href="{{ route('productos.create') }}"><i class="fa fa-plus"></i></a>
                        @endcan
                        <a class="waves-effect waves-light btn btn-primary-light pull-right me-10" data-bs-toggle="tooltip"
                            data-container="body" title="" data-bs-original-title="Exportar Excel"
                            href="{{ route('productos.exportarExcel') }}"><i class="fa  fa-file-excel-o"></i>
                        </a>
                        <button type="button" class="waves-effect waves-light btn btn-warning-light pull-right me-10"
                            id="btn_export_rango" data-bs-toggle="tooltip" title="Exportar Excel Facturacion">
                            <i class="fa fa-cart-arrow-down"></i>
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tbl_Producto" class="table" style="width:100%;">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Id</th>
                                        <th>Cod.</th>
                                        <th>Producto</th>
                                        <th>Generico</th>
                                        <th>Concentración</th>
                                        <th>Marca</th>
                                        <th>Presentación</th>
                                        <th>Tipo</th>
                                        <th class="text-end">P. Compra (Bs.)</th>
                                        <th class="text-end">Porcentaje (%)</th>
                                        <th class="text-end">P. Venta (Bs.)</th>
                                        <th class="text-end">Cant.</th>
                                        <th>Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal-Show-Producto -->
    <div class="modal center-modal fade" id="modal-show-producto" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo_show"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

    <!-- Modal-Delete-Producto -->
    <div class="modal center-modal fade" id="modal-delete-producto" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <form id="deleteProducto" autocomplete="off">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete_producto_id" name="delete_producto_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titulo_delete"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center badge badge-danger">
                                ¿Estás seguro de que deseas eliminar esta Atención?
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <div class="row">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Producto:</dt>
                                            <dd id="producto_d"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Generico:</dt>
                                            <dd id="generico_d"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Concentracion:</dt>
                                            <dd id="concentracion_d"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Marca:</dt>
                                            <dd id="marca_d"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Presentacion:</dt>
                                            <dd id="presentacion_d"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Unidad Medida:</dt>
                                            <dd id="unidadMedida_d"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Accion Terapeutica:</dt>
                                            <dd id="accionTerapeutica_d"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Stock:</dt>
                                            <dd id="stock_d"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Precio Bs.:</dt>
                                            <dd id="precio_d"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Porcentaje %:</dt>
                                            <dd id="porcentaje_d"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Precio Venta Bs.:</dt>
                                            <dd id="precioVenta_d"></dd>
                                        </dl>
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
    <div class="modal center-modal fade" id="modal-exportacion-rango-producto" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <form id="exportarRangoProducto" autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Exportacion de Excel para Facturacion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center bg-success-light rounded p-15 mb-10 bold">
                                Seleccione el rango de registros (desde el número inicial hasta el número final) que desea
                                exportar a Excel para facturación.
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Inicio</label>
                                            <input id="inicio" type="text" value="{{ old('inicio', 1) }}"
                                                name="inicio" data-bts-button-down-class="btn btn-secondary"
                                                data-bts-button-up-class="btn btn-secondary">
                                            {!! $errors->first('inicio', '<small class="text-danger">:message</small>') !!}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Fin</label>
                                            <input id="fin" type="text" value="{{ old('fin', 1) }}"
                                                name="fin" data-bts-button-down-class="btn btn-secondary"
                                                data-bts-button-up-class="btn btn-secondary">
                                            {!! $errors->first('fin', '<small class="text-danger">:message</small>') !!}
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
            const permisos = {
                edit: @json(auth()->user()->can('producto.edit')),
                destroy: @json(auth()->user()->can('producto.destroy')),
                show: @json(auth()->user()->can('producto.show'))
            };

            $("#inicio").TouchSpin({
                min: 1,
                max: 999999
            });

            $("#fin").TouchSpin({
                min: 1,
                max: 999999
            });

            let tbl_Producto = $('#tbl_Producto').DataTable({
                data: @json($productos),
                order: [
                    [0, 'asc']
                ],
                columns: [{
                        data: 'id',
                        visible: false
                    },
                    {
                        data: 'codigo'
                    },
                    {
                        data: 'producto'
                    },
                    {
                        data: 'generico'
                    },
                    {
                        data: 'concentracion'
                    },
                    {
                        data: 'marca'
                    },
                    {
                        data: 'presentacion'
                    },
                    {
                        data: 'tipo_producto'
                    },
                    {
                        data: 'precio_unitario',
                        className: 'text-end'
                    },
                    {
                        data: 'porcentaje',
                        className: 'text-end'
                    },
                    {
                        data: 'precio_venta',
                        className: 'text-end'
                    },
                    {
                        data: 'cantidad',
                        className: 'text-center'
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
                        data: null,
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let botones = '<div class="text-dark flexbox">';

                            if (permisos.show) {
                                botones += `
                                    <button type="button" id="btn_read" value="${row.id}" class="btn btn-info" data-bs-toggle="tooltip" title="Ver Producto">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                `;
                            }

                            if (permisos.edit) {
                                botones += `
                                    <a class="btn btn-secondary" href="${row.edit_url}" data-bs-toggle="tooltip" title="Editar Producto">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                `;
                            }

                            if (permisos.destroy) {
                                botones += `
                                    <button type="button" id="btn_delete" value="${row.id}" class="btn btn-danger" data-bs-toggle="tooltip" title="Eliminar Producto">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                `;
                            }

                            botones += '</div>';
                            return botones;
                        }
                    }
                ],
                pageLength: 5,
                lengthChange: false,
                language: {
                    "url": "{{ asset('lang/datatable.es-ES.json') }}"
                }
            });

            tbl_Producto.on('draw', function() {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });

            $(document).on('click', '#btn_read', function() {
                event.preventDefault();
                var id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('productos.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        if (response.status === 200) {
                            $('#titulo_show').text(response.data.producto.tipo_producto ===
                                'M' ? 'Vista del Medicamento' : 'Vista del Insumo');

                            $('#producto').text(response.data.producto.producto.toUpperCase());
                            $('#generico').text(response.data.producto.generico ? response.data
                                .producto.generico.toUpperCase() : '');
                            $('#concentracion').text(response.data.concentracion.concentracion);
                            $('#marca').text(response.data.marca.marca);
                            $('#presentacion').text(response.data.presentacion.presentacion);
                            $('#unidadMedida').text(response.data.unidadMedida.unidad_medida);
                            $('#accionTerapeutica').text(response.data.accionTerapeutica
                                .accion_terapeutica);

                            $('#stock').text(response.data.producto.stock_minimo);
                            $('#precio').text(response.data.producto.precio_unitario);
                            $('#porcentaje').text(parseFloat(response.data.producto.porcentaje)
                                .toFixed(0));
                            $('#precioVenta').text(response.data.producto.precio_venta);
                            $('#modal-show-producto').modal('show');
                        }
                    }
                });
            });

            $(document).on('click', '#btn_delete', function() {
                event.preventDefault();
                var id = $(this).val();
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: "{{ route('productos.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        console.log(response);
                        if (response.status === 200) {
                            $('#titulo_delete').text(response.data.producto.tipo_producto ===
                                'M' ? 'Confirmar Eliminación del Medicamento' :
                                'Confirmar Eliminación del Insumo');
                            $('#delete_producto_id').val(response.data.producto.id);
                            $('#producto_d').text(response.data.producto.producto
                                .toUpperCase());
                            $('#generico_d').text(response.data.producto.generico ? response
                                .data
                                .producto.generico.toUpperCase() : '');
                            $('#concentracion_d').text(response.data.concentracion
                                .concentracion);
                            $('#marca_d').text(response.data.marca.marca);
                            $('#presentacion_d').text(response.data.presentacion.presentacion);
                            $('#unidadMedida_d').text(response.data.unidadMedida.unidad_medida);
                            $('#accionTerapeutica_d').text(response.data.accionTerapeutica
                                .accion_terapeutica);

                            $('#stock_d').text(response.data.producto.stock_minimo);
                            $('#precio_d').text(response.data.producto.precio_unitario);
                            $('#porcentaje_d').text(parseFloat(response.data.producto
                                    .porcentaje)
                                .toFixed(0));
                            $('#precioVenta_d').text(response.data.producto.precio_venta);
                            $("#modal-delete-producto").modal('show');
                        }
                    }
                });
            });

            $('#deleteProducto').on('submit', function(event) {
                event.preventDefault(); // Evita el envío normal del formulario

                var purchaseId = $('#delete_producto_id').val();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('productos.destroy', ':id') }}".replace(':id', purchaseId),
                    type: 'DELETE',
                    data: formData,
                    success: function(response) {
                        if (response.status === 200) {
                            location.reload();
                        } else {
                            alert('Ocurrió un error al Eliminar.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Ocurrió un error111: ' + error);
                    }
                });
            });

            $(document).on('click', '#btn_export_rango', function() {
                event.preventDefault();

                $("#exportarRangoProducto")[0].reset();

                $("#modal-exportacion-rango-producto").modal('show');
            })

            $('#exportarRangoProducto').on('submit', function(event) {
                event.preventDefault();

                let inicio = $('#inicio').val();
                let fin = $('#fin').val();

                if (!inicio || !fin) {
                    alert('Debes ingresar un rango válido');
                    return;
                }
                let url = "{{ route('productos.exportarRangoExcel', ['inicio' => 0, 'fin' => 0]) }}";
                url = url.replace('/0/0', `/${inicio}/${fin}`);

                window.location.href = url;

                $('#modal-exportacion-rango-producto').modal('hide');
            });
        });
    </script>
@endsection
