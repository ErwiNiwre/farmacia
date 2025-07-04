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
                <form action="{{ route('productos.update', $producto->id) }}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="d-md-flex align-items-center justify-content-between">
                                <h4 class="box-title">Datos del Producto</h4>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Tipo Producto</label>
                                        <select id="tipo_producto" name="tipo_producto" class="form-select select2"
                                            style="width: 100%;">
                                            @if ($producto->tipo_producto == 'M')
                                                <option value="M" selected>Medicamentos</option>
                                            @else
                                                <option value="M">Medicamentos</option>
                                            @endif

                                            @if ($producto->tipo_producto == 'I')
                                                <option value="I" selected>Insumos</option>
                                            @else
                                                <option value="I">Insumos</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Codigo Barras</label>
                                        <input type="text" id="barras" name="barras" class="form-control"
                                            value="{{ isset($producto) ? $producto->barras : old('barras') }}"
                                            placeholder="Codigo Barras">
                                        {!! $errors->first('barras', '<small class="text-danger">:message</small>') !!}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="mb-3">Generar Codigo</label>
                                        <div class="c-inputs-stacked">
                                            <input type="checkbox" id="codigo_generado" name="codigo_generado"
                                                class="filled-in chk-col-info"
                                                value="{{ isset($producto) ? $producto->codigo_generado : old('codigo_generado') }}"
                                                {{ $producto->codigo_generado == 'S' ? 'checked' : '' }} />
                                            <label for="codigo_generado" class="me-30">
                                                <span id="label_codigo_generado">No</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Producto</label>
                                        <input type="text" id="producto" name="producto" class="form-control"
                                            value="{{ isset($producto) ? $producto->producto : old('producto') }}"
                                            placeholder="Producto">
                                        {!! $errors->first('producto', '<small class="text-danger">:message</small>') !!}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Nombre Generico</label>
                                        <input type="text" id="generico" name="generico" class="form-control"
                                            value="{{ isset($producto) ? $producto->generico : old('generico') }}"
                                            placeholder="Nombre Generico">
                                        {!! $errors->first('generico', '<small class="text-danger">:message</small>') !!}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Concentracion</label>
                                        <select id="concentracion_id" name="concentracion_id" class="form-select select2"
                                            style="width: 100%;">
                                            @foreach ($concentraciones as $concentracion)
                                                @if ($producto->concentracion_id == $concentracion->id)
                                                    <option value="{{ $concentracion->id }}" selected>
                                                        {{ $concentracion->concentracion }}
                                                    </option>
                                                @else
                                                    <option value="{{ $concentracion->id }}">
                                                        {{ $concentracion->concentracion }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Marca</label>
                                        <select id="marca_id" name="marca_id" class="form-select select2"
                                            style="width: 100%;">
                                            @foreach ($marcas as $marca)
                                                @if ($producto->marca_id == $marca->id)
                                                    <option value="{{ $marca->id }}" selected>
                                                        {{ $marca->marca }}
                                                    </option>
                                                @else
                                                    <option value="{{ $marca->id }}">
                                                        {{ $marca->marca }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Accion Terapeuticas</label>
                                        <select id="accion_terapeutica_id" name="accion_terapeutica_id"
                                            class="form-select select2" style="width: 100%;">
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
                                        <select id="presentacion_id" name="presentacion_id" class="form-select select2"
                                            style="width: 100%;">
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
                                        <select id="unidad_medida_id" name="unidad_medida_id" class="form-select select2"
                                            style="width: 100%;">
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

                        </div>
                        <div class="box-footer text-end">
                            <a href="{{ route('productos.index') }}" class="btn btn-warning me-1"><i
                                    class="ti-trash"></i>
                                Cancelar</a>
                            <button type="submit" class="btn btn-primary"><i class="ti-save-alt"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {

            $('.select2').select2();

            actualizarEstado();

            $('#codigo_generado').on('change', actualizarEstado);

            $("#stock_minimo").TouchSpin({
                min: 1,
                max: 1000
            });

            $("#precio_unitario").TouchSpin({
                min: 0,
                max: 1000000000,
                step: 0.01,
                decimals: 2,
                boostat: 1,
                stepinterval: 50,
                maxboostedstep: 10,
                prefix: 'BS.'
            });

            $("#porcentaje").TouchSpin({
                min: 0,
                max: 100,
                // step: 0.1,
                // decimals: 2,
                // boostat: 1,
                // maxboostedstep: 10,
                postfix: '%'
            });

            calcularPrecio();
            $("#precio_unitario, #porcentaje").change(function() {
                calcularPrecio();
            });

            function calcularPrecio() {
                let precio = parseFloat($("#precio_unitario").val());
                let porcentaje = parseFloat($("#porcentaje").val());

                if (isNaN(precio) || isNaN(porcentaje)) {
                    console.error("Por favor, ingrese valores numéricos válidos.");
                    return;
                }

                let aux = parseFloat((precio * (porcentaje / 100)).toFixed(2));
                let total = parseFloat((precio + aux).toFixed(2));

                $("#precio_venta").val(total);
                $('#precio').text('Bs. ' + total.toFixed(2));
                console.log("Precio:", precio, "Porcentaje:", porcentaje, "Aumento:", aux, "Total:", total);
            }

            function actualizarEstado() {
                if ($('#codigo_generado').is(':checked')) {
                    $('#barras').prop('readonly', true).val(@json($producto->barras));
                    $('#barras').addClass('has-success');
                    $('#codigo_generado').val(1);
                    $('#label_codigo_generado').text('Sí');
                } else {
                    $('#barras').prop('readonly', false).val(@json($producto->barras));
                    $('#barras').removeClass('has-success');
                    $('#codigo_generado').val(0);
                    $('#label_codigo_generado').text('No');
                }
            }
        });
    </script>
@endsection
