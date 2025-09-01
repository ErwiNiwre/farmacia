
    

<table ><thead>
  <tr>
    <th colspan="3"></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th  colspan="3"></th>
  </tr></thead>
<tbody>
  <tr>
    <td style="font-family:serif !important;font-size:20px;text-align:center;vertical-align:top" colspan="9"><b>PRODUCTOS POR CADUCAR</b></td>
  </tr>
  <tr>
    <td style="font-family:serif !important;font-size:16px;text-align:center;vertical-align:top" colspan="9"><b>Hasta fecha </b> {{ $fecha_limite}}<br></td>
  </tr>
   <tr>
    <td style="font-family:serif !important;font-size:16px;text-align:center;vertical-align:top" colspan="9"><b>Tipo Movimiento</b> {{ $tipo_movimiento}}</td>
  </tr>
  <tr>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;">Nro.</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;">Fecha de Compra</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;">Movimiento</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;">Codigo</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;">Producto</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;">Concentracion</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;">Marca</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;">Presentacion</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;">Vencimiento</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;">Cantidad</td>
  </tr>
     @foreach ($productos_por_caducar as $productos)
   
    <tr>
        <td >{{ $loop->iteration }}</td>
        <td >{{ $productos->compra_fecha }}</td>
        <td >{{ $productos->tipo_movimiento }}</td>
        <td >{{ $productos->codigo }}</td>
        <td >{{ $productos->producto }}</td>
        <td >{{ $productos->concentracion }}</td>
        <td >{{ $productos->marca }}</td>
        <td >{{ $productos->presentacion }}</td>
        <td >{{ $productos->vencimiento }}</td>
        <td >{{ $productos->cantidad_total }}</td>
       
    </tr>
@endforeach

</tbody></table>
</html>
