@extends('app.app')

@section('title')
    Laboratorio Servicios
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Servicios de Laboratorio
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-4">

                            <h3 class="box-title">Listado de Servicios de Laboratorio</h3>

                        </div>
                        <div class="col-4">

                        </div>
                        <div class="col-4">
                            @can('Paciente-Crear')
                                <a class="btn btn-success pull-right" href="{{ route('laboratorioServicios.create') }}">
                                    <i class="fa fa-user-plus"></i> Nuevo</a>
                            @endcan

                        </div>
                        <div class="col-6">
                        </div>
                    </div>
                </div>
                <div class="box-body">

                    <div class="table-responsive">
                        <table id="dt_laboratorio_servicios" class="table b-1 border-success" style="width: 100%;">
                            <thead class="bg-success">
                                <tr>
                                    <th>Id</th>
                                    <th>Servicio</th>
                                    <th>Precio</th>
                                    <th>Clasificacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Servicio</th>
                                    <th>Precio</th>
                                    <th>Clasificacion</th>
                                    <th style="visibility:collapse; display:none;"></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {

            var table_servicios = $('#dt_laboratorio_servicios').DataTable({
                "ajax": "{{ route('getListLaboratorioServicio') }}",
                //bFilter: true,
                //"bSort": false,

                // "order": [[0, 'desc']],
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": 'servicio'
                    },
                    {
                        "data": "precio"
                    },
                    {
                        "data": "clasificacion"
                    },
                    {
                        "data": "action",
                        orderable: false,
                        searchable: false
                    }
                ],
                "columnDefs": [{
                    "targets": 0,
                    "type": "num",
                    "visible": false
                }],
                pageLength: 10,
                lengthChange: false,
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;
                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                },
                "language": {
                    "url": "{{ asset('lang/datatable.es-ES.json') }}"
                },



            });

            $('#dt_laboratorio_servicios tfoot th').each(function() {
                var title = $(this).text();

                $(this).html('<input type="text" class="form-control shadow" placeholder="' + title +
                    '" />');
            });
            //   $('#dt_laboratorio_servicios tfoot th').each(function() {
            //         var title = $(this).text();

            //         $(this).html('<input type="text" class="form-control shadow" placeholder="'+title+'" />');
            //     });
            //       $('.dt_laboratorio_servicios thead th').each( function () {
            //     var title = $(this).text();
            //     $(this).html('<input type="text" placeholder="Search '+title+'" />' );
            // } );


                // table_servicios.columns().every( function () {
			    //     var that = this;
                //     console.log(that);
			 
			    //     $( 'input', this.footer() ).on( 'keyup change ', function () {
                //        // console.log(that.search());
			    //         if ( that.search() !== this.value ) {
			    //             that
			    //                 .search( this.value )
			    //                 .draw();
			    //         }
			    //     } );

     
			    // });



        });
    </script>
@endsection
