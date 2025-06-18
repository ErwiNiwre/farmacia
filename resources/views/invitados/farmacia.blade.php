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
            <div class="col-12">
                <div class="box">
                    <div class="box-header middle">
                        <h3 class="box-title">Farmacia</h3>
                    </div>
                    <div class="box-body">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tab_medicamentos" role="tab">
                                    <span class="hidden-sm-up"><i class="ion-home"></i></span>
                                    <span class="hidden-xs-down">Medicamentos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab_insumos" role="tab">
                                    <span class="hidden-sm-up"><i class="ion-person"></i></span>
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
                                                            <td>{{ $medicamento->marca }}</td>
                                                            <td>{{ $medicamento->presentacion }}</td>
                                                            <td>{{ $medicamento->accion_terapeutica }}</td>
                                                            <td class="text-center">{{ $medicamento->estado }}</td>
                                                            <td class="text-center">{{ $medicamento->cantidad }}</td>
                                                            <td class="text-end">{{ $medicamento->precio_venta }}</td>
                                                            {{-- <td>
                                                                <dl class="dl-horizontal mb-0">
                                                                    <dt>N°:</dt>
                                                                    <dd class="mb-0">
                                                                        {{ 'HC - ' . $attention->archive_number }}</dd>
                                                                    <dt>Paciente:</dt>
                                                                    <dd class="mb-0">{{ $attention->patient }}</dd>
                                                                </dl>
                                                            </td>
                                                            <td>
                                                                <dl class="dl-horizontal mb-0">
                                                                    <dt>Tipo Atención:</dt>
                                                                    <dd class="mb-0">{{ $attention->attention_type }}</dd>
                                                                    @if ($attention->specialty != null)
                                                                        <dt>Especialidad:</dt>
                                                                        <dd class="mb-0">{{ $attention->specialty }}</dd>
                                                                    @endif
                                                                    @if ($attention->staff_id != null)
                                                                        <dt>Doctor:</dt>
                                                                        <dd class="mb-0">{{ $attention->specialty }}</dd>
                                                                    @endif
                                                                    <dt>Fecha Atención:</dt>
                                                                    <dd class="mb-0">
                                                                        {{ \Carbon\Carbon::parse($attention->attention_date)->format('d/m/Y H:i:s') }}
                                                                    </dd>
                                                                </dl>
                                                            </td>
                                                            <td>
                                                                <dl class="dl-horizontal mb-0">
                                                                    <dt>Atención:</dt>
                                                                    <dd>
                                                                        {!! match ($attention->attention_state) {
                                                                            'P' => '<span class="badge badge-pill badge-danger">PENDIENTE</span>',
                                                                            'S' => '<span class="badge badge-pill badge-primary">EN SALA</span>',
                                                                            'C' => '<span class="badge badge-pill badge-info">EN CONSULTA</span>',
                                                                            'R' => '<span class="badge badge-pill badge-success">REALIZADO</span>',
                                                                            'X' => '<span class="badge badge-pill badge-danger">CANCELADO</span>',
                                                                            'N' => '<span class="badge badge-pill badge-danger">NO VINO</span>',
                                                                            default => '<span class="badge badge-pill badge-danger">DESCONOCIDO</span>',
                                                                        } !!}
                                                                    </dd>
                                                                    <dt>Pago:</dt>
                                                                    <dd>
                                                                        {!! match ($attention->payment_state) {
                                                                            'E' => '<span class="badge badge-pill badge-danger">EN ESPERA</span>',
                                                                            'P' => '<span class="badge badge-pill badge-success">PAGADO</span>',
                                                                            'C' => '<span class="badge badge-pill badge-danger">CANCELADO</span>',
                                                                            default => '<span class="badge badge-pill badge-danger">DESCONOCIDO</span>',
                                                                        } !!}
                                                                    </dd>
                                                                    <dt>Metodo Pago:</dt>
                                                                    <dd>
                                                                        {!! match ($attention->payment_method) {
                                                                            'N' => '<span class="badge badge-pill badge-danger">NINGUNO</span>',
                                                                            'E' => '<span class="badge badge-pill badge-success">EFECTIVO</span>',
                                                                            'Q' => '<span class="badge badge-pill badge-success">QR</span>',
                                                                            'M' => '<span class="badge badge-pill badge-success">MIXTO</span>',
                                                                            default => '<span class="badge badge-pill badge-danger">DESCONOCIDO</span>',
                                                                        } !!}
                                                                    </dd>
                                                                </dl>
                                                            </td> --}}
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
                                                            <td>{{ $insumo->presentacion }}</td>
                                                            <td>{{ $insumo->estado }}</td>
                                                            <td>{{ $insumo->cantidad }}</td>
                                                            <td>{{ $insumo->precio_venta }}</td>
                                                            {{-- <td>
                                                                <dl class="dl-horizontal mb-0">
                                                                    <dt>N°:</dt>
                                                                    <dd class="mb-0">
                                                                        {{ 'HC - ' . $procedure->archive_number }}</dd>
                                                                    <dt>Paciente:</dt>
                                                                    <dd class="mb-0">{{ $procedure->patient }}</dd>
                                                                </dl>
                                                            </td>
                                                            <td>
                                                                <dl class="dl-horizontal mb-0">
                                                                    <dt>Especialidad:</dt>
                                                                    <dd class="mb-0">{{ $procedure->specialty }}</dd>
                                                                    <dt>Fecha Procedimiento:</dt>
                                                                    <dd class="mb-0">
                                                                        {{ \Carbon\Carbon::parse($procedure->procedure_date)->format('d/m/Y H:i:s') }}
                                                                    </dd>
                                                                    @if ($procedure->staff_id != null)
                                                                        <dt>Doctor:</dt>
                                                                        <dd class="mb-0">{{ $procedure->staff_id }}</dd>
                                                                    @endif
                                                                    <dt>Centro Referencia:</dt>
                                                                    <dd class="mb-0">{{ $procedure->reference_center }}
                                                                    </dd>
                                                                    <dt>Referencia:</dt>
                                                                    <dd class="mb-0">{{ $procedure->doctor_sends }}</dd>
                                                                </dl>
                                                            </td>
                                                            <td>
                                                                <div class="d-block text-dark flexbox">
                                                                    @if ($procedure->file_route != null && $procedure->diagnostic_status == 'S')
                                                                        @if ($procedure->file_type == 'P')
                                                                            <button type="button" id="btn_showAttention"
                                                                                value="{{ $procedure->file_route }}"
                                                                                class="btn btn-default btn-sm"
                                                                                data-bs-toggle="tooltip"
                                                                                data-container="body"
                                                                                data-bs-original-title="Ver Orden PDF"><i
                                                                                    class="mdi mdi-file-pdf me-15"></i>Orden</button>
                                                                        @else
                                                                            <button type="button" id="btn_showAttention"
                                                                                value="{{ $procedure->file_route }}"
                                                                                class="btn btn-default btn-sm"
                                                                                data-bs-toggle="tooltip"
                                                                                data-container="body"
                                                                                data-bs-original-title="Ver Orden Imagen"><i
                                                                                    class="mdi mdi-file-image me-15"></i>Orden</button>
                                                                        @endif
                                                                    @endif
                                                                    @if (count($procedure->details) != 0)
                                                                        @foreach ($procedure->details as $consent)
                                                                            @if ($consent->consent_state == 'S')
                                                                                <button type="button"
                                                                                    id="btn_showAttention"
                                                                                    value="{{ $consent->consent_name }}"
                                                                                    class="btn btn-dark btn-sm"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-container="body"
                                                                                    data-bs-original-title="Ver {{ $consent->procedure_type }}"><i
                                                                                        class="mdi mdi-file-pdf me-15"></i>{{ $consent->consent_name }}</button>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <dl class="dl-horizontal mb-0">
                                                                    <dt>Procedimiento:</dt>
                                                                    <dd>
                                                                        {!! match ($procedure->procedure_state) {
                                                                            'S' => '<span class="badge badge-pill badge-primary">EN SALA</span>',
                                                                            'C' => '<span class="badge badge-pill badge-info">EN CONSULTA</span>',
                                                                            'R' => '<span class="badge badge-pill badge-success">REALIZADO</span>',
                                                                            'P' => '<span class="badge badge-pill badge-warning">PAGAR</span>',
                                                                            'F' => '<span class="badge badge-pill badge-success">FINALIZADO</span>',
                                                                            'X' => '<span class="badge badge-pill badge-danger">CANCELADO</span>',
                                                                            'N' => '<span class="badge badge-pill badge-danger">NO VINO</span>',
                                                                            default => '<span class="badge badge-pill badge-danger">DESCONOCIDO</span>',
                                                                        } !!}
                                                                    </dd>
                                                                    <dt>Pago:</dt>
                                                                    <dd>
                                                                        {!! match ($procedure->payment_state) {
                                                                            'E' => '<span class="badge badge-pill badge-danger">EN ESPERA</span>',
                                                                            'A' => '<span class="badge badge-pill badge-warning">ADELANTADO</span>',
                                                                            'P' => '<span class="badge badge-pill badge-success">PAGADO</span>',
                                                                            'C' => '<span class="badge badge-pill badge-danger">CANCELADO</span>',
                                                                            default => '<span class="badge badge-pill badge-danger">DESCONOCIDO</span>',
                                                                        } !!}
                                                                    </dd>
                                                                    <dt>Metodo Pago:</dt>
                                                                    <dd>
                                                                        {!! match ($procedure->payment_method) {
                                                                            'N' => '<span class="badge badge-pill badge-danger">NINGUNO</span>',
                                                                            'E' => '<span class="badge badge-pill badge-success">EFECTIVO</span>',
                                                                            'Q' => '<span class="badge badge-pill badge-success">QR</span>',
                                                                            'M' => '<span class="badge badge-pill badge-success">MIXTO</span>',
                                                                            default => '<span class="badge badge-pill badge-danger">DESCONOCIDO</span>',
                                                                        } !!}
                                                                    </dd>
                                                                </dl>
                                                            </td> --}}
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
