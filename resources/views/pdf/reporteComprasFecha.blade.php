<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Compras </title>
  <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-vv8g{background-color:#efefef;border-color:#000000;color:#000000;font-family:"Times New Roman", Times, serif !important;
  font-size:12px;text-align:right;vertical-align:top}
.tg .tg-7t53{background-color:#ffffff;border-color:#ffffff;font-family:"Times New Roman", Times, serif !important;font-size:11px;
  text-align:right;vertical-align:top}
.tg .tg-44ti{background-color:#efefef;border-color:#000000;color:#000000;font-family:"Times New Roman", Times, serif !important;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top}
.tg .tg-6ccv{background-color:#2899f3;border-color:#c0c0c0;color:#ffffff;font-family:"Times New Roman", Times, serif !important;
  font-size:12px;font-weight:bold;text-align:left;vertical-align:top}
.tg .tg-a9mw{border-color:#ffffff;font-family:serif !important;text-align:left;vertical-align:top}
.tg .tg-o20t{border-color:#ffffff;font-family:serif !important;font-size:20px;text-align:center;vertical-align:top}
.tg .tg-o20t1{border-color:#ffffff;font-family:serif !important;font-size:16px;text-align:center;vertical-align:top}
.tg .tg-6c9e{background-color:#ffffff;border-color:#ffffff;font-family:"Times New Roman", Times, serif !important;font-size:11px;
  text-align:left;vertical-align:top}
.tg .tg-rcbp{background-color:#dae8fc;border-color:#ffffff;font-family:"Times New Roman", Times, serif !important;font-size:11px;
  text-align:left;vertical-align:top}
.tg .tg-o9xn{background-color:#efefef;border-color:#000000;color:#000000;font-family:"Times New Roman", Times, serif !important;
font-size:12px;text-align:left;vertical-align:top}
  .tg .tg-o9xn1{background-color:#fff;border-left-color:#fff;border-right-color:#fff;color:#fff;font-family:"Times New Roman", Times, serif !important;
  font-size:12px;text-align:left;vertical-align:top}
</style>
<table class="tg"><thead>
  <tr>
    <th class="tg-a9mw" colspan="3"></th>
    <th class="tg-a9mw"></th>
    <th class="tg-a9mw"></th>
    <th class="tg-a9mw"></th>
    <th class="tg-a9mw" colspan="4"></th>
  </tr></thead>
<tbody>
  <tr>
    <td class="tg-o20t" colspan="14"><b>INFORME DE COMPRAS</b></td>
  </tr>
  <tr>
    <tr>
    <td class="tg-o20t1" colspan="14">de  {{$fecha_inicio}} al {{$fecha_fin}}<br><b>Tipo Movimiento </b>{{$tipo_movimiento}}</td>
  </tr>
  </tr>
  <tr>
    <td class="tg-6ccv">Nro.</td>
    <td class="tg-6ccv">Fecha</td>
    <td class="tg-6ccv">Nro. Compra</td>
    <td class="tg-6ccv">Proveedor</td>
    <td class="tg-6ccv">Codigo</td>
    <td class="tg-6ccv">Producto</td>
    <td class="tg-6ccv">Tipo</td>
    <td class="tg-6ccv">Concentracion</td>
    <td class="tg-6ccv">Marca</td>
    <td class="tg-6ccv">Presentacion</td>
    <td class="tg-6ccv">Vencimiento</td>
    
    <td class="tg-6ccv">Cantidad</td>
    <td class="tg-6ccv">Precio</td>
    <td class="tg-6ccv">Sub Total</td>
  </tr>
  @foreach ($compras as $compra)
    <tr>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $loop->iteration }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->compra_fecha }}</td>        
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->numero_compra }}</td>
         <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->proveedor }}</td>         
         <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->codigo }}</td>
         <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->producto }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->tipo }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->concentracion }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->marca }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->presentacion }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->vencimiento }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->cantidad }}</td>
        <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->precio_unitario }}</td>
         <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $compra->subtotal }}</td>
       
    </tr>
@endforeach
   <tr>
    <td class="tg-o9xn1" colspan="12"></td>
  
  </tr>
  <tr>
    <td class="tg-o9xn" colspan="12"></td>
    <td class="tg-44ti">Total</td>
    <td class="tg-vv8g">{{ $total }}</td>
  </tr>
</tbody></table>
</html>
