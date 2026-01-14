<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-vv8g {
            background-color: #efefef;
            border-color: #000000;
            color: #000000;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12px;
            text-align: right;
            vertical-align: top
        }

        .tg .tg-7t53 {
            background-color: #ffffff;
            border-color: #ffffff;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12px;
            text-align: right;
            vertical-align: top
        }

        .tg .tg-44ti {
            background-color: #efefef;
            border-color: #000000;
            color: #000000;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12px;
            font-weight: bold;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-6ccv {
            background-color: #2899f3;
            border-color: #c0c0c0;
            color: #ffffff;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12px;
            font-weight: bold;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-a9mw {
            border-color: #ffffff;
            font-family: serif !important;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-o20t {
            border-color: #ffffff;
            font-family: serif !important;
            font-size: 20px;
            text-align: center;
            vertical-align: top;
            font-weight: bold;
        }

        .tg .tg-o20t1 {
            border-color: #ffffff;
            font-family: serif !important;
            font-size: 16px;
            text-align: center;
            vertical-align: top;
        }

        .tg .tg-6c9e {
            background-color: #ffffff;
            border-color: #ffffff;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12px;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-rcbp {
            background-color: #dae8fc;
            border-color: #ffffff;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12px;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-o9xn {
            background-color: #efefef;
            border-color: #000000;
            color: #000000;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12px;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-o9xn1 {
            background-color: #fff;
            border-left-color: #fff;
            border-right-color: #fff;
            color: #fff;
            font-family: "Times New Roman", Times, serif !important;
            font-size: 12px;
            text-align: left;
            vertical-align: top
        }
    </style>
    <table class="tg">
        <thead>
            <tr>
                <th class="tg-a9mw" colspan="3"></th>
                <th class="tg-a9mw"></th>
                <th class="tg-a9mw"></th>
                <th class="tg-a9mw"></th>
                <th class="tg-a9mw" colspan="4"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-o20t" colspan="10">INFORME DE VENTAS</td>
            </tr>
            <tr>
                <td class="tg-o20t1" colspan="10">de {{ $fecha_inicio }} al {{ $fecha_fin }}<br><b>Tipo Movimiento
                    </b>{{ $tipo_movimiento }}</td>
            </tr>
            <tr>
                <td class="tg-a9mw" colspan="10"></td>
            </tr>
            <tr>
                <td class="tg-6ccv">Nro.</td>
                <td class="tg-6ccv">Fecha</td>
                <td class="tg-6ccv">Nro. Venta</td>
                <td class="tg-6ccv">Cliente</td>
                <td class="tg-6ccv">Codigo</td>
                <td class="tg-6ccv">Producto</td>
                <td class="tg-6ccv">Tipo</td>
                <td class="tg-6ccv">Cantidad</td>
                <td class="tg-6ccv">Precio</td>
                <td class="tg-6ccv">Sub Total</td>
            </tr>
            @foreach ($ventas as $venta)
                <tr>
                    <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $loop->iteration }}</td>
                    <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $venta->venta_fecha }}</td>
                    <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $venta->numero_venta }}</td>
                    <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $venta->cliente }}</td>
                    <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $venta->codigo }}</td>
                    <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $venta->producto }}</td>
                    <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $venta->tipo_producto }}</td>
                    <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $venta->cantidad }}</td>
                    <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $venta->precio_unitario }}</td>
                    <td class="{{ $loop->odd ? 'tg-6c9e' : 'tg-rcbp' }}">{{ $venta->subtotal }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="tg-o9xn1" colspan="10"></td>
            </tr>
            <tr>
                <td class="tg-o9xn" colspan="8"></td>
                <td class="tg-44ti">Total</td>
                <td class="tg-vv8g">{{ $total }}</td>
            </tr>
        </tbody>
    </table>

</html>
