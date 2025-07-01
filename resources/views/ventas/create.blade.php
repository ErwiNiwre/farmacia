@extends('app.app')

@section('title')
    Ventas
@endsection

@section('caption')
    <i class="ti-home me-2"></i> Registro de Ventas
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-xxxl-12">
                <form id="createventas" autocomplete="off" onkeydown="event.keyCode === 13">
                    <div class="box">
                        <div class="box-body">
                            <h5 class="box-title text-info mb-0"><i class="fa fa-id-card-o me-15"></i>Datos de la Venta</h5>
                            <hr class="my-15">
                            <div class="row">
                                <div class="col-xs-5 col-sm-5 col-md-6 col-lg-5 col-xl-5 col-xxl-5 col-xxxl-5">
                                    <div class="form-group">
                                        <label class="form-label">Cliente</label>
                                        <input type="text" id="cliente" name="cliente" class="form-control"
                                            value="{{ old('cliente') }}" placeholder="Cliente">
                                           
                                    </div>
                                </div>
                                {{-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-xxxl-4 badge badge-info text-center">
                                <input type="hidden" id="amount" name="amount" class="form-control" value="{{ old('amount') }}">
                                <div id="price_display" class="fs-40">Bs. 0.00</div>
                            </div> --}}
                        <div class="col-xs-3col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3">

                                      <div class="form-group">
                                        <label class="form-label">Tipo</label>
                                        <select id="tipo" class="form-control select2" style="width: 100%;">
                                           
                                            <option selected="selected" value="Venta">Venta</option>
                                            <option value="Salida Directa">Salida Directa</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                
                                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-xxxl-4 badge badge-info text-center">
                                <input type="hidden" id="total" name="total" class="form-control" value="{{ old('total') }}">
                                <div id="total_display" class="fs-40">Total Bs. 0.00</div>
                            </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-xxxl-2">

                                      <div class="form-group">
                                        <label class="form-label">Metodo de Pago</label>
                                        <select id="metodo_pago" class="form-control select2" style="width: 100%;">
                                            <option selected="selected" value="E">Efectivo</option>
                                            <option value="Q">QR</option>
                                            <option value="M">Efectivo y QR</option>
                                            <option value="N">Ninguno</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3">
                                    <div id="display_efectivo" class="form-group">
                                        <label class="form-label">Efectivo</label>
                                        

                                        <input id="efectivo" type="text"
                                            value="{{ old('efectivo', 0) }}" name="efectivo"
                                            data-bts-button-down-class="btn btn-secondary"
                                            data-bts-button-up-class="btn btn-secondary">
                                        {!! $errors->first('efectivo', '<small class="text-danger">:message</small>') !!}
                                           
                                    </div>
                                </div>
                                

                                <div  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3">
                                    <div id="display_qr" style="display:none" class="form-group">
                                        <label class="form-label">QR</label>                                       
                                            <input id="qr" type="text"
                                            value="{{ old('qr', 0) }}" name="qr"
                                            data-bts-button-down-class="btn btn-secondary"
                                            data-bts-button-up-class="btn btn-secondary">
                                        {!! $errors->first('qr', '<small class="text-danger">:message</small>') !!}
                                           
                                           
                                    </div>
                                </div>
                            
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 col-xxxl-4 badge badge-success text-center">
                               
                               <label  class="fs-40">Cambio Bs. </label> <label id="cambio_display" class="fs-40">0.00</div>
                            </div>
                                <div class="row" id="observacion_section" style="display: none">
                               
                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5 col-xxxl-5">
                                    <div class="form-group">
                                        <label class="form-label">Observacion</label>
                                        <textarea  type="text" id="observacion"  name="observacion" class="form-control"   placeholder="Observacion"> </textarea>
                                           
                                    </div>
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
							<div class="col-md-4">
								<div class="form-group">
									<label for="wfirstName2" class="form-label"> Codigo de Barras : <span class="danger">*</span> </label>
									<input type="text" class="form-control required" id="barras" name="codigo"> 
								</div>
							</div>
							<div class="col-md-4">
								  <div class="form-group">
                                        <label class="form-label">Producto</label>
                                        <select id="producto_id" class="form-control select2" name="producto_id"
                                            class="form-select">
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
                            <div class="col-md-4">
								<div class="form-group">
									<button type="button" id="addRow" class="btn btn-success pull-right"
                                    data-bs-toggle="tooltip" data-container="body" title=""
                                    data-bs-original-title="Nuevo Producto"><i class="fa fa-plus"></i></button>
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
                                                    <th class="text-center">Producto</th>   
                                                    <th class="text-center">Stock<br>Registrado</th>  
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
                        <button type="submit" id="btn_save" class="btn btn-primary"><i class="ti-save-alt"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
           
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
            const productosList = @json($producto);
            toggleSaveButton();
            $('#createventas').keydown(function(event){
             if(event.keyCode == 13&& !event.target.matches("textarea")) {
            
               event.preventDefault();
               return false;
               }
            });
            function busquedaProductosList(indice,atributo){
                 result_producto="";   
                 productosList.forEach(function(result) {
         
                if (indice == result[atributo])
                   result_producto=result;
                    
                  
                    });

               
                    return result_producto;   

            }
        

       $('#barras').keydown(function(event){
             
                var resul_producto_id="";
           
            if(event.keyCode == 13) {
            var productos=busquedaProductosList($( "#barras" ).val(),"barras");
             
           
                   
                  // alert(productos.cantidad-1+'>'+0)
               if(productos ){
                if(parseFloat(productos.cantidad-1)>=0){
                 if(verificarProductoDt(productos.id)==false){
                        
                       
                    
                //alert(productos.precio_venta);
                $("#producto_id").val(productos.id).change();
                 table.row.add([
                    $('#producto_id').find('option:selected').val(),
                    $.trim($('#producto_id').find('option:selected').text()),
                   '<div class="form-group">'+productos.cantidad+'</div>',
                    `<div class="form-group"><input type="number" class="form-control" lang="en"  name="cantidades[]" value="1" min="0" step="0.1"></div>`,
                    `<div class="form-group"><input type="number" class="form-control" lang="en" name="unidad_precios[]" value=`+productos.precio_venta+` min="0"  step="0.1"></div>`,
                    `<div class="form-group">`+productos.precio_venta+`</div>`,
                    '<button type="button" value='+productos.id+' name="removeRow" class="btn btn-danger" data-bs-toggle="tooltip" data-container="body" data-bs-original-title="Eliminar"><i class="mdi mdi-delete"></i></button>'
                ]).draw(false);
                calculateTotal();
                toggleSaveButton();
                
                 $( "#barras" ).trigger( "focus" );
                 $( "#barras" ).val( "" );
                 }else{
 alert("El producto ya fue ingresado ");
                 }
                 }else{
 alert("No hay sufucientes existencias del producto ");
                 }
            }
            else{
                alert("código no encontrado");
                 }
                 $("#barras").val("");
                 return false;
 
        }
        
} );
            
            
   
           $('#cliente').on('input', toggleSaveButton);
           $('#efectivo, #qr').on('input', (calculoCambio));
           
           $('#efectivo, #qr').on('input', (toggleSaveButton));
           

            const table = $('#venta_details_table').DataTable({
                "ordering": false,
                "columnDefs": [{
                        "targets": 0,
                        "width": "0%",
                        "className": 'text-start',
                        "visible": false
                    },
                    {
                        "targets": 1,
                        "width": "30%",
                        "className": 'text-start'
                    },
                    {
                        "targets": 2,
                        "width": "15%",
                        "className": 'text-start'
                    },
                     {
                        "targets": 3,
                        "width": "15%",
                        "className": 'text-start'
                    },
                    {
                        "targets": 4,
                        "width": "15%",
                        "className": 'text-end'
                    },
                    {
                        "targets": 5,
                        "width": "15%",
                        "className": 'text-end'
                    },
                    {
                        "targets": 6,
                        "width": "10%",
                        "className": 'text-end'
                    },
                   
                    
                ],
                pageLength: 10,
                lengthChange: false,
                "language": {
                    "url": "{{ asset('lang/datatable.es-ES.json') }}"
                }
            });

            $('#addRow').on('click', function() {
               $( "#barras" ).val("");
                var productos=busquedaProductosList($( "#producto_id" ).val(),"id");
                
                 if(verificarProductoDt(productos.id)==false){
                table.row.add([
                    $('#producto_id').find('option:selected').val(),
                    $.trim($('#producto_id').find('option:selected').text()),
                    '<div class="form-group">'+productos.cantidad+'</div>',
                    `<div class="form-group"><input type="number" class="form-control" name="cantidades[]" value="1" min="0" step="0.1"></div>`,
                     `<div class="form-group"><input type="number" lang="en" class="form-control" name="unidad_precios[]" value=`+productos.precio_venta+` min="1"></div>`,
                     `<div class="form-group">`+productos.precio_venta+`</div>`,
                    '<button type="button"  name="removeRow"  class="btn btn-danger" data-bs-toggle="tooltip" data-container="body" data-bs-original-title="Eliminar" ><i class="mdi mdi-delete" ></i></button>'
                ]).draw(false);
                calculateTotal();
                toggleSaveButton();
                 }else{
                    alert("El porducto ya fue ingresado")
                 }
            });
            function calculoCambio(){
                let total=parseFloat($('#total').val());
                let qr=parseFloat($('#qr').val());
                let efectivo=parseFloat($('#efectivo').val());
                qr=isNaN(qr) ? 0 : qr;
                efectivo=isNaN(efectivo) ? 0 : efectivo;
                total = isNaN(total) ? 0 : total;
                let cambio=efectivo-total+qr;
                
                $('#cambio_display').text( cambio.toFixed(2));

            }
           
            function calculateTotal() {
                let total = 0;
                let stock = 0;
               
                $('#venta_details_table').DataTable().rows().nodes().each(function(row, index) {
                    
                     const $subtotalCell =   $(row).find('td:eq(4)').text();
                      const $stock =   $(row).find('td:eq(1)').text();
                    //console.log($subtotalCell);
                 
                    total += parseFloat($subtotalCell);
                    stock -= parseFloat(stock)-$(row).find('input[name="unidad_precios[]"]').val();
                    
                });
               
                 total = isNaN(total) ? 0 : parseFloat(total).toFixed(2);
                $('#total_display').text('Total Bs. ' + total);
                $('#price_table').text('Bs. ' + total);
                $('#total').val(total);
              
                 
            }
            
            $('#venta_details_table').on('input', 'input[name="unidad_precios[]"], input[name="cantidades[]"]',
                function() {
                    const $row = $(this).closest('tr');
                    let price = $row.find('input[name="unidad_precios[]"]').val();
                   
                     original=$row.find('td:eq(1)').text();
                     
                    const cantidad = $row.find('input[name="cantidades[]"]').val();
                    const subtotal = (cantidad * price).toFixed(2);
             
                    $row.find('td:eq(4)').text(`${subtotal}`);
                   
                   if(cantidad<=parseFloat($row.find('td:eq(1)').text()))
                    {calculateTotal();
                    toggleSaveButton();}
                    else{
                        alert("la cantidad excede las existencias del producto");
                        $row.find('input[name="cantidades[]"]').val($row.find('td:eq(1)').text());
                    }
                   
                });

            $('#venta_details_table').on('click', 'button[name="removeRow"]', function() {
                const row = $(this).closest('tr');
                table.row(row).remove().draw();
                calculateTotal();
                toggleSaveButton();
            });

            $('#createventas').on('submit', function(event) {
                event.preventDefault();
                $('#btn_save').prop('disabled', true);
                var cliente = $('#cliente').val();
                 var tipo = $('#tipo').val();
                 var observacion = $('#observacion').val();
                var compras = $('#compras').val();
                var metodo_pago = $('#metodo_pago').val();
                 var efectivo = $('#efectivo').val();
                  var qr = $('#qr').val();
                var total = $('#total').val();
                var productos = updateProductDetails();
                
                
                if (productos.length === 0) {
                    alert('No se ha seleccionado ningún servicio.');
                    return; // Evitar el envío si no hay servicios
                }
                
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('ventas.store') }}",
                    type: 'POST',
                    data: {
                        'cliente': cliente,
                        'tipo': tipo,
                        'observacion': observacion,
                        'compras': compras,
                        'metodo_pago': metodo_pago,
                        'total': total,
                        'efectivo': efectivo,
                        'qr': qr,
                        'productos': productos,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {

                        if (response.status === 200) {

                       window.open(response.pdf_url, '_blank');

                            location
                                .reload(); // Recargar o actualizar la vista según sea necesario
                        } else {
                            alert('Ocurrió un error al guardar los cambios.');
                             toggleSaveButton();
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Ocurrió un error inesperado: ' + error);
                         toggleSaveButton();
                    }
                });
           
            });
              function verificarProductoDt(id_producto) {
                var total_cantidad=0;
                var ind=0;
                 var estado=false;
                 var stock;
                  var table = $('#venta_details_table').DataTable();
                   //alert();
                if (table.rows().count() != 0) {
                $('#venta_details_table').DataTable().rows().nodes().each(function(row, index) {
                
                     if(this.data()[ind][0]==id_producto)
                    estado= true;
               
               ind++;

                })
                
             
                }
                 return estado;
             }
             function verificarStock(id_producto,evento) {
                var total_cantidad=0;
                var ind=0;
                 var stock;
                  var table = $('#venta_details_table').DataTable();
                if (table.rows().count() != 0) {
                $('#venta_details_table').DataTable().rows().nodes().each(function(row, index) {
                 
                     stock =busquedaProductosList(this.data()[ind][0],"id");
                     alert(this.data()[ind][0]+'=='+id_producto);
                     if(this.data()[ind][0]==id_producto)
                    total_cantidad += parseFloat($(row).find('input[name="cantidades[]"]').val());
                else
                total_cantidad =0;
               ind++;

                })
              
              total_cantidad= isNaN(total_cantidad) ? 0 : total_cantidad;
                 if(stock.cantidad>=parseFloat(total_cantidad)+parseFloat(evento)){
                            return true;
                 }else{
                            return false;
                 }
                }
             }

            function updateProductDetails() {
                var comprasDetails = [];                
                var ind = 0;
              
                $('#venta_details_table').DataTable().rows().nodes().each(function(row, index) {

                    var producto_id = this.data()[ind][0]; // Obtener el ID del servicio
                   
                    var unidad_precio = $(row).find('input[name="unidad_precios[]"]').val();
                    var cantidad = $(row).find('input[name="cantidades[]"]').val();
                    var subtotal = $(row).find('td:eq(4)').text().replace('Bs. ',''); // Obtener el subtotal
                    var cantidad_total=$(row).find('td:eq(1)').text();
  

                    if (!producto_id || !unidad_precio || !cantidad || !subtotal) {
                        return; // Ignorar filas con datos incompletos
                    }

                    // Crear el objeto servicio
                    var producto_venta = {
                        producto_id: producto_id,
                        //vencimiento: vencimiento,
                        unidad_precio: parseFloat(unidad_precio) || 0, // Asegurar que price sea un número
                        cantidad: parseInt(cantidad) || 0, // Asegurar que quantity sea un número
                        subtotal: parseFloat(subtotal) || 0, // Asegurar que subtotal sea un número
                        cantidad_total: cantidad_total
                    };

                    comprasDetails.push(producto_venta);
                    ind++;
                });
              
                return JSON.stringify(comprasDetails);
            }

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
            }else if (valor === 'N') {
            $('#display_efectivo, #display_qr').hide();
            $('#efectivo,#qr').val(0);
            calculoCambio();
            }
        });
        });

        function toggleSaveButton() {
            
            const clienteValue= $('#cliente').val().trim();
            const EfectivoValue = parseFloat($('#efectivo').val());
            const QrValue = parseFloat($('#qr').val());
            const cambio= parseFloat($('#cambio_display').text());
            
            const clienteFilled = clienteValue.length > 0;
            const EfectivoFilled = (EfectivoValue+QrValue) > 0;
            const CambioFilled = cambio >= 0;
       // alert(cambio +'>'+ 0);
            let allProductsFilled = true;
            $('#venta_details_table tbody tr').each(function() {
                const productInput = $(this).find('input[name="cantidades[]"]');
               
                // console.log(productInput);
                if (productInput.length === 0 || productInput.val().trim().length === 0) {
                 
                    allProductsFilled = false;
                    return false;
                }
                
            });
            
           let saveButtonEnabled;
            if($('#tipo').val()=='Venta')
             saveButtonEnabled = clienteValue && EfectivoFilled&& allProductsFilled&&CambioFilled;
            else
             saveButtonEnabled =  allProductsFilled;
            $('#btn_save').prop('disabled', !saveButtonEnabled);
        }
        
        $("#tipo").change(function() {
           
            if($("#tipo").val()=='Salida Directa'){
                $('#observacion_section').show();
                toggleSaveButton();
        }
        else{
            $('#observacion_section').hide();
            toggleSaveButton();
        }

           
           
});
  


function validarStock(productos) {
 
  const resumen = {};

  for (const item of productos) {
    
    const id = item.producto_id;
    const cantidadTotal = parseInt(item.cantidad_total);
    alert(id);
    if (!resumen[id]) {
      resumen[id] = {
        cantidad_sumada: 0,
        cantidad_total: cantidadTotal
      };
    }

    resumen[id].cantidad_sumada += item.cantidad;
  }

  // Validar si alguno supera la cantidad_total
  for (const id in resumen) {
    const { cantidad_sumada, cantidad_total } = resumen[id];
    alert(cantidad_sumada +'>'+ cantidad_total);
    if (cantidad_sumada > cantidad_total) {
        alert(false);
      return false;
    }
  }
  
  return true;
}
         
    </script>
@endsection
