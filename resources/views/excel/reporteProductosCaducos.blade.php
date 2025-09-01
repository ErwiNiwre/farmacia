
    

<table ><thead>
  <tr>
    <th  colspan="3"></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th  colspan="3"></th>
  </tr></thead>
<tbody>
  <tr>
    <td style="border-color:#ffffff;font-family:serif !important;font-size:20px;text-align:center;vertical-align:top" colspan="9">PRODUCTOS CADUCADOS A FECHA {{ date('d-m-Y') }}</td>
  </tr>
  <tr>
    <td style="border-color:#ffffff;font-family:serif !important;font-size:14px;text-align:center;vertical-align:top"  colspan="9">Tipo Movimiento {{ $tipo_movimiento }}</td>
    
  </tr>
  <tr>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Nro.</td>
    <td  style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Fecha de Compra</td>
   <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Movimiento</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Codigo</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Producto</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Concentracion</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Marca</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Presentacion</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Vencimiento</td>
    <td style="background-color:#2899f3;border-color:#ffffff;color:#ffffff;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top">Cantidad</td>
  </tr>
 @foreach ($productos_vencidos as $productos_caducos)
   
    <tr>
        <td >{{ $loop->iteration }}</td>
        <td >{{ $productos_caducos->compra_fecha }}</td>
        
        <td >{{ $productos_caducos->tipo_movimiento }}</td>
        <td >{{ $productos_caducos->codigo }}</td>
        <td >{{ $productos_caducos->producto }}</td>
        <td >{{ $productos_caducos->concentracion }}</td>
        <td >{{ $productos_caducos->marca }}</td>
        <td >{{ $productos_caducos->presentacion }}</td>
        <td >{{ $productos_caducos->vencimiento }}</td>
        <td >{{ $productos_caducos->cantidad_total }}</td>
       
    </tr>
@endforeach
 
</tbody></table>
</html>
