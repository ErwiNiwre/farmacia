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
                <div class="box-header middle">
                    <h3 class="box-title">Listado de Servicios de Laboratorio</h3>
                    @can('laboratorioServicio.create')
                        <a class="btn btn-success pull-right" href="{{ route('laboratorioServicios.create') }}">
                            <i class="fa fa-user-plus"></i> Nuevo</a>
                    @endcan
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

    <!-- Modal-Delete-Servicio -->
    <div class="modal center-modal fade" id="modal-delete-servicio" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog" style="max-width: 900px">
            <form id="deleteServicio" autocomplete="off">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete_servicio_id" name="delete_servicio_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminación de Servicio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div
                                class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-center badge badge-danger">
                                ¿Estás seguro de que deseas eliminar este Servicio?
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Servicio:</dt>
                                            <dd id="servicio_d"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Precio:</dt>
                                            <dd id="precio_d"></dd>
                                        </dl>
                                    </div>
                                    <div class="col">
                                        <dl class="dl-horizontal">
                                            <dt>Clasificación:</dt>
                                            <dd id="clasificacion_d"></dd>
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
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            const permisos = {
                edit: @json(auth()->user()->can('laboratorioServicio.edit')),
                destroy: @json(auth()->user()->can('laboratorioServicio.destroy')),
                show: @json(auth()->user()->can('laboratorioServicio.show'))
            };

            $('#dt_laboratorio_servicios tfoot th').each(function(index) {
                let totalColumns = $('#dt_laboratorio_servicios thead th').length;
                if (index !== 0 && index !== totalColumns - 1) {
                    var title = $(this).text();
                    $(this).html('<input type="text" placeholder="BUSCAR ' + title + '" />');
                } else {
                    $(this).html('');
                }
            });

            var tbl_Servicios = $('#dt_laboratorio_servicios').DataTable({
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
                        data: 'precio',
                        className: 'text-end'
                    },
                    {
                        data: 'clasificacion'
                    },
                    {
                        data: null,
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let botones = '<div class="text-dark flexbox">';

                            if (permisos.edit) {
                                botones += `
                                    <a class="btn btn-secondary" href="${row.edit_url}" data-bs-toggle="tooltip" title="Editar Servicio">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                `;
                            }

                            if (permisos.destroy) {
                                botones += `
                                    <button type="button" id="btn_delete" value="${row.id}" class="btn btn-danger" data-bs-toggle="tooltip" title="Eliminar Servicio">
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

            $(document).on('click', '#btn_delete', function() {
                event.preventDefault();
                var id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('laboratorioServicios.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        console.log(response);
                        if (response.status === 200) {
                            $('#delete_servicio_id').val(response.data.laboratorio_servicio.id);
                            $('#servicio_d').text(response.data.laboratorio_servicio.servicio
                                .toUpperCase());
                            $('#precio_d').text(response.data.laboratorio_servicio.precio);
                            $('#clasificacion_d').text(response.data.clasificacion
                                .clasificacion
                                .toUpperCase());
                            $("#modal-delete-servicio").modal('show');
                        }
                    }
                });
            });

            $('#deleteServicio').on('submit', function(event) {
                event.preventDefault(); // Evita el envío normal del formulario

                var servicioId = $('#delete_servicio_id').val();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('laboratorioServicios.destroy', ':id') }}".replace(':id',
                        servicioId),
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
                        alert('Ocurrió un error: ' + error);
                    }
                });
            });
        });
    </script>
@endsection
