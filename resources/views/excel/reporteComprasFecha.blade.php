
 
<table><thead>
  <tr>
    <th colspan="3"></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th colspan="4"></th>
  </tr></thead>
<tbody>
  <tr>
    <td style="border-color:#ffffff;font-family:serif !important;font-size:20px;text-align:center;vertical-align:top" colspan="14"><b>INFORME DE COMPRAS</b></td>
  </tr>
  
    <tr>
    <td style="border-color:#ffffff;font-family:serif !important;font-size:14px;text-align:center;vertical-align:top"  colspan="14">de  {{$fecha_inicio}} al {{$fecha_fin}}</td>
  </tr>
     <tr>
    <td style="border-color:#ffffff;font-family:serif !important;font-size:14px;text-align:center;vertical-align:top"  colspan="14">Tipo Movimiento {{ $tipo_movimiento}}</td>
  </tr>
  
  <tr>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Nro.</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Fecha</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Nro. Compra</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Proveedor</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Codigo</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Producto</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Tipo</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Concentracion</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Marca</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Presentacion</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Vencimiento</td>    
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Cantidad</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Precio</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Sub Total</td>
  </tr>
  @foreach ($compras as $compra)
    <tr>
        <td >{{ $loop->iteration }}</td>
        <td >{{ $compra->compra_fecha }}</td>        
        <td >{{ $compra->numero_compra }}</td>
         <td >{{ $compra->proveedor }}</td>         
         <td >{{ $compra->codigo }}</td>
         <td >{{ $compra->producto }}</td>
        <td >{{ $compra->tipo }}</td>
        <td >{{ $compra->concentracion }}</td>
        <td >{{ $compra->marca }}</td>
        <td >{{ $compra->presentacion }}</td>
        <td >{{ $compra->vencimiento }}</td>
        <td >{{ $compra->cantidad }}</td>
        <td >{{ $compra->precio_unitario }}</td>
         <td >{{ $compra->subtotal }}</td>
       
    </tr>
@endforeach

  <tr>
    <td  colspan="12"></td>
    <td >Total</td>
    <td >{{ $total }}</td>
  </tr>
</tbody></table>

