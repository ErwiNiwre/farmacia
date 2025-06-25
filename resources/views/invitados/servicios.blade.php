@extends('app.app')

@section('title')
    Servicios
@endsection

@section('caption')
    <i class="fa fa-fw fa-stethoscope me-2"></i>Servicios
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tbl_ServiciosLaboratorio" class="table table-hover no-wrap product-order"
                                style="width:100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>SERVICIO</th>
                                        <th>CLASIFICACION</th>
                                        <th>PRECIO</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>SERVICIO</th>
                                        <th>CLASIFICACION</th>
                                        <th>PRECIO</th>
                                    </tr>
                                </tfoot>
                            </table>
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

            $('#tbl_ServiciosLaboratorio tfoot th').each(function(index) {
                let totalColumns = $('#tbl_ServiciosLaboratorio thead th').length;
                if (index !== 0 && index !== totalColumns - 1) {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="BUSCAR ' + title + '" />');
                } else {
                    $(this).html('');
                }
            });

            var tbl_Servicios = $('#tbl_ServiciosLaboratorio').DataTable({
                data: @json($laboratorio_servicios),
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    targets: 0,
                    visible: false
                }],
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'servicio'
                    },
                    {
                        data: 'clasificacion'
                    },
                    {
                        data: 'precio',
                        className: 'text-end'
                    }
                ],
                pageLength: 5,
                lengthChange: false,
                language: {
                    url: "{{ asset('lang/datatable.es-ES.json') }}"
                },
                initComplete: function() {
                    var api = this.api();
                    var totalColumns = api.columns().header().length;
                    api.columns().every(function(index) {
                        if (index !== 0 && index !== totalColumns - 1) {
                            var that = this;
                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
