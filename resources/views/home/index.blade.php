@extends('app.app')

@section('title')
    Inicio
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Inicio
@endsection

@section('content')
<section class="content">
   
    

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex align-items-center">
                                <div class="me-15">
                                    <img src="{{ asset('images/svg-icon/color-svg/custom-20.svg')}}" alt="" class="w-120">
                                </div>
                                <div>
                                    <h4 class="mb-0">Total Pacientes</h4>
                                    {{-- <h3 class="mb-0">{{ $patients->Count() }}</h3> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex align-items-center">
                                <div class="me-15">
                                    <img src="{{ asset('images/svg-icon/color-svg/custom-18.svg')}}" alt="" class="w-120">
                                </div>
                                <div>
                                    <h4 class="mb-0">Total Personal</h4>
                                    {{-- <h3 class="mb-0">{{ $employees->Count() }}</h3> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex align-items-center">
                                <div class="me-15">
                                    <img src="{{ asset('images/svg-icon/color-svg/custom-17.svg')}}" alt="" class="w-120">
                                </div>
                                <div>
                                    <h4 class="mb-0">Total Atendidos</h4>
                                    <h3 class="mb-0">245 modificar</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                            <table id="tbl_medicamentos" class="table b-1 border-danger"  style="width: 100%;">
                                                <thead class="bg-danger">
                                                    <tr class="text-center">
                                                        <th>Id</th>
                                                        <th>Fecha de Compra</th>
                                                        <th>Caducidad</th>
                                                        <th>Nombre Comercial</th>
                                                        <th>Nombre Generico</th>
                                                        <th>Marca</th>
                                                        <th>Presentacion</th>
                                                        <th>Accion Terapeutica</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio de Compra</th>
                                                        <th>Precio de Venta</th>
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
                                            <table id="tbl_insumos" class="table b-1 border-danger" style="width: 100%;">
                                                <thead class="bg-danger">
                                                    <tr class="text-center">
                                                        <th>Id</th>
                                                        <th>Fecha de Compra</th>
                                                        <th>Caducidad</th>
                                                        <th>Nombre Comercial</th>
                                                        <th>Marca</th>
                                                        <th>Presentacion</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio de Compra</th>
                                                        <th>Precio de Venta</th>
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
                        data: 'fecha_compra',
                        //className: 'text-center'
                    },
                    {
                        data: 'vencimiento',
                        //className: 'text-center'
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
                        data: 'cantidad',
                        className: 'text-center'
                    },
                   {
                        data: 'precio_unitario',
                        className: 'text-end'
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
                        data: 'fecha_compra',
                        //className: 'text-center'
                    },
                    {
                        data: 'vencimiento',
                        //className: 'text-center'
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
                        data: 'cantidad',
                        className: 'text-center'
                    },
                   {
                        data: 'precio_unitario',
                        className: 'text-end'
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