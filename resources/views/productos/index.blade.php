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
                <input type="hidden" id="delete_producto_id" name="delete_attention_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center badge badge-danger">
                                ¿Estás seguro de que deseas eliminar esta Atención?
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <dl id="delete_attention_data" class="dl-horizontal">
                                </dl>
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


            $(document).on('click', '#btn_read', function() {
                event.preventDefault();
                var id = $(this).val();
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: "{{ route('productos.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        console.log(response);
                        if (response.status === 200) {
                            $('#titulo_show').text(response.data.producto.tipo_producto ===
                                'M' ? 'Vista del Medicamento' : 'Vista del Insumo');


                            $('#producto').text(response.data.producto.producto.toUpperCase());
                            $('#generico').text(response.data.producto.generico.toUpperCase());
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
                        }


                        $('#modal-show-producto').modal('show');
                    }
                });
            });


            $(document).on('click', '#btn_deleteAttention', function() {
                event.preventDefault();
                var id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('productos.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        console.log(response);
                        if (response.status === 200) {
                            $('#delete_attention_id').val(response.data.attention.id);
                            var delete_attention_data = $('#delete_attention_data');
                            delete_attention_data.empty();
                            var content = `
                                <dt>Fecha de Atención:</dt><dd>${response.data.attention.attention_date}</dd>
                                <dt>Tipo Atención:</dt><dd>${response.data.attention.attention_type.toUpperCase()}</dd>
                                <dt>Paciente:</dt><dd>${response.data.attention.patient}</dd>
                            `;
                            if (response.data.attention.specialty != null) {
                                content +=
                                    `<dt>Especialidad:</dt><dd>${response.data.attention.specialty.toUpperCase()}</dd>`;
                            }
                            content += `
                                <dt>Atención:</dt><dd>${response.data.attention.attention}</dd>
                                <dt>Monto:</dt><dd>${response.data.attention.amount + ' Bs.'}</dd>
                                <dt>Cantidad del Detalle:</dt><dd>${response.data.attention_details.length + ' Servicios'}</dd>
                            `;
                            delete_attention_data.append(content);
                            $("#modal-delete-attention").modal('show');
                        }
                    }
                });
            });
        });
    </script>
@endsection
