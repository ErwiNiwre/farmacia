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
            <form action="{{route('clasificaciones.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="box">
                    <div class="box-header with-border">
                        <div class="d-md-flex align-items-center justify-content-between">
                            <h4 class="box-title">Datos del Servicios de Laboratorio</h4>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="form-label">Servicio</label>
                            <input type="text" id="clasificacion" name="clasificacion" class="form-control" value="{{ old('clasificacion') }}" placeholder="Introduzca un Servicio">
                            {!! $errors->first('clasificacion', '<small class="text-danger">:message</small>') !!}
                        </div>
                        
                        
                        
                        {!! $errors->first('permission', '<small class="text-danger">:message</small>') !!}
                    </div>

                    <div class="box-footer text-end">
                        <a href="{{ route('clasificaciones.index') }}" class="btn btn-warning me-1">
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