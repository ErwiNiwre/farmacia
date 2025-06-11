@extends('app.app')

@section('title')
    Laboratorio
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Registro de Servicios de Laboratorio
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <form method="post" action="{{ route('laboratorioServicios.update', $laboratorioServicio->id) }}" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="box-title">Datos del Paciente</h3>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Servicio</label>
                                    <input type="text" id="servicio" name="servicio"
                                        value="{{ isset($laboratorioServicio) ? $laboratorioServicio->servicio : old('servicio') }}"
                                        class="form-control" placeholder="servicio">
                                    {{-- {!! $errors->first('nombre', '<small class="text-red">:message</small>') !!} --}}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Precio</label>
                                    <input type="number" step=".01" id="precio" name="precio"
                                        value="{{ isset($laboratorioServicio) ? $laboratorioServicio->precio : old('precio') }}"
                                        class="form-control" placeholder="Ap. Paterno">
                                    {{-- {!! $errors->first('aPaterno', '<small class="text-red">:message</small>') !!} --}}
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <label class="form-label">Clasificación</label>
                                    <select id="clasificacion_id" name="clasificacion_id" class="form-select">
                                        @foreach ($clasificaciones as $clasificacion)
                                            
                                            @if ($laboratorioServicio->clasificacion_id == $clasificacion->id)
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

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-file btn-primary pull-right float-right"
                            style="margin-right: 5px;"><i class="fa fa-save"></i> GUARDAR CAMBIOS</button>
                        <a type="button" class=" btn btn-danger  float-right" href="{{ route('laboratorioServicios.index') }}"
                            style="margin-right: 5px;"><i class="fa fa-times-circle"></i> CANCELAR</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection