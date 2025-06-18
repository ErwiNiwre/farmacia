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
                    {{-- <div class="box-body">
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
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete"
                                                data-bs-toggle="tooltip">
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
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete"
                                                data-bs-toggle="tooltip">
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
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete"
                                                data-bs-toggle="tooltip">
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
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete"
                                                data-bs-toggle="tooltip">
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
                                        <td><span class="badge badge-pill badge-success">Pending</span>
                                        </td>
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete"
                                                data-bs-toggle="tooltip">
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
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger" data-bs-original-title="Delete"
                                                data-bs-toggle="tooltip">
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
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger"
                                                data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maical Roy</td>
                                        <td>#12485791</td>
                                        <td><img src="../images/product/product-8.png" alt="product" width="50">
                                        </td>
                                        <td>Product Title</td>
                                        <td>11</td>
                                        <td>24-01-2018</td>
                                        <td><span class="badge badge-pill badge-warning">Pending</span>
                                        </td>
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger"
                                                data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maical Roy</td>
                                        <td>#12485791</td>
                                        <td><img src="../images/product/product-9.png" alt="product" width="50">
                                        </td>
                                        <td>Product Title</td>
                                        <td>13</td>
                                        <td>24-01-2018</td>
                                        <td><span class="badge badge-pill badge-success">Paid</span></td>
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger"
                                                data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maical Roy</td>
                                        <td>#12485791</td>
                                        <td><img src="../images/product/product-10.png" alt="product" width="50">
                                        </td>
                                        <td>Product Title</td>
                                        <td>34</td>
                                        <td>24-01-2018</td>
                                        <td><span class="badge badge-pill badge-warning">Pending</span>
                                        </td>
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger"
                                                data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maical Roy</td>
                                        <td>#12485791</td>
                                        <td><img src="../images/product/product-11.png" alt="product" width="50">
                                        </td>
                                        <td>Product Title</td>
                                        <td>22</td>
                                        <td>24-01-2018</td>
                                        <td><span class="badge badge-pill badge-danger">Failed</span></td>
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger"
                                                data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maical Roy</td>
                                        <td>#12485791</td>
                                        <td><img src="../images/product/product-12.png" alt="product" width="50">
                                        </td>
                                        <td>Product Title</td>
                                        <td>12</td>
                                        <td>24-01-2018</td>
                                        <td><span class="badge badge-pill badge-warning">Pending</span>
                                        </td>
                                        <td><a href="javascript:void(0)" class="text-info me-10" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="ti-marker-alt"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="text-danger"
                                                data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div> --}}
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
