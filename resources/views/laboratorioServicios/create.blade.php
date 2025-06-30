@extends('app.app')

@section('title')
    Laboratorio
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Registro de Servicios de Laboratorio
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                <form action="{{ route('laboratorioServicios.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="d-md-flex align-items-center justify-content-between">
                                <h4 class="box-title">Datos del Servicios de Laboratorio</h4>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">

                                        <label class="form-label">Servicio</label>
                                        <input type="text" id="servicio" name="servicio" class="form-control"
                                            value="{{ old('servicio') }}" placeholder="Introduzca un Servicio">
                                        {!! $errors->first('servicio', '<small class="text-danger">:message</small>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                    <div class="form-group">

                                        <label class="form-label">Precio</label>
                                        <input type="number" step=".01" id="precio" name="precio" class="form-control"
                                            value="{{ old('precio') }}" placeholder="Introduzca el precio">
                                        {!! $errors->first('precio', '<small class="text-danger">:message</small>') !!}
                                    </div>
                                </div>
                                 <div class="col-xs-2 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Clasificacion</label>
                                    <select id="clasificacion_id" name="clasificacion_id" class="form-select select2">
                                        @foreach ($clasificacion as $clasificacion)
                                            @if (old('clasificacion_id') == $clasificacion->id)
                                                <option value="{{ $clasificacion->id }}" selected>
                                                    {{ $clasificacion->clasificacion }}</option>
                                            @else
                                                <option value="{{ $clasificacion->id }}">{{ $clasificacion->clasificacion }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            </div>
                           
                            {!! $errors->first('permission', '<small class="text-danger">:message</small>') !!}
                        </div>

                        <div class="box-footer text-end">
                            <a href="{{ route('laboratorioServicios.index') }}" class="btn btn-warning me-1">
                                <i class="ti-trash"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti-save-alt"></i> Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
