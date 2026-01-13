
    
  

<table ><thead>
  <tr>
    <th  colspan="3"></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th  colspan="4"></th>
  </tr></thead>
<tbody>
  <tr>
     <td style="border-color:#ffffff;font-family:serif !important;font-size:20px;text-align:center;vertical-align:top" colspan="10">INFORME DE VENTAS TOTALES</td>
  </tr>
    <tr>
    <td style="border-color:#ffffff;font-family:serif !important;font-size:14px;text-align:center;vertical-align:top" colspan="10">de  {{$fecha_inicio}} al {{$fecha_fin}}</td>
  </tr>
  <tr>
    
    <td style="border-color:#ffffff;font-family:serif !important;font-size:14px;text-align:center;vertical-align:top" colspan="10">Tipo Movimiento: {{$tipo_movimiento}}</td>
  </tr>
  <tr>
    <td class="tg-a9mw" colspan="10"></td>
  </tr>
  <tr>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Nro.</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Fecha</td>
	<td style="background-color:#2899f3;color:white; font-weight: bold;">Usuario</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Nro. Venta</td>
	<td style="background-color:#2899f3;color:white; font-weight: bold;">Movimiento</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Cliente</td>
    <td style="background-color:#2899f3;color:white; font-weight: bold;">Observacion</td>
	<td style="background-color:#2899f3;color:white; font-weight: bold;">Efectivo</td>
	<td style="background-color:#2899f3;color:white; font-weight: bold;">QR</td>
	<td style="background-color:#2899f3;color:white; font-weight: bold;">Total</td>
  </tr>
  @foreach ($ventas as $venta)
  
    <tr>
        <td >{{ $loop->iteration }}</td>
        <td >{{ $venta->venta_fecha }}</td>
		<td >{{ $venta->nombre }}</td>
        <td >{{ $venta->numero_venta }}</td>
		<td >{{ $venta->tipo }}</td>
        <td >{{ $venta->cliente }}</td>
        <td >{{ $venta->observacion }}</td>
		<td style="text-align: left;">{{ $venta->efectivo }}</td>
		<td style="text-align: left;">{{ $venta->qr }}</td>
		<td style="text-align: left;">{{ $venta->total }}</td>
		
    </tr>
@endforeach

  <tr>
    <td  colspan="8"></td>
    <td style=" font-weight: bold;">Total</td>
    <td >{{ number_format($total, 2) }}</td>
  </tr>
</tbody></table>
