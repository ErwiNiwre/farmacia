@extends('app.app')

@section('title')
    Laboratorio
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Registro de Compras
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                <form id="createcompras" autocomplete="off">
                    <div class="box">
                        <div class="box-body">
                            <h5 class="box-title text-info mb-0"><i class="fa fa-id-card-o me-15"></i>Datos de la Compra</h5>
                            <hr class="my-15">
                            <div class="row">

                                 <div class="row mb-2">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-9 col-xxl-9 col-xxxl-9">
                            <dl class="dl-horizontal">
                                <dt>Proveedor:</dt>
                                <dd>{{ $compras->proveedor }}</dd>
                               
                                <dt>Tipo:</dt>
                                <dd>{{ $compras->tipo }}</dd>
                            </dl>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-xxxl-3">
                            <div class="d-flex justify-content-between mt-15 pull-right">
                                <button type="button" id="btn_edit_compra" value="{{ $compras->id }}" class="btn btn-secondary" data-bs-toggle="tooltip" data-container="body" title="" data-bs-original-title="Editar Compra"><i class="fa fa-edit"></i></button>
                            </div>
                            
                        </div>
                    </div>
                            
                                

                               
                                 <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                                    <div class="form-group">
                                        
                                        <input type="hidden" id="total" name="total" value ="1"  class="form-control"
                                            value="{{ isset($compras) ? $compras->total : old('total') }}">
                                           
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                    <div class="box">
                        <div class="box-body wizard-content">
                            <div class="middle">
                                <h5 class="box-title text-info mb-3"><i class="fa fa-file-text-o me-15"></i>Detalle de la
                                    Compra</h5>
                            </div>
                            <hr class="my-15">
                            <section>
						
						
						<div class="row">
							
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-xxxl-8">
                        </div>
                            <div class="col-md-4">
								<div class="form-group">
									
                       
                        <button type="button" id="btn_create_compras" class="btn btn-success pull-right" data-bs-toggle="tooltip" data-container="body" title="" data-bs-original-title="Nuevo Producto" ><i class="fa fa-plus"></i></button>
                    
								</div>
							</div>
						</div>
					</section>
                            <div class="row mb-3">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                                    <div class="table-responsive">
                                        <table id="compras_details_table" class="table" style="width: 100%;">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th class="text-center">Id</th>
                                                    <th class="text-center">Producto</th>
                                                    <th class="text-center">Vencimiento</th>
                                                    <th class="text-center">Precio/Unidad(BS)</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">SubTotal(BS)</th>
                                                    
                                                    <th class="text-center">Baja</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot class="text-end">
                                                <tr>
                                                    <th colspan="4">Total</th>
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
                     
                </form>
            </div>
        </div>
    </section>
      
    <!-- Modal-Edit-compra -->
<div class="modal center-modal fade" id="modal-edit-compras" data-bs-backdrop="static" tabindex="-1" >
    
    <div class="modal-dialog" style="max-width: 900px">
        
        <form id="update_compras">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" id="compra_id" name="purchase_id"> --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar la Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="white-text">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 text-end">
                            <div id="purchase_date"></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                            <div class="form-group">
                                <label class="form-label">Proveedor</label>
                                <input type="text" id="proveedor" name="proveedor" class="form-control" placeholder="Proveedor">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                            <div class="form-group">
                                        <label class="form-label">Tipo</label>
                                        <select id="tipo" name="tipo" class="form-control" style="width: 100%;">
                                            <option>Compra</option>
                                            <option>Ingreso Directo</option>
                                        </select>
                                    </div>
                        </div>
                        
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
<div class="modal center-modal fade" id="modal-create-compra-detail" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    
    <div class="modal-dialog" style="max-width: 900px">
        <form id="create_detalle" autocomplete="off">
            @csrf
            @method('PUT')
            <input type="hidden" id="create_compra_id" name="create_compra_id">
            <input type="hidden" id="create_subtotal" name="create_subtotal">
            
            <input type="hidden" id="create_estado" name="create_estado">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar la Compra</h5>
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
                                <select id="create_producto_id"  name="create_producto_id" class="form-select">
                                            @foreach ($producto as $productos)
                                                @if (old('producto_id') == $productos->id)
                                                    <option value="{{ $productos->id }}" selected>
                                                        {{ $productos->productos }}</option>
                                                @else
                                                    <option value="{{ $productos->id }}">
                                                        {{ $productos->producto }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6">
                            <div class="form-group">
                                <label class="form-label">Vencimiento</label>
                                <input type="date" id="create_vencimiento" class="form-control" name="edit_vencimiento" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                            <div class="form-group">
                                <label class="form-label">Precio Unitario</label>
                                <input type="number" id="create_precio_unitario" name="edit_precio_unitario" min="0" step="any" class="form-control" placeholder="Precio Unitario">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                            <div class="form-group">
                                <label class="form-label">Cantidad</label>
                                <input type="number" id="create_cantidad" name="edit_cantidad" min="1" class="form-control" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4">
                            <div class="form-group">
                                <label class="form-label">SubTotal</label>
                                <input type="text" id="create_subtotal_label" name="edit_subtotal_label" class="form-control" placeholder="Sub Total" readonly >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="create_compra_detalle_btn" class="btn btn-primary float-end">Guardar</button>
                  </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal-Edit-detalle -->
<div class="modal center-modal fade" id="modal-edit-compra-detail" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog" style="max-width: 900px">
        <form id="updatePurchaseDetail" autocomplete="off">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_purchaseDetail_id" name="edit_purchaseDetail_id">
            <input type="hidden" id="edit_subtotal" name="edit_subtotal">
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
                                <select id="edit_producto_id"  name="producto_id" >
                                            @foreach ($producto as $productos)
                                                @if (old('producto_id') == $productos->id)
                                                    <option value="{{ $productos->id }}" selected>
                                                        {{ $productos->productos }}</option>
                                                @else
                                                    <option value="{{ $productos->id }}">
                                                        {{ $productos->producto }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6">
                            <div class="form-group">
                                <label class="form-label">Vencimiento</label>
                                <input type="date" id="edit_vencimiento" class="form-control" name="edit_vencimiento" >
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
                    <button type="submit" id="edit_purchaseDetail_btn" class="btn btn-primary float-end">Guardar</button>
                  </div>
            </div>
        </form>
    </div>
</div>
<!-- modal Area -->              
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
  <!-- /.modal -->
@endsection

@section('page-script')
    <script>
        $(document).ready(function(){
             $(".select2").select2();
             const compraDetalles = @json($compraDetalles);
             const productosList = @json($producto);
             function busquedaProductosList(indice,atributo){
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
             function busquedaDetalleList(indice,atributo){
                 result_detalle="";   
                 compraDetalles.forEach(function(result) {
                //alert($( "#barras" ).val()+ "=="+ e.id);
               
                //alert(indice +"=="+ result[atributo]);
                if (indice == result[atributo])
                   result_detalle=result;
                    
                    // console.(result.id);
                    });

                 //console.log(result_producto);
                    return result_detalle;   

            }
            const table = $('#compras_details_table').DataTable({
              
               
                //bFilter: true,
                //"bSort": false,

                "order": [[0, 'desc']],
                "columns": [{
                         "data": "id"
                    },
                    {
                        "data": 'producto'
                    },
                    {
                        "data": "vencimiento"
                    },
                    {
                        "data": "precio_unitario"
                    },
                    {
                        "data": "cantidad"
                    },
                    
                     {
                        "data": "subtotal"
                    },
                    	{ "mData": null , 
                     "mRender": function(data, type, row) {
						      	var btn_eliminar;
                                if(data.cantidad==data.cantidad_total)
                                      return  btn_eliminar='<button type="button" id="btn_delete_compras_detail" value='+data.id+' class="waves-effect waves-light btn btn-danger mb-5" data-container="body" title="" data-bs-original-title="Eliminar"><i class="fa fa-bitbucket" aria-hidden="true"></i></button>';
                                    else
                                    return    btn_eliminar='';
						        //return ' <button type="button" id="btn_edit_compras_detail" value='+data.id+' class="btn btn-secondary" data-bs-toggle="tooltip" data-container="body" title="" data-bs-original-title="Editar"><i class="fa fa-edit"></i></button>'+btn_eliminar;
                                 
						    }}
                    
 
    
                ],
               "data":compraDetalles,
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

                
            $(document).on('click', '#btn_create_compras', function(){
                // $("#create_product").empty();
                // $("#create_unit_price").val(0);
                // $("#create_quantity").val(1);
                // $("#create_subtotal").val('0.00');
                $("#modal-create-compra-detail").modal('show');
                //togglecreatePurchaseDetailButton();
                validateCreateDetail();
            });
            // $('#create_product').on('input', togglecreatePurchaseDetailButton);
            $('#update_compras').on('submit', function(event) {
                event.preventDefault(); // Evita el envío normal del formulario

                //var id = $('#compra_id').val();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('compras.update', ':id') }}".replace(':id', '{{ $compras->id }}'),
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

            $('#create_precio_unitario, #create_cantidad').on('input', function () {
                let precio_unidad = $("#create_precio_unitario").val();
                let create_cantidad= $("#create_cantidad").val();
                let subtotal = (precio_unidad * create_cantidad).toFixed(2);
                $("#create_subtotal_label").val(subtotal);
                $("#create_compra_id").val({{ $compras->id }});
                $("#create_subtotal").val(subtotal);
                validateCreateDetail();
                //togglecreatePurchaseDetailButton();
                //calculateTotalcreate();
            });

            $('#create_detalle').on('submit', function(event) {
                event.preventDefault(); 
                
                 var datos_productos=busquedaProductosList($("#create_producto_id").val(),"id");
                
                 //alert($("#create_precio_unitario").val()+'>'+datos_productos.precio_unitario);
                if(parseFloat($("#create_precio_unitario").val())>datos_productos.precio_unitario){                        
                        estado = "1";                       
                        $("#create_estado").val(estado);
                }else{
                        estado = "0";
                        $("#create_estado").val(estado);
                        
                }
                var formCreate = $(this).serialize();
                // console.log(formCreate);
                $.ajax({
                    url: "{{ route('compraDetalles.store') }}",
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

            $(document).on('click', '#btn_edit_compra', function(){
                
                event.preventDefault();
                var id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('compras.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        if(response.status === 200){
                            $('#purchase_id').val(response.data.compras.id);
                            //$('#purchase_date').text(response.data.purchase.purchase_date);
                            $('#proveedor').val(response.data.compras.proveedor);
                           $("#tipo").val(response.data.compras.tipo).change();
                           // $('#tipo').val(response.data.compras.tipo);
                            $("#modal-edit-compras").modal('show');
                          //  togglePurchaseButton();
                        }
                    }
                });
            });

         /*   $(document).on('click', '#btn_edit_compras_detail', function(){
                event.preventDefault();
                var id = $(this).val();
                //console.log(id);
                 var busquedaDetalle=busquedaDetalleList(id,"id");
                      // console.log(productos);
                            //$('#edit_purchaseDetail_id').val(compraDetalles.id);
                             //$('#edit_subtotal').val(response.data.purchaseDetail.subtotal);
                            // $('#edit_product').val(response.data.purchaseDetail.product);
                             $("#edit_producto_id").val(busquedaDetalle.producto_id).change();
                             $('#edit_vencimiento').val(busquedaDetalle.vencimiento);
                             $('#edit_precio_unitario').val(busquedaDetalle.precio_unitario);
                             $('#edit_cantidad').val(busquedaDetalle.cantidad);
                             $('#edit_subtotal_label').val(busquedaDetalle.subtotal);
                 //   console.log(busquedaDetalle);
                             
                            $("#modal-edit-compra-detail").modal('show');
                            //toggleeditPurchaseDetailButton();
                       
                    
                
            });*/
            $(document).on('click', '#btn_delete_compras_detail', function(){
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
                    url: "{{ route('compraDetalles.destroy', ':id') }}".replace(':id', id),
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
              
        
        });




           function validateCreateDetail() {
            const create_precio_unitario_value = $('#create_precio_unitario').val();
            const create_cantidad_value = $('#create_cantidad').val();
            
            const create_precio_unitario_filled = create_precio_unitario_value > 0;
             const create_cantidad_filled = create_cantidad_value > 0;
            //alert(create_cantidad_value);
            const saveButtonEnabled = create_precio_unitario_filled&&create_cantidad_filled;
            $('#create_compra_detalle_btn').prop('disabled', !saveButtonEnabled);
        }
            
    </script>
@endsection
