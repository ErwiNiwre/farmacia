<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos Vendidos de {{$fecha_inicio}} a {{$fecha_fin}}< </title>
  <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-6ccv{background-color:#2899f3;border-color:#c0c0c0;color:#ffffff;font-family:"Times New Roman", Times, serif !important;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top}
.tg .tg-a9mw{border-color:#ffffff;font-family:serif !important;text-align:left;vertical-align:top}
.tg .tg-o20t{border-color:#ffffff;font-family:serif !important;font-size:20px;text-align:center;vertical-align:top}
.tg .tg-o20t1{border-color:#ffffff;font-family:serif !important;font-size:14px;text-align:center;vertical-align:top}
.tg .tg-6c9e{background-color:#ffffff;border-color:#ffffff;font-family:"Times New Roman", Times, serif !important;font-size:12px;
  text-align:left;vertical-align:top}
.tg .tg-rcbp{background-color:#dae8fc;border-color:#ffffff;font-family:"Times New Roman", Times, serif !important;font-size:12px;
  text-align:left;vertical-align:top}
</style>
<table class="tg" width=100%><thead>
  <tr>
    <th class="tg-a9mw" colspan="9"></th>
  </tr></thead>
<tbody>
  <tr>
    <td class="tg-o20t" colspan="9">PRODUCTOS MAS COMPRADOS</td>
  </tr>
  <tr>
    <td class="tg-o20t1" colspan="9">de  {{$fecha_inicio}} al {{$fecha_fin}}<br>Tipo Movimiento {{$tipo_movimiento}}</td>
  </tr>
  <tr>
    <td class="tg-a9mw" colspan="9"></td>
  </tr>
  <tr>
    <td class="tg-6ccv">Nro.</td>
    <td class="tg-6ccv">Proveedor</td>
    <td class="tg-6ccv">Codigo</td>
    <td class="tg-6ccv">Producto</td>
    <td class="tg-6ccv">Concentracion</td>
    <td class="tg-6ccv">Marca</td>
    <td class="tg-6ccv">Presentacion</td>
    <td class="tg-6ccv">Movimiento</td>
    <td class="tg-6ccv">Cantidad</td>
  </tr>
  @foreach ($productosComprados as $productos)
   
    <tr>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $loop->iteration }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos->proveedor }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos->codigo }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos->producto }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos->concentracion }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos->marca }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos->presentacion }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos->tipo_movimiento }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $productos->cantidad_total }}</td>
       
    </tr>
@endforeach
 
</tbody></table>
</html>
