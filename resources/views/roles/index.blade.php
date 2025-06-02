@extends('app.app')

@section('title')
    Roles
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Modulo Roles
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
            <div class="box">
                <div class="box-header middle">
                    <h3 class="box-title">Lista de Roles</h3>
                    <a class="btn btn-success pull-right" data-bs-toggle="tooltip" data-container="body" title="" data-bs-original-title="Nuevo Rol" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i></a>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tbl_Paciente" class="table" style="width:100%;">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Id</th>
                                    <th>Rol</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $rol)
                                <tr>
                                    <td>{{$rol->id}}</td>
                                    <td>{{$rol->name}}</td>
                                    <td class="text-center">
                                        <div class="d-block text-dark flexbox">
                                            <button type="button" id="btn_read" value="{{ $rol->id }}" class="btn btn-info" data-bs-toggle="tooltip" data-container="body" data-bs-original-title="Ver Paciente"><i class="mdi mdi-eye"></i></button>
                                            <a class="btn btn-secondary" data-bs-toggle="tooltip" data-container="body" title="" data-bs-original-title="Editar Paciente" href="{{ route('roles.edit', $rol->id) }}"><i class="fa fa-edit"></i></a>
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
                    <button type="button" class="btn-close end-100" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="box">
                    <div class="ms-20 me-20 mt-10 mb-10">
                        <h3 class="fw-600 mb-5" id="name"></h3>
                        <hr>
                        <h5 class="mt-0 mb-20">Permisos asignados</h5>
                        <div id="permissionContainer"></div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '#btn_read', function(event){
                event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace
                var id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('roles.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        $('#name').text(response.role.name);
                        var permissionContainer = $('#permissionContainer');
                        permissionContainer.empty();
                        
                        $.each(response.filteredGroupedPermissions, function(group, permissions){
                            var groupLabel = $('<h5>').text(group.toUpperCase()).addClass('text-danger');
                            permissionContainer.append(groupLabel);
                            var rowDiv = $('<div>').addClass('row');
                            
                            $.each(permissions, function(index, permission){
                                var colDiv = $('<div>').addClass('col-xs-12 col-sm-4 col-md-3 col-lg-2 col-xl-2 col-xxl-2 col-xxxl-2 mb-2');
                                var permissionParts = permission.name.split('.');
                                var permissionText = permissionParts.length > 1 ? permissionParts[1] : permissionParts[0];
                                    
                                var p = $('<p>').addClass('fw-500').text(permissionText.charAt(0).toUpperCase() + permissionText.slice(1));
                                colDiv.append(p);
                                rowDiv.append(colDiv);
                            });
                            permissionContainer.append(rowDiv);
                        });
                        $('#modal-read').modal('show');
                    }
                });
            });

            $('#tbl_Paciente').DataTable({
                "order": [[0, 'asc']],
                "columnDefs": [
                    {
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