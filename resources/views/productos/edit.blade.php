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
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                <form action="{{ route('roles.update', $role->id) }}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="d-md-flex align-items-center justify-content-between">
                                <h4 class="box-title">Editar el Rol</h4>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="form-label">Nombre del Rol</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ isset($role) ? $role->name : old('name') }}" placeholder="Introduzca un Rol">
                                {!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
                            </div>
                            <h5 class="mt-0 mb-20">Permisos para este Rol</h5>
                            <hr>
                            @foreach ($permissions as $permission)
                                <?php
                                $parts = explode('.', $permission->name);
                                $group = $parts[0];
                                $name = str_replace($group . '.', '', $permission->name);
                                ?>
                                @if (!isset($currentGroup) || $currentGroup !== $group)
                                    @if (isset($currentGroup))
                        </div>
                    </div>
            </div> <!-- Cerrar el grupo anterior -->
            @endif
            <div class="form-group">
                <label class="form-label">{{ strtoupper($group) }}</label>
                <div class="c-inputs-stacked">
                    <div class="row">
                        @php $currentGroup = $group; @endphp
                        @endif
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 col-xl-2 col-xxl-2 col-xxxl-2 mb-2">
                            @if (in_array($permission->id, $rolePermissions))
                                <input type="checkbox" name="permission[]" id="{{ $permission->id }}"
                                    value="{{ $permission->name }}" class="filled-in chk-col-primary" checked>
                            @else
                                <input type="checkbox" name="permission[]" id="{{ $permission->id }}"
                                    value="{{ $permission->name }}" class="filled-in chk-col-primary">
                            @endif
                            <label for="{{ $permission->id }}">{{ ucfirst($name) }}</label>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Accion Terapeuticas</label>
                                    <select id="accion_terapeutica_id" name="accion_terapeutica_id" class="form-select">
                                        @foreach ($accionTerapeuticas as $accionTerapeuticas)
                                            @if ($producto->accion_terapeutica_id == $accionTerapeuticas->id)
                                                <option value="{{ $accionTerapeuticas->id }}" selected>
                                                    {{ $accionTerapeuticas->accion_terapeutica }}
                                                </option>
                                            @else
                                                <option value="{{ $accionTerapeuticas->id }}">
                                                    {{ $accionTerapeuticas->accion_terapeutica }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Presentacion</label>
                                    <select id="presentacion_id" name="presentacion_id" class="form-select">
                                        @foreach ($presentaciones as $presentacion)
                                            @if ($producto->presentacion_id == $presentacion->id)
                                                <option value="{{ $presentacion->id }}" selected>
                                                    {{ $presentacion->presentacion }}
                                                </option>
                                            @else
                                                <option value="{{ $presentacion->id }}">
                                                    {{ $presentacion->presentacion }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Unidad Medida</label>
                                    <select id="unidad_medida_id" name="unidad_medida_id" class="form-select">
                                        @foreach ($unidadMedidas as $unidadMedida)
                                            @if ($producto->unidad_medida_id == $unidadMedida->id)
                                                <option value="{{ $unidadMedida->id }}" selected>
                                                    {{ $unidadMedida->unidad_medida }}
                                                </option>
                                            @else
                                                <option value="{{ $unidadMedida->id }}">
                                                    {{ $unidadMedida->unidad_medida }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Stock Minimo </label>
                                    <input id="stock_minimo" type="text"
                                        value="{{ isset($producto) ? $producto->stock_minimo : old('stock_minimo', 1) }}"
                                        name="stock_minimo" data-bts-button-down-class="btn btn-secondary"
                                        data-bts-button-up-class="btn btn-secondary">
                                    {!! $errors->first('stock_minimo', '<small class="text-danger">:message</small>') !!}
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Precio Unitario</label>
                                    <input id="precio_unitario" type="text"
                                        value="{{ isset($producto) ? $producto->precio_unitario : old('precio_unitario', 0) }}"
                                        name="precio_unitario" data-bts-button-down-class="btn btn-secondary"
                                        data-bts-button-up-class="btn btn-secondary">
                                    {!! $errors->first('precio_unitario', '<small class="text-danger">:message</small>') !!}
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Porcentaje</label>
                                    <input id="porcentaje" type="text"
                                        value="{{ isset($producto) ? $producto->porcentaje : old('porcentaje', 0) }}"
                                        name="porcentaje" data-bts-button-down-class="btn btn-secondary"
                                        data-bts-button-up-class="btn btn-secondary">
                                    {!! $errors->first('porcentaje', '<small class="text-danger">:message</small>') !!}
                                </div>
                            </div>
                            {{-- <div class="col center">
                                    <div class="badge badge-info text-center">
                                        <label class="form-label">Porcentaje</label>
                                        <input id="porcentaje" type="text" value="{{ old('porcentaje', 0) }}"
                                            name="porcentaje" data-bts-button-down-class="btn btn-secondary"
                                            data-bts-button-up-class="btn btn-secondary">
                                        {!! $errors->first('porcentaje', '<small class="text-danger">:message</small>') !!}
                                    </div>
                                </div> --}}
                            <div class="col badge badge-info text-center">
                                <input type="hidden" id="precio_venta" name="precio_venta"
                                    value="{{ isset($producto) ? $producto->precio_venta : old('precio_venta') }}">
                                <div id="precio" class="fs-40">Bs. 0.00</div>
                            </div>
                        </div>

                        <div class="box-footer text-end">
                            <a href="{{ route('roles.index') }}" class="btn btn-warning me-1">
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
