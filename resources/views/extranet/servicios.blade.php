@extends('extranet.app.app')

@section('title')
    Servicios
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Modulo Servicios
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
                                    <tr>
                                        <th>ID</th>
                                        <th>SERVICIO</th>
                                        <th>CLASIFICACION</th>
                                        <th>PRECIO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laboratorio_servicios as $laboratorio_servicio)
                                        <tr>
                                            <td>{{ $laboratorio_servicio->id }}</td>
                                            <td>{{ $laboratorio_servicio->servicio }}</td>
                                            <td>{{ $laboratorio_servicio->clasificacion }}</td>
                                            <td>{{ $laboratorio_servicio->precio }}</td>
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
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            $('#tbl_ServiciosLaboratorio').DataTable({
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
