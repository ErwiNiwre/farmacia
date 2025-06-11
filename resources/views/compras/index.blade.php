@extends('app.app')

@section('title')
    Compras
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Compras
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-4">

                            <h3 class="box-title">Listado de Compras</h3>

                        </div>
                        <div class="col-4">

                        </div>
                        <div class="col-4">
                            @can('compras-Crear')
                                <a class="btn btn-success pull-right" href="{{ route('compras.create') }}">
                                    <i class="fa fa-user-plus"></i> Nuevo</a>
                            @endcan

                        </div>
                        <div class="col-6">
                        </div>
                    </div>
                </div>
                <div class="box-body">

                    <div class="table-responsive">
                        <table id="dt_compras" class="table b-1 border-success" style="width: 100%;">
                            <thead class="bg-success">
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Número de Compra</th>
                                    <th>Proveedor</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Número de Compra</th>
                                    <th>Proveedor</th>
                                    <th>Total</th>
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
<div class="modal center-modal fade" id="modal-show-compras" data-bs-backdrop="static" tabindex="-1">
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
				<strong class="text-blue fs-20">Proveedor: </strong><strong class="text-blue fs-20" id="proveedor"></strong> <br>
                <strong class="text-blue fs-20">Tipo de Movimiento: </strong><strong class="text-blue fs-20" id="tipo"></strong> <br>
                <strong class="text-blue fs-20">Número de Compra: </strong><strong class="text-blue fs-20" id="numero_compra"> </strong> <br>
				
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
                            <h5 class="box-title"><i class="fa fa-file-text-o me-15"></i>Detalle de las Compras</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                        <div class="table-responsive">
                            
                            <table id="tbl_compra_detalles" class="table table-bordered" style="width: 100%;">
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


          
@endsection

@section('page-script')
    <script>
         
        $(document).ready(function() {

           
            var table_compras= $('#dt_compras').DataTable({
                "ajax": "{{ route('getListCompras') }}",
                //bFilter: true,
                //"bSort": false,

                "order": [[0, 'desc']],
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": 'compra_fecha'
                    },
                    {
                        "data": 'tipo'
                    },
                    {
                        "data": "numero_compra"
                    },
                    {
                        "data": "proveedor"
                    },
                     {
                        "data": "total"
                    },
                    	
                     {
                        "data": "action",
                        orderable: false,
                        searchable: false
                    },
                    
 
    
                ],
                "columnDefs": [{
                    "targets": 0,
                    "type": "num",
                    "visible": false
                }],
                pageLength: 10,
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

            $('#dt_compras tfoot th').each(function() {
                var title = $(this).text();

                $(this).html('<input type="text" class="form-control shadow" placeholder="' + title +
                    '" />');
            });
     
          
        });
  
function modalCompras(id){
                   
                
    $.ajax({
                    type: "GET",
                    url: "{{ route('compras.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        if(response.status === 200){
                             var fecha = moment(response.data.compras.compra_fecha)
                .format('DD-MM-YYYY');
                            $('#proveedor').text(response.data.compras.proveedor);
                            $('#tipo').text(response.data.compras.tipo);
                            $('#numero_compra').text(response.data.compras.numero_compra);
                             $('#total').text(response.data.compras.total+" BS");
                              $('#fecha').text(fecha);
                              $('#total_subtotal').text(" BS. "+response.data.compras.total);
                              
                            // $('#purchase_date').text(response.data.purchase.purchase_date);
                            // $('#supplier').text(response.data.purchase.supplier);
                            // $('#purchase').text(response.data.purchase.purchase);
                             var tbody = $('#tbl_compra_detalles tbody');
                             tbody.empty();

                             var compraDetalles = response.data.compraDetalles;

                            compraDetalles.forEach(function(detail) {
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
                        
                        $('#modal-show-compras').modal('show');
                    }
                });

          }

          function deleteCompra(id){
                   
                console.log(id);
   
                            
                  

                 /*  $.ajax({
                    type: "GET",
                    url: "{{ route('compras.destroy', ':id') }}".replace(':id', id),
                    success: function(response) {
                        if(response.status === 200){
                           
                            
                           

                            // $('#amount').text(response.data.purchase.amount+" Bs.");
                        }
                        
                        
                    }
                });
                 $('#modal-delete-compras').modal('show');*/
                        }
                        
                       
                    
               

          

        
    </script>
@endsection
