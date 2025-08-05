@extends('app.app')

@section('title')
    Ventas
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Ventas por Cobrar
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                <form id="updateventas" autocomplete="off" onkeydown="event.keyCode === 13">
                    @csrf
            @method('PUT')
                    <div class="box">
                        <div class="box-body">
                            <h5 class="box-title text-info mb-0"><i class="fa fa-id-card-o me-15"></i>Datos de la Venta</h5>
                            <hr class="my-15">
                            <div class="row">
                                {{-- <div class="col-xs-5 col-sm-5 col-md-6 col-lg-5 col-xl-5 col-xxl-5 col-xxxl-5">
                                    <div class="form-group">
                                        <dt>Cliente:</dt>
                                            <dd>{{ $ventas->cliente }}</dd>
                                        
                                           
                                    </div>
                                    
                                </div>
                                 <div class="col-xs-5 col-sm-5 col-md-6 col-lg-5 col-xl-5 col-xxl-5 col-xxxl-5">
                                    <div class="form-group">
                                        
                                        
                                            <dt>Tipo:</dt>
                                            <dd>{{ $ventas->tipo }}</dd>
                                            

                                    </div>
                                    
                                </div>
                                <div class="col-xs-5 col-sm-5 col-md-6 col-lg-5 col-xl-5 col-xxl-5 col-xxxl-5">
                                    <div class="form-group">
                                        
                                            <dt>Metodo de Pago:</dt>
                                            <dd>{{ $ventas->metodo_pago }}</dd>
                                         

                                    </div>
                                    
                                </div>
                                <div class="col-xs-5 col-sm-5 col-md-6 col-lg-5 col-xl-5 col-xxl-5 col-xxxl-5">
                                    <div class="form-group">
                                       
                                            <dt>Total:</dt>
                                            <dd id="total_venta">{{ $ventas->total }}</dd>

                                    </div>
                                    
                                </div> --}}
                                {{-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-xxxl-4 badge badge-info text-center">
                                <input type="hidden" id="amount" name="amount" class="form-control" value="{{ old('amount') }}">
                                <div id="price_display" class="fs-40">Bs. 0.00</div>
                                </div> --}}
                               
                                <div class="col-xs-5 col-sm-5 col-md-6 col-lg-5 col-xl-5 col-xxl-5 col-xxxl-5">
                                    <div class="form-group">
                                        <label class="form-label">Cliente</label>
                                        <input type="text" readonly id="cliente" name="cliente" class="form-control"
                                            value="{{ $ventas->cliente }}" placeholder="Cliente">

                                    </div>
                                </div>
                                <div class="col-xs-3col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3">

                                    <div class="form-group">
                                        <label class="form-label">Tipo</label>                               

                                         <select id="tipo" name="tipo" class="form-control select2">
                                        <option value="Venta" {{ $ventas->tipo == 'Venta' ? 'selected' : '' }}>Venta</option>
                                        <option value="Salida Directa" {{ $ventas->tipo == 'Salida Directa' ? 'selected' : '' }}>Salida Directa</option>
                                        <option value="Cuentas por Cobrar" {{ $ventas->tipo == 'Cuentas por Cobrar' ? 'selected' : '' }}>Cuentas por Cobrar</option>
                                    </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                 <div
                                    class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-xxxl-4 badge badge-info text-center">
                                    <input type="hidden" id="total" name="total" class="form-control"
                                        value="{{ old('total') }}">
                                    <div id="total_display" class="fs-40">Total Bs. {{ $ventas->total }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-xxxl-2">

                                    <div class="form-group">
                                        <label class="form-label">Metodo de Pago</label>
                                        <select id="metodo_pago" name="metodo_pago" class="form-control select2">
                                        <option value="E" {{ $ventas->metodo_pago == 'E' ? 'selected' : '' }}>Efectivo</option>
                                        <option value="Q" {{ $ventas->metodo_pago == 'QR' ? 'selected' : '' }}>QR</option>
                                        <option value="M" {{ $ventas->metodo_pago == 'Efectivo y QR' ? 'selected' : '' }}>Efectivo y QR</option>
                                        <option value="N" {{ $ventas->metodo_pago == 'N' ? 'selected' : '' }}>Ninguno</option>
                                    </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3">
                                    <div id="display_efectivo" class="form-group" style="display:none">
                                        <label class="form-label">Efectivo</label>


                                        <input id="efectivo" type="text" value="{{ old('efectivo', 0) }}"
                                            name="efectivo" data-bts-button-down-class="btn btn-secondary"
                                            data-bts-button-up-class="btn btn-secondary">
                                        {!! $errors->first('efectivo', '<small class="text-danger">:message</small>') !!}

                                    </div>
                                </div>


                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3">
                                    <div id="display_qr" style="display:none" class="form-group">
                                        <label class="form-label">QR</label>
                                        <input id="qr" type="text" value="{{ old('qr', 0) }}" name="qr"
                                            data-bts-button-down-class="btn btn-secondary"
                                            data-bts-button-up-class="btn btn-secondary">
                                        {!! $errors->first('qr', '<small class="text-danger">:message</small>') !!}


                                    </div>
                                </div>

                                <div
                                    class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-xxxl-4 badge badge-success text-center">

                                    <label class="fs-40">Cambio Bs. </label> <label id="cambio_display" class="fs-40">0.00
                                </div>

                                 <div >
                                    <input type="hidden" id="total" name="total" class="form-control"
                                         value="{{ isset($ventas) ? $ventas->total : old('total') }}">
                                    
                                </div>
                            </div>
                             <div class="row" id="observacion_section">

                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-xxxl-5">
                                    <div class="form-group">
                                        <label class="form-label">Observacion</label>
                                        <textarea readonly type="text" id="observacion" name="observacion" class="form-control" placeholder="Observacion">{{ isset($ventas) ? $ventas->observacion : old('observacion') }} </textarea>

                                    </div>
                                </div>

                              <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xxl-7 col-xxxl-7">
                            <div class="d-flex justify-content-between mt-15 pull-right">
                                <button type="button" id="btn_editar_venta" value="{{ $ventas->id }}" class="btn btn-secondary" data-bs-toggle="tooltip" data-container="body" title="" data-bs-original-title="Editar Venta"><i class="fa fa-edit"></i></button>
                            </div>
                            
                        </div>
                            </div>
                            

                               
                            </div>
                               
                            
                        </div>

                    </div>

            </div>

            <div class="box">
                <div class="box-body wizard-content">
                    <div class="middle">
                        <h5 class="box-title text-info mb-3"><i class="fa fa-file-text-o me-15"></i>Detalle de la Compra</h5>
                    </div>
                    <hr class="my-15">
                    <section>


                        <div class="row">
                            <div class="col-md-8">
                                
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                     <button type="button" id="btn_create_venta" class="btn btn-success pull-right" data-bs-toggle="tooltip" data-container="body" title="" data-bs-original-title="Nuevo Producto" ><i class="fa fa-plus"></i></button>
                    
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="row mb-3">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                            <div class="table-responsive">
                                <table id="venta_details_table" class="table" style="width: 100%;">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Producto</th>
                                            {{-- <th class="text-center">Stock<br>Registrado</th> --}}
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Precio/Unidad(BS)</th>

                                            <th class="text-center">SubTotal(BS)</th>

                                            <th class="text-center">Baja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot class="text-end">
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th>
                                                <div id="price_table">Bs. 0.00</div>
                                            </th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="box-footer text-end">
                <a href="{{ route('ventas.index') }}" class="btn btn-warning me-1"><i class="ti-trash"></i> Cancelar</a>
                <button type="submit" id="btn_save" class="btn btn-primary"><i class="ti-save-alt"></i>
                    Confirmar Pago</button>
            </div>
            </form>
        </div>
        </div>
    </section>
    
    <!-- Modal-Edit-compra -->
<div class="modal center-modal fade" id="modal-edit-venta" data-bs-backdrop="static" tabindex="-1" >
    
    <div class="modal-dialog" style="max-width: 900px">
        
        <form id="update_ventas">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" id="compra_id" name="purchase_id"> --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar la Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">&times;</span></button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-end">
                            <div id="purchase_date"></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                            <div class="form-group">
                                <label class="form-label">Cliente</label>
                                <input type="text"  value="{{ $ventas->cliente }}" id="cliente_update" name="cliente_update" class="form-control" placeholder="cliente_update">
                            </div>
                        </div>
                      

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                    <div class="form-group">
                                        <label class="form-label">Observacion</label>
                                        <textarea  type="text" id="observacion_update" name="observacion_update" class="form-control" placeholder="observacion_update">{{ isset($ventas) ? $ventas->observacion : old('observacion') }} </textarea>

                                    </div>
                                </div>
                                 <input type="hidden" id="estado_update" name="estado_update" class="form-control"
                                        value="1">


                           
                        
                    </div>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="update_compas_btn" class="btn btn-primary float-end">Guardar</button>
                  </div>
            </div>
        </form>
    </div>
</div>
    <!-- Modal-create-detalle -->
<div class="modal center-modal fade" id="modal-create-venta-detail" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    
    <div class="modal-dialog" style="max-width: 900px">
        <form id="create_detalle" autocomplete="off">
            @csrf
            @method('PUT')
            <input type="hidden" id="create_venta_id" name="create_venta_id">
            <input type="hidden" id="create_subtotal" name="create_subtotal">
            
            {{-- <input type="hidden" id="create_estado" name="create_estado"> --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-end">
                            <div id="edit_purchase_amount"></div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6">
                            <div class="form-group">
                                <label class="form-label">Producto</label>
                                <select id="create_producto_id"  name="create_producto_id" class="form-control select2">
                                            @foreach ($producto as $productos)
                                                @if (old('producto_id') == $productos->id)
                                                    <option value="{{ $productos->id }}" selected>
                                                        {{ $productos->descripcion }}</option>
                                                @else
                                                    <option value="{{ $productos->id }}">
                                                        {{ $productos->descripcion }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6">
                            <div class="form-group">
                                <label class="form-label">Stock</label>
                                <input type="number" readonly="readonly" id="create_stock" class="form-control" name="create_stock" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                            <div class="form-group">
                                <label class="form-label">Precio Unitario</label>
                                <input type="text" id="create_precio_unitario" name="create_precio_unitario" min="0" pattern="\d+(\.\d{1,2})?" inputmode="decimal" class="form-control" placeholder="Precio Unitario">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                            <div class="form-group">
                                <label class="form-label">Cantidad</label>
                                <input type="number" id="create_cantidad" name="create_cantidad" min="1" class="form-control" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                            <div class="form-group">
                                <label class="form-label">SubTotal</label>
                                <input type="text" id="create_subtotal_label" name="create_subtotal_label" class="form-control" placeholder="Sub Total" readonly >
                            </div>
                        </div>
                    </div>
                     
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="create_venta_detalle_btn" class="btn btn-primary float-end">Guardar</button>
                  </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal-Edit-detalle -->
<div class="modal center-modal fade" id="modal-edit-compra-detail" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog" style="max-width: 900px">
        <form id="edit_detalle" autocomplete="off">
            @csrf
            @method('PUT')
           <input type="hidden" id="edit_venta_id" name="edit_venta_id">
            <input type="hidden" id="edit_subtotal" name="edit_subtotal">
            <input type="hidden" id="edit_cantidad_anterior" >
            <input type="hidden" id="edit_stock_anterior" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar la Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-end">
                            <div id="edit_purchase_amount"></div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6">
                            <div class="form-group">
                                <label class="form-label">Producto</label>
                                <input id="edit_producto_label" type="text"  class="form-control" name="edit_producto_label" readonly>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6">
                            <div class="form-group">
                                <label class="form-label">Stock</label>
                                <input id="edit_stock" type="number" readonly="readonly" id="stock" class="form-control" name="edit_stock" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                            <div class="form-group">
                                <label class="form-label">Precio Unitario</label>
                                <input type="text" id="edit_precio_unitario" name="edit_precio_unitario" min="0" step="0.1" class="form-control" placeholder="Precio Unitario">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                            <div class="form-group">
                                <label class="form-label">Cantidad</label>
                                <input type="number" id="edit_cantidad" name="edit_cantidad" min="1" class="form-control" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                            <div class="form-group">
                                <label class="form-label">SubTotal</label>
                                <input type="text" id="edit_subtotal_label" name="edit_subtotal_label" class="form-control" placeholder="Sub Total" readonly >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="edit_venta_detalle_btn" class="btn btn-primary float-end">Guardar</button>
                  </div>
            </div>
        </form>
    </div>
</div>

<!-- modal eliminar -->              
  <div class="modal fade" id="modal-eliminar"  data-bs-backdrop="static">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Eliminar</h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			<p>Realmente desea eliminar el Producto</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
			<button type="button" id="btn_eliminar" class="btn btn-primary float-end">Eliminar</button>
		  </div>
		</div>
		<!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
  </div>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            const ventaDetalles = @json($ventaDetalles);
           // console.log(ventaDetalles);
            const productosList = @json($producto);
            // console.log(ventaDetalles);
            $("#efectivo, #qr").TouchSpin({
                min: 0,
                max: 1000000000,
                step: 0.01,
                decimals: 2,
                boostat: 1,
                stepinterval: 50,
                maxboostedstep: 10,
                prefix: 'BS.'
            });
                $('#modal-create-venta-detail').on('shown.bs.modal', function () {
    $('#create_producto_id').select2({
        dropdownParent: $('#modal-create-venta-detail'), 
        width: '100%', 
    });
});
            toggleSaveButton();
          function autoResizeTextarea($el) {
            $el.css('height', 'auto'); // Reinicia altura
            $el.css('height', $el[0].scrollHeight + 'px'); // Ajusta a contenido
        }
         const $textarea = $('#observacion, #observacion_update');
           if ($textarea.length) {
            autoResizeTextarea($textarea); // Al cargar

            $textarea.on('input', function () {
                autoResizeTextarea($(this)); // Al escribir
            });
        }
            function busquedaProductosList(indice,atributo){
                 result_producto="";   
                 ventaDetalles.forEach(function(result) {
                //alert($( "#barras" ).val()+ "=="+ e.id);
               
                //alert(indice +"=="+ result[atributo]);
                if (indice == result[atributo])
                   result_producto=result;
                    
                    // console.(result.id);
                    });

                 //console.log(result_producto);
                    return result_producto;   

            }

            function busquedaProductos(indice,atributo){
                 result_producto="";   
                 productosList.forEach(function(result) {
                //alert($( "#barras" ).val()+ "=="+ e.id);
               
                //alert(indice +"=="+ result[atributo]);
                if (indice == result[atributo])
                   result_producto=result;
                    
                    // console.(result.id);
                    });

                 //console.log(result_producto);
                    return result_producto;   

            }


            $('#createventas').keydown(function(event) {
                if (event.keyCode == 13 && !event.target.matches("textarea")) {

                    event.preventDefault();
                    return false;
                }
            });
             $('#cliente').on('input', toggleSaveButton);
            //$('#efectivo, #qr').on('input', (calculoCambio));
            $('#observacion').on('input', toggleSaveButton);
            $('#efectivo, #qr').on('input', (toggleSaveButton));
             $(document).on('click', '#btn_create_venta', function(){
                var productos=busquedaProductos($('#create_producto_id').val(),'id');
                
                 if(productos.cantidad>0){
                 $("#create_venta_id").val({{ $ventas->id }});
                  $("#create_stock").val(productos.cantidad);
                  $("#create_precio_unitario").val(productos.precio_venta);
                  $("#create_cantidad").val(1);
                 $("#create_subtotal_label").val(productos.precio_venta);
                 $("#create_subtotal").val(productos.precio_venta);
                 validateCreateDetail();
                   // console.log(productos);
                 }else{
                   
                    $("#create_venta_id").val('');
                  $("#create_stock").val('');
                  $("#create_precio_unitario").val('');
                  $("#create_cantidad").val('');
                 $("#create_subtotal_label").val('');
                 $("#create_subtotal").val('');
                    validateCreateDetail();
                 }
                validateCreateDetail();
                $("#modal-create-venta-detail").modal('show');
                //togglecreatePurchaseDetailButton();
                //validateCreateDetail();
                //calculateTotal();
            });


            $(document).on('click', '#btn_edit_compras_detail', function(){
                // $("#create_product").empty();
                // $("#create_unit_price").val(0);
                // $("#create_quantity").val(1);
                // $("#create_subtotal").val('0.00');
                //alert(this.value);
               
                 var productos=busquedaProductosList(this.value,'id');
                 // console.log(productos);
                  
                  $("#edit_venta_id").val(this.value);
                  $("#edit_stock").val(productos.stock);
                  $("#edit_precio_unitario").val(productos.precio_unitario);
                  $("#edit_cantidad").val(productos.cantidad);
                  $("#edit_subtotal_label").val(productos.subtotal);
                  $("#edit_subtotal").val(productos.subtotal);                  
                  $("#edit_producto_label").val(productos.descripcion); 
                  $('#edit_cantidad_anterior').val(productos.cantidad);   
                  $('#edit_stock_anterior').val(productos.stock);               
                  $("#modal-edit-compra-detail").modal('show');
                //togglecreatePurchaseDetailButton();
                //validateCreateDetail();
                
            });

              $(document).on('click', '#btn_editar_venta', function(){
              //  alert("");
               // event.preventDefault();
                var id = $(this).val();
                 $("#modal-edit-venta").modal('show');
                
            });


            $('#edit_precio_unitario, #edit_cantidad').on('input', function () {
                //alert($("#edit_cantidad").val());
                let precio_unidad = $("#edit_precio_unitario").val();
                let create_cantidad= $("#edit_cantidad").val();
                let subtotal = (precio_unidad * create_cantidad).toFixed(2);
                $("#edit_subtotal_label").val(subtotal);
                //$("#edit_venta_id").val({{ $ventas->id }});
                $("#edit_subtotal").val(subtotal);
                

                validateEditDetail();
                calculateTotal();
                //togglecreatePurchaseDetailButton();
                //calculateTotalcreate();
            });
$('#create_precio_unitario').on('input', function () {
    let valor = $(this).val().replace(',', '.');

    // Permite solo números y un punto decimal
    valor = valor.replace(/[^0-9.]/g, '');

    // Eliminar puntos adicionales si hay más de uno
    const partes = valor.split('.');
    if (partes.length > 2) {
        valor = partes[0] + '.' + partes[1];
    }

    // Limitar a 2 decimales
    if (partes.length === 2 && partes[1].length > 2) {
        valor = partes[0] + '.' + partes[1].substring(0, 2);
    }

    // Actualizar el input con el valor limpio
    $(this).val(valor);

    // Obtener los valores limpios como números
    const precio_unidad_create = parseFloat(valor);
    const cantidad_create = parseFloat($("#create_cantidad").val().replace(',', '.')) || 0;
    const stock = parseFloat($('#create_stock').val()) || 0;

    // Validar cantidad vs stock
    if (cantidad_create > stock) {
        alert("La cantidad supera las existencias");
        $('#create_cantidad').val(stock);
    }

    // Calcular subtotal solo si el precio es válido
    let subtotal_create = 0;
    if (!isNaN(precio_unidad_create)) {
        subtotal_create = (precio_unidad_create * cantidad_create).toFixed(2);
    }

    // Asignar valores
    $("#create_subtotal_label").val(subtotal_create);
    $("#create_subtotal").val(subtotal_create);

    // Validaciones adicionales
    validateCreateDetail();
    calculateTotal();
});
             $('#create_cantidad').on('input', function () {
                //alert($("#edit_cantidad").val());
                let precio_unidad_create = $("#create_precio_unitario").val();
                let cantidad_create= $("#create_cantidad").val();
                let subtotal_create = (precio_unidad_create * cantidad_create).toFixed(2);
                $("#create_subtotal_label").val(subtotal_create);
                //$("#edit_venta_id").val({{ $ventas->id }});
                $("#create_subtotal").val(subtotal_create);
               
                if(parseFloat(cantidad_create)>$('#create_stock').val()){
                    alert("La cantidad superan las existencias");
                    $('#create_cantidad').val($('#create_stock').val());
                }

                // validateEditDetail();
                validateCreateDetail();
                calculateTotal();
                //togglecreatePurchaseDetailButton();
                //calculateTotalcreate();
            });

            const table = $('#venta_details_table').DataTable({
                "order": [[0, 'desc']],
                "columns": [
                   {
                         "data": "id"
                    },
                    {
                        "data": 'fecha'
                    },
                    {
                        "data": 'descripcion'
                    },
                    // {
                    //     "data": "stock"
                    // },
                    {
                        "data": "cantidad"
                    },
                    {
                        "data": "precio_unitario"
                    },
                    {
                        "data": "subtotal"
                    },
                    
                    	{ "mData": null , 
                     "mRender": function(data, type, row) {
						      	var button = '<div class="d-block text-dark flexbox">';
                               
                                       button+='<button type="button" id="btn_delete_venta_detail" value='+data.id+' class="waves-effect waves-light btn btn-danger mb-5" data-container="body" title="" data-bs-original-title="Eliminar"><i class="fa fa-bitbucket" aria-hidden="true"></i></button>';
                                       
						         button+='</div>'; 
                                       return button;
						    }}
                               

                ],
               "data":ventaDetalles,
                "columnDefs": [{
                    "targets": 0,
                    "type": "num",
                    "visible": false
                }],
                
                pageLength: 5,
                lengthChange: false,
                "language": {
                    "url": "{{ asset('lang/datatable.es-ES.json') }}"
                }
            });

             $('#create_producto_id').change(function() {
                //let id = $(this).val();
                 var productos=busquedaProductos(this.value,'id');
                
                 if(productos.cantidad>0){
                 $("#create_venta_id").val({{ $ventas->id }});
                  $("#create_stock").val(productos.cantidad);
                  $("#create_precio_unitario").val(productos.precio_venta);
                  $("#create_cantidad").val(1);
                 $("#create_subtotal_label").val(productos.precio_venta);
                 $("#create_subtotal").val(productos.precio_venta);
                 validateCreateDetail();
                   // console.log(productos);
                 }else{
                    alert("No hay sufucientes existencias del producto ");
                    $("#create_venta_id").val('');
                  $("#create_stock").val('');
                  $("#create_precio_unitario").val('');
                  $("#create_cantidad").val('');
                 $("#create_subtotal_label").val('');
                 $("#create_subtotal").val('');
                    validateCreateDetail();
                 }
             })
            

               calculateTotal();

             function calculateTotal() {
                let total = 0;
                let stock = 0;

                $('#venta_details_table').DataTable().rows().nodes().each(function(row, index) {

                    const $subtotalCell = $(row).find('td:eq(4)').text();
                    const $stock = $(row).find('td:eq(1)').text();
                    //console.log($subtotalCell);

                    total += parseFloat($subtotalCell);
                    stock -= parseFloat(stock) - $(row).find('input[name="unidad_precios[]"]').val();

                });

                total = isNaN(total) ? 0 : parseFloat(total).toFixed(2);
                $('#total_display').text('Total Bs. ' + total);
                $('#price_table').text('Bs. ' + total);
                $('#total').val(total);
                $('#total_venta').text('Bs. ' + total);
                //alert(total);

            }
             function calculoCambio() {
                let total = parseFloat($('#total').val());
                let qr = parseFloat($('#qr').val());
                let efectivo = parseFloat($('#efectivo').val());
                qr = isNaN(qr) ? 0 : qr;
                efectivo = isNaN(efectivo) ? 0 : efectivo;
                total = isNaN(total) ? 0 : total;
                let cambio = efectivo - total + qr;

                $('#cambio_display').text(cambio.toFixed(2));

            }
             $('#update_ventas').on('submit', function(event) {
                event.preventDefault(); // Evita el envío normal del formulario

                //var id = $('#compra_id').val();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('ventas.update', ':id') }}".replace(':id', '{{ $ventas->id }}'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if(response.status === 200) {
                            location.reload(); // Recargar o actualizar la vista según sea necesario
                        } else {
                            alert('Ocurrió un error al guardar los cambios.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Ocurrió un error: ' + error);
                    }
                });
            });

             $('#edit_detalle').on('submit', function(event) {
                event.preventDefault(); 
                
                
                var venta_detalle_id=  $("#edit_venta_id").val();
                var formCreate = $(this).serialize();
                // console.log(formCreate);
                $.ajax({                
                    url: "{{ route('ventaDetalle.update', ':id') }}".replace(':id', venta_detalle_id),
                    type: 'POST',
                    data: formCreate,
                   // _token: "{{ csrf_token() }}",
                    success: function(response) {
                        if(response.status === 200) {
                            location.reload();
                        } else {
                            alert('Ocurrió un error al guardar los cambios.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Ocurrió un error: ' + error);
                    }
                });
            });


               $('#updateventas').on('submit', function(event) {
                event.preventDefault(); 
                
                var venta_detalle_id=  $("#edit_venta_id").val();
                var formCreate = $(this).serialize();
                // console.log(formCreate);
                $.ajax({                
                    url: "{{ route('ventas.update', ':id') }}".replace(':id', {{ $ventas->id }}),
                    type: 'POST',
                    data: formCreate,
                   // _token: "{{ csrf_token() }}",
                    success: function(response) {
                        if(response.status === 200) {
                             window.location.href = "{{ route('ventas.index') }}";
                        } else {
                            alert('Ocurrió un error al guardar los cambios.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Ocurrió un error: ' + error);
                    }
                });
            });



             $('#create_detalle').on('submit', function(event) {
                event.preventDefault(); 
                
                var formCreate = $(this).serialize();
                 console.log(formCreate);
                $.ajax({                
                    url: "{{ route('ventaDetalle.store') }}",
                    type: 'POST',
                    data: formCreate,
                   // _token: "{{ csrf_token() }}",
                    success: function(response) {
                        if(response.status === 200) {
                            $('#create_venta_detalle_btn').prop('disabled',true);
                            location.reload();
                        } else {
                            alert('Ocurrió un error al guardar los cambios.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Ocurrió un error: ' + error);
                    }
                });
            });
             $(document).on('click', '#btn_delete_venta_detail', function(){
                event.preventDefault();
                var id = $(this).val();
                              $('#btn_eliminar').val(id)
                            $("#modal-eliminar").modal('show');
                            //toggleeditPurchaseDetailButton();
                       
                    
                
            });
             $(document).on('click', '#btn_eliminar', function(){
                event.preventDefault();
                var id = $(this).val();
                $('#modal-eliminar').modal('hide')
                    

                      $.ajax({
                    type: "GET",
                    url: "{{ route('ventaDetalle.destroy', ':id') }}".replace(':id', id),
                    success: function(response) {
                        if(response.status === 200){
                       //table.ajax.reload(null, false);
                    // alert("");
                        location.reload();
                      }else {
                            alert('Ocurrió un error al guardar los cambios.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Ocurrió un error: ' + error);
                    }
                
            });

            
          

            });
              $('#metodo_pago').change(function() {
                var valor = $(this).val();

                $('#display_efectivo, #display_qr').hide();

                // Muestra según selección
                if (valor === 'E') {
                    $('#display_efectivo').show();
                    $('#qr').val(0);
                    calculoCambio();
                } else if (valor === 'Q') {
                    $('#display_qr').show();
                    $('#efectivo').val(0);
                    calculoCambio();
                } else if (valor === 'M') {
                    $('#display_efectivo, #display_qr').show();
                    $('#qr').val(0);
                    calculoCambio();
                } else if (valor === 'N') {
                    $('#display_efectivo, #display_qr').hide();
                    $('#efectivo,#qr').val(0);
                    calculoCambio();
                }
            });

             $('#tipo').change(function() {
                var valor = $(this).val();

                $('#display_efectivo, #display_qr').hide();

                // Muestra según selección
                if (valor === 'Salida Directa') {
                    toggleSaveButton();
                    calculoCambio();
                }
            });
        function toggleSaveButton() {

            const clienteValue = $('#cliente').val().trim();
            const EfectivoValue = parseFloat($('#efectivo').val());
            const QrValue = parseFloat($('#qr').val());
            const cambio = parseFloat($('#cambio_display').text());
            const observacionValue = $('#observacion').val().trim();
            const totalValue=$('#total').val()>0;
            //const tipoValue=$('#tipo').val()!='Cuentas por Cobrar';
            const metodoPagoValue=$('#metodo_pago').val()!='N';
           
            //alert($('#total').val());
            const clienteFilled = clienteValue.length > 0;
            const EfectivoFilled = (EfectivoValue + QrValue) > 0;
            const CambioFilled = cambio >= 0;
            const ObservacionFilled = observacionValue.length > 0;

            let allProductsFilled = true;
            $('#venta_details_table tbody tr').each(function() {
                 allProductsFilled = true; 

    const cellText = $(this).find('td:eq(2)').text().trim();

    if (cellText === '') {
        allProductsFilled = false;
        return false; 
    }

                

            });
             //alert(allProductsFilled);
            let saveButtonEnabled;
            if ($('#tipo').val() == 'Venta')
                saveButtonEnabled = clienteFilled && EfectivoFilled && allProductsFilled && CambioFilled && totalValue && metodoPagoValue;
            else if($('#tipo').val() == 'Salida Directa')
                saveButtonEnabled = allProductsFilled && clienteFilled && ObservacionFilled ;
            else if($('#tipo').val() == 'Cuentas por Cobrar')
                saveButtonEnabled = false;
            $('#btn_save').prop('disabled', !saveButtonEnabled);
        }

         $('#cliente').on('input', toggleSaveButton);
            $('#efectivo, #qr').on('input', (calculoCambio));
            $('#observacion').on('input', toggleSaveButton);
            $('#efectivo, #qr').on('input', (toggleSaveButton));

         function validateEditDetail() {
            const edit_precio_unitario_value = $('#edit_precio_unitario').val();
            const edit_cantidad_value = $('#edit_cantidad').val();
            
            const edit_precio_unitario_filled = edit_precio_unitario_value > 0;
             let edit_cantidad_filled = edit_cantidad_value > 0;
             const edit_stock=$('#edit_stock').val();
             let anterior_cantidad=$('#edit_cantidad_anterior').val();
             let anterior_stock=$('#edit_stock_anterior').val();
             //alert(anterior_cantidad);
            // alert(parseFloat(edit_cantidad_value)+'<'+anterior_cantidad);
            // alert(parseFloat(anterior_cantidad)+parseFloat(edit_stock)+'<='+edit_cantidad_value);
            /* if(parseFloat(edit_cantidad_value)<anterior_cantidad){
           //alert("la cantidad excede");
               // $('#edit_cantidad').val(edit_stock+parseFloat(anterior_cantidad));    
               // $('#edit_subtotal_label').val(edit_stock*edit_precio_unitario_value); 
        } 
        else */
       // alert(parseFloat(anterior_cantidad)+'+'+parseFloat(edit_stock)+'-'+parseFloat(edit_cantidad_value));
        $('#edit_stock').val(parseFloat(anterior_cantidad)+parseFloat(anterior_stock)-parseFloat(edit_cantidad_value));
        if(parseFloat(anterior_cantidad)+parseFloat(anterior_stock)<edit_cantidad_value)
        {
                //edit_cantidad_filled=false;
                alert("la cantidad excede las existencias");
                $('#edit_stock').val(0); 
                $('#edit_cantidad').val(parseFloat(anterior_cantidad)+parseFloat(anterior_stock));    
                $('#edit_subtotal_label').val(edit_stock*edit_precio_unitario_value); 
            }
            //alert(create_cantidad_value);
            const saveButtonEnabled = edit_precio_unitario_filled&&edit_cantidad_filled;
            $('#edit_venta_detalle_btn').prop('disabled', !saveButtonEnabled);
        }

        function validateCreateDetail() {
            const create_precio_unitario_value = $('#create_precio_unitario').val();
            const create_cantidad_value = $('#create_cantidad').val();
            
            const create_precio_unitario_filled = create_precio_unitario_value > 0;
            let create_cantidad_filled = create_cantidad_value > 0;
            const create_stock=$('#edit_stock').val();          
           
            const saveButtonEnabled = create_precio_unitario_filled&&create_cantidad_filled;
            $('#create_venta_detalle_btn').prop('disabled', !saveButtonEnabled);
        }

            });
            
    </script>
@endsection
