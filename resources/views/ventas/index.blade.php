@extends('app.app')

@section('title')
    Ventas
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Ventas
@endsection

@section('content')
    <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-4">

                            <h3 class="box-title">Listado de Ventas</h3>

                        </div>
                        <div class="col-4">

                        </div>
                        <div class="col-4">
                           
                                <a class="btn btn-success pull-right" href="{{ route('ventas.create') }}">
                                    <i class="fa fa-user-plus"></i> Nuevo</a>
                           

                        </div>
                        <div class="col-6">
                        </div>
                    </div>
                </div>
                <div class="box-body">

                    <div class="table-responsive">
                        <table id="dt_ventas" class="table b-1 border-success" style="width: 100%;">
                            <thead class="bg-success">
                                <tr>
                                    <th>Id</th>
                                    <th style="width: 10%;">Número de Venta</th>
                                    <th style="width: 15%;">Fecha</th>
                                    <th style="width: 20%;">Cliente</th>
                                    <th style="width: 10%;">Tipo de Movimiento</th>
                                    <th style="width: 15%;">Método de Pago</th>
                                    
                                    <th style="width: 15%; "class=" text-end">Total</th>
                                    <th style="width: 10%;">Acciones</th>
                                    <th style="width: 5%;" class="text-center">Recibo</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                     <th>Número de Venta</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    
                                    <th>Tipo de Movimiento</th>
                                    <th>Método de Pago</th>
                                    <th>Total</th>
                                    <th style="visibility:collapse; display:none;"></th>
                                    <th style="visibility:collapse; display:none;"></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    
<!-- Modal-Show-purchase -->
<div class="modal center-modal fade" id="modal-show-ventas" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog" style="max-width: 900px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="box-header with-border">
                    <div class="col-12">
			  <div class="page-header">
				<h2 class="d-inline"><span class="fs-30">Compra</span></h2>
				<div class="pull-right text-end">
					<h3 class="text-danger" id="fecha"> </h3>
				</div>	
			  </div>
			</div>
                </div>
                <div class="row mb-3">
                      <div class="row invoice-info">
                
			<div class="col-md-6 invoice-col">
			  
             
			  <address>
				<strong class="text-blue fs-20">Cliente: </strong><strong class="text-blue fs-20" id="cliente"></strong> <br>
                <strong class="text-blue fs-20">Numero de Venta: </strong><strong class="text-blue fs-20" id="numero_venta"></strong> <br>
                <strong class="text-blue fs-20">Metodo de Pago: </strong><strong class="text-blue fs-20" id="metodo_pago"> </strong> <br>
				
			  </address>
              <address id="display_observacion" style="display: none">
				
				<strong   class="text-blue fs-30">Observación </strong><strong class="text-blue fs-20">  </strong><br>
                <strong   class="text-blue fs-20"></strong><strong class="text-blue fs-20" id="observacion"> </strong> 
			  </address>
            
			</div>
			<!-- /.col -->
			<div class="col-md-4 invoice-col text-end">
			  
			  <address>
				<strong class="text-blue fs-24">TOTAL </strong><br>
				<strong id="total" class="text-blue fs-20"> </strong><br>
				
			  </address>
			</div>
            

			
		  </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12 mb-2">
                        <div class="middle">
                            <h5 class="box-title"><i class="fa fa-file-text-o me-15"></i>Detalle de las Ventas</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                        <div class="table-responsive">
                            
                            <table id="tbl_venta_detalles" class="table table-bordered" style="width: 100%;">
                                <thead >
                                    <tr>
                                        <th  >Productos</th>
                                        <th  class="text-end">Precios (Bs)</th>
                                        <th  class="text-end">Cantidades</th>
                                        <th  class="text-end">Subtotales</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
			<div class="col-12 text-end">
				

				
				<div class="total-payment">
					<h3><b id="total_subtotal"></b></h3>
				</div>

			</div>
			<!-- /.col -->
		  </div>
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-danger pull-right" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
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
			<p>Realmente desea la Venta</p>
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
         
        $(document).ready(function() {
            
            const ventas = @json($ventas);
            var table_ventas= $('#dt_ventas').DataTable({
                
                //bFilter: true,
                //"bSort": false,

                "order": [[0, 'desc']],
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "numero_venta"
                    },
                    {
                        "data": 'venta_fecha'
                    },
                    {
                        "data": "cliente"
                    },
                    {
                        "data": "tipo"
                    },
                    {
                        "data": "metodo_pago"
                    },
                    
                    
                    
                     {
                        "data": "total",
                        className: 'text-end'
                    },
                    	
                     
                    { "mData": null , 
                    orderable: false,
                        searchable: false,
                      //  className: 'text-center',
                     "mRender": function(data, type, row) {
                        var fecha = moment(data.venta_fecha).format('YYYY-MM-DD');
                        var btn_delete="</div>";
                       // alert(data.id);
                       // alert(fecha+'=='+moment().format('YYYY-MM-DD'));
                        if(fecha==moment().format('YYYY-MM-DD'))
						     btn_delete='<button type="button" id="btn_delete_ventas" value='+data.id+' class="btn btn-danger" data-bs-toggle="tooltip" title="Eliminar" ><i class="mdi mdi-delete" ></i></button></div>';
                               
                     return '<div class="d-block text-dark flexbox"><button type="button" onclick="modalVentas('+data.id+')" id="btn_view_compras" value='+data.id+' class="btn btn-info" data-bs-toggle="tooltip"  data-bs-original-title="Ver Compra"><i class="mdi mdi-eye"></i></button>'+btn_delete;   
						    }
                        },
                        { "mData": null , 
                    orderable: false,
                        searchable: false,
                        className: 'text-center',
                     "mRender": function(data, type, row) {
                                                         
                     return `<a href="ventas/${data.id}/print" target="_blank"  id="btn_print_ventas" class="btn btn-warning" data-bs-toggle="tooltip" title="Imprimir Recibo" ><i class="fa fa-file-pdf-o" ></i></a> `;   
						    }
                        }
                    
 
    
                ],
                "data": ventas,
                "columnDefs": [{
                    "targets": 0,
                    "type": "num",
                    "visible": false
                }],
                pageLength: 5,
                lengthChange: false,
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;
                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                },
                "language": {
                    "url": "{{ asset('lang/datatable.es-ES.json') }}"
                },



            });
             table_ventas.on('draw', function() {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
            $('#dt_ventas tfoot th').each(function() {
                var title = $(this).text();

                $(this).html('<input type="text" class="form-control shadow" placeholder="' + title +
                    '" />');
            });

             $(document).on('click', '#btn_delete_ventas', function(){
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
                    url: "{{ route('ventas.destroy', ':id') }}".replace(':id', id),
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
  
function modalVentas(id){
                   
                
    $.ajax({
                    type: "GET",
                    url: "{{ route('ventas.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        if(response.status === 200){
                           // console.log(response.data.ventas);
                          // console.log(response.data.ventas[0].venta_fecha);
                             var fecha = moment(response.data.ventas[0].venta_fecha)
                .format('DD-MM-YYYY');
                 
                  $( "#display_observacion" ).hide();
                var metodo_pago=response.data.ventas[0].metodo_pago;
                // if(metodo_pago=='E')
                // metodo_pago='EFECTIVO';
                // if(metodo_pago=='Q')
                // metodo_pago='QR';
                // if(metodo_pago=='M')
                // metodo_pago='EFECTIVO Y QR';
                // if(metodo_pago=='N')
                // metodo_pago='NINGUNO';
                          
                             $('#cliente').text(response.data.ventas[0].cliente);
                            $('#metodo_pago').text(metodo_pago);
                            $('#numero_venta').text(response.data.ventas[0].numero_venta);
                             $('#total').text(response.data.ventas[0].total+" BS");
                              $('#fecha').text(fecha);
                              $('#total_subtotal').text(" BS. "+response.data.ventas[0].total);
                              if(response.data.ventas[0].observacion){
                               $( "#display_observacion" ).show();
                               $('#observacion').text(response.data.ventas[0].observacion);}
                            // $('#purchase_date').text(response.data.purchase.purchase_date);
                            // $('#supplier').text(response.data.purchase.supplier);
                            // $('#purchase').text(response.data.purchase.purchase);
                             var tbody = $('#tbl_venta_detalles tbody');
                             tbody.empty();

                             var ventaDetalles = response.data.ventaDetalles;

                            ventaDetalles.forEach(function(detail) {
                                var vencimiento = !detail.vencimiento?'' : moment(detail.vencimiento).format('DD-MM-YYYY');
                                var row = `
                                    <tr>
                                        <td style="width: 55%;" >${detail.producto}</td>
                                        <td style="width: 20%;" class="text-end">${detail.precio_unitario} Bs.</td>
                                        <td style="width: 10%;" class="text-end">${detail.cantidad}</td>
                                        <td style="width: 15%;" class="text-end">${detail.subtotal} Bs.</td>
                                    </tr>
                                `;
                                tbody.append(row);
                            });

                            // $('#amount').text(response.data.purchase.amount+" Bs.");
                        }
                        
                        $('#modal-show-ventas').modal('show');
                    }
                });

          }

      
                        
                       
                    
               

          

        
    </script>
@endsection
