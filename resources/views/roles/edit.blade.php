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
                            <input type="text" id="name" name="name" class="form-control" value="{{ isset($role) ? $role->name : old('name') }}" placeholder="Introduzca un Rol">
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
                                    </div></div></div> <!-- Cerrar el grupo anterior -->
                                @endif
                                <div class="form-group">
                                    <label class="form-label">{{ strtoupper($group) }}</label>
                                    <div class="c-inputs-stacked">
                                        <div class="row">
                                            @php $currentGroup = $group; @endphp
                            @endif
                            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 col-xl-2 col-xxl-2 col-xxxl-2 mb-2">
                                @if (in_array($permission->id, $rolePermissions))
                                    <input type="checkbox" name="permission[]" id="{{ $permission->id }}" value="{{ $permission->name }}" class="filled-in chk-col-primary" checked>
                                @else
                                    <input type="checkbox" name="permission[]" id="{{ $permission->id }}" value="{{ $permission->name }}" class="filled-in chk-col-primary">
                                @endif
                                <label for="{{ $permission->id }}">{{ ucfirst($name) }}</label>
                            </div>
                        @endforeach
                        @if (isset($currentGroup))
                            </div></div></div> <!-- Cerrar el último grupo -->
                        @endif
                        {!! $errors->first('permission', '<small class="text-danger">:message</small>') !!}
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