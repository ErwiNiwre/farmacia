

<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos Caducados < </title>
 <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-3dyu{background-color:#dae8fc;border-color:#ffffff;text-align:left;vertical-align:top}
.tg .tg-zv4m{border-color:#ffffff;text-align:left;vertical-align:top}
.tg .tg-agsl{background-color:#2899f3;border-color:#ffffff;color:#ffffff;font-family:"Times New Roman", Times, serif !important;
  font-size:12px;text-align:left;vertical-align:top}
.tg .tg-a9mw{border-color:#ffffff;font-family:serif !important;text-align:left;vertical-align:top}
.tg .tg-o20t{border-color:#ffffff;font-family:serif !important;font-size:20px;text-align:center;vertical-align:top}
.tg .tg-16fe{background-color:#2899f3;border-color:#ffffff;color:#ffffff;font-family:"Times New Roman", Times, serif !important;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top}
.tg .tg-6c9e{background-color:#ffffff;border-color:#ffffff;font-family:"Times New Roman", Times, serif !important;font-size:12px;
  text-align:left;vertical-align:top}
.tg .tg-rcbp{background-color:#dae8fc;border-color:#ffffff;font-family:"Times New Roman", Times, serif !important;font-size:12px;
  text-align:left;vertical-align:top}
</style>
<table class="tg"><thead>
  <tr>
    <th class="tg-a9mw" colspan="3"></th>
    <th class="tg-a9mw"></th>
    <th class="tg-a9mw"></th>
    <th class="tg-a9mw"></th>
    <th class="tg-a9mw" colspan="3"></th>
  </tr></thead>
<tbody>
  <tr>
    <td class="tg-o20t" colspan="9">PRODUCTOS CADUCADOS A FECHA {{ date('d-m-Y') }}</td>
  </tr>
  <tr>
    <td class="tg-a9mw"> </td>
    <td class="tg-zv4m" colspan="8"></td>
  </tr>
  <tr>
    <td class="tg-16fe">Nro.</td>
    <td class="tg-16fe">Fecha de Compra</td>
    <td class="tg-16fe">Movimiento</td>
    <td class="tg-16fe">Codigo</td>
    <td class="tg-16fe">Producto</td>
    <td class="tg-16fe">Concentracion</td>
    <td class="tg-16fe">Marca</td>
    <td class="tg-16fe">Presentacion</td>
    <td class="tg-16fe">Vencimiento</td>
    <td class="tg-16fe">Cantidad</td>
  </tr>
   @foreach ($productos_vencidos as $productos_caducos)
   
    <tr>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $loop->iteration }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos_caducos->compra_fecha }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos_caducos->tipo_movimiento }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos_caducos->codigo }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos_caducos->producto }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos_caducos->concentracion }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos_caducos->marca }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos_caducos->presentacion }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos_caducos->vencimiento }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos_caducos->cantidad_total }}</td>
       
    </tr>
@endforeach

</tbody></table>
</html>
