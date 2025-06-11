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
                    <div class="col-12">
			  <div class="page-header">
				<h2 class="d-inline"><span class="fs-30">Detalle de la Compra</span></h2>
				<div class="pull-right text-end">
					<h3 class="text-danger"> {{ isset($compras) ? $compras->compra_fecha : old('compra_fecha') }}</h3>
				</div>	
			  </div>
			</div>
                </div>
            <div class="box-body">
            <div class="row invoice-info">
                
			<div class="col-md-6 invoice-col">
			  
             
			  <address>
				<strong class="text-blue fs-24">Proveedor: </strong><strong class="text-blue fs-24">{{ isset($compras) ? $compras->proveedor : old('proveedor') }}</strong> <br>
                <strong class="text-blue fs-24">Tipo de Movimiento:</strong><strong class="text-blue fs-24"> {{ isset($compras) ? $compras->tipo : old('tipo') }}</strong> <br>
                <strong class="text-blue fs-24">Número de Compra: </strong><strong class="text-blue fs-24"> {{ isset($compras) ? $compras->numero_compra : old('numero_compra') }}</strong> <br>
				
			  </address>
			</div>
			<!-- /.col -->
			<div class="col-md-4 invoice-col text-end">
			  
			  <address>
				<strong class="text-blue fs-24">TOTAL </strong><br>
				<strong class="text-blue fs-24"> {{ isset($compras) ? $compras->total : old('total') }} BS</strong><br>
				
			  </address>
			</div>
            

			
		  </div>
           <div class="box-header with-border">
                    <div class="col-12">
			  
			</div>
                </div>
                    <div class="table-responsive">
                        
                        <table id="dt_compras_detalle" class="table table-striped table-bordered display" style="width: 100%;">
                            
                            <thead >
                                 
                                <tr>
                                    
                                     <th class="text-center">Id</th>
                                                    <th class="text-center">Producto</th>
                                                   
                                                    <th class="text-center">Precio/Unidad(BS)</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">SubTotal(BS)</th>
                                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                     <th class="text-center">Id</th>
                                                    <th class="text-center">Producto</th>
                                                   
                                                    <th class="text-center">Precio/Unidad(BS)</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">SubTotal(BS)</th>
                                </tr>
                            </tfoot>
                            
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    

@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
           const compras = @json($compraDetalle);
          // console.log(compras);
            var table_compras= $('#dt_compras_detalle').DataTable({
              
                  
                   
                //bFilter: true,
                //"bSort": false,

                // "order": [[0, 'desc']],
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": 'producto'
                    },
                    {
                        "data": "cantidad"
                    },
                    {
                        "data": "precio_unitario"
                    },
                     {
                        "data": "subtotal"
                    }
    //                 { "mData": null ,
    //                 orderable: false,
    //                     searchable: false, 
    //  "mRender" : function ( data, type, full ){ 
    //     // alert(data.flujo);
    //     //alert(data.proyecto_id);
        
    //     return '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-fill">	Launch demo modal </button>'  }
    // } , 
                ],
                 "data":compras,
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

            $('#dt_compras_detalle tfoot th').each(function() {
                var title = $(this).text();

                $(this).html('<input type="text" class="form-control shadow" placeholder="' + title +
                    '" />');
            });
            //   $('#dt_laboratorio_servicios tfoot th').each(function() {
            //         var title = $(this).text();

            //         $(this).html('<input type="text" class="form-control shadow" placeholder="'+title+'" />');
            //     });
            //       $('.dt_laboratorio_servicios thead th').each( function () {
            //     var title = $(this).text();
            //     $(this).html('<input type="text" placeholder="Search '+title+'" />' );
            // } );


                // table_servicios.columns().every( function () {
			    //     var that = this;
                //     console.log(that);
			 
			    //     $( 'input', this.footer() ).on( 'keyup change ', function () {
                //        // console.log(that.search());
			    //         if ( that.search() !== this.value ) {
			    //             that
			    //                 .search( this.value )
			    //                 .draw();
			    //         }
			    //     } );

     
			    // });



        });
        
    </script>
@endsection
