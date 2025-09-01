
<table class="tg" width=100%><thead>
  <tr>
    <th class="tg-a9mw" colspan="9"></th>
  </tr></thead>
<tbody>
  <tr>
    <td style="font-family:serif !important;font-size:20px;text-align:center;vertical-align:top" colspan="9">PRODUCTOS MAS COMPRADOS</td>
  </tr>
  <tr>
    <td style="font-family:serif !important;font-size:14px;text-align:center;vertical-align:top" colspan="9">de  {{$fecha_inicio}} al {{$fecha_fin}}<br>Tipo Movimiento {{$tipo_movimiento}}</td>
    <td style="font-family:serif !important;font-size:14px;text-align:center;vertical-align:top" colspan="9">Tipo Movimiento {{$tipo_movimiento}}</td>
  </tr>
  <tr>
    <td class="tg-a9mw" colspan="9"></td>
  </tr>
  <tr>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff; font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Nro.</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff; font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Proveedor</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff; font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Codigo</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff; font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Producto</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff; font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Concentracion</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff; font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Marca</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff; font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Presentacion</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff; font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Movimiento</td>
    <td style="background-color:#2899f3;border-color:#c0c0c0;color:#ffffff; font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Cantidad</td>
  </tr>
  @foreach ($productosComprados as $productos)
   
    <tr>
        <td >{{ $loop->iteration }}</td>
        <td >{{ $productos->proveedor }}</td>
        <td >{{ $productos->codigo }}</td>
        <td >{{ $productos->producto }}</td>
        <td >{{ $productos->concentracion }}</td>
        <td >{{ $productos->marca }}</td>
        <td >{{ $productos->presentacion }}</td>
        <td >{{ $productos->tipo_movimiento }}</td>
        <td >{{ $productos->cantidad_total }}</td>
       
    </tr>
@endforeach
 
</tbody></table>

