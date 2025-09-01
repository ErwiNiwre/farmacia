
<table width=100%><thead>
  <tr>
    <th colspan="8"></th>
  </tr></thead>
<tbody>
  <tr>
    <td style="border-color:#ffffff;font-family:serif !important;font-size:20px;text-align:center;vertical-align:top" colspan="8">PRODUCTOS MAS VENDIDOS</td>
  </tr>
  <tr>
    <td style="border-color:#ffffff;font-family:serif !important;font-size:14px;text-align:center;vertical-align:top" colspan="8">de  {{$fecha_inicio}} al {{$fecha_fin}}<br>Tipo Movimiento {{$tipo_movimiento}}</td>
  </tr>
  <tr>
    <td style="border-color:#ffffff;font-family:serif !important;font-size:14px;text-align:center;vertical-align:top" colspan="8">Tipo Movimiento {{$tipo_movimiento}}</td>
  </tr>
  <tr>
    <td class="tg-a9mw" colspan="8"></td>
  </tr>
  <tr>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff; font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Nro.</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Codigo</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Producto</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Concentracion</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Marca</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Presentacion</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Movimiento</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff;f
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Cantidad</td>
  </tr>
  @foreach ($ventas_productos as $ventas_producto)
   
    <tr>
        <td >{{ $loop->iteration }}</td>
        <td >{{ $ventas_producto->codigo }}</td>
        <td >{{ $ventas_producto->producto }}</td>
        <td >{{ $ventas_producto->concentracion }}</td>
        <td >{{ $ventas_producto->marca }}</td>
        <td >{{ $ventas_producto->presentacion }}</td>
        <td >{{ $ventas_producto->tipo_movimiento }}</td>
        <td >{{ $ventas_producto->total_vendido }}</td>
       
    </tr>
@endforeach
 
</tbody></table>
