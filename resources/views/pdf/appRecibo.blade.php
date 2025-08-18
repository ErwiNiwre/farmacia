<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recibo</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 0;
            width: 100%;
            word-spacing: 1.5px;
            /* line-height: 1; */
        }

        .tbl-head {
            width: 100%;
            border-collapse: collapse;
            border-top: 1px dashed black;
            border-bottom: 1px dashed black;
        }

        .tbl-head thead th {
            padding-top: 10px;
            padding-bottom: 5px;
            padding-left: 0px;
            padding-right: 0px;
            text-align: center;
        }

        .tbl-head tbody td {
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 0px;
            text-align: center;
        }

        .tbl-info {
            width: 100%;
            border-collapse: collapse;
            /* border: 1px solid; */
        }

        .tbl-info th {
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 1px;
            text-align: right;
            width: 40%;
        }

        .tbl-info td {
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 5px;
            padding-right: 0px;
            text-align: justify;
            width: 60%;
        }

        .tbl-detalle {
            width: 100%;
            border-collapse: collapse;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        .tbl-detalle thead th {
            padding-top: 3px;
            padding-bottom: 3px;
            padding-left: 2px;
            padding-right: 2px;
            text-align: center;
            border-bottom: 1px solid black;
            border-right: 1px solid black;
            border-left: 1px solid black;
        }

        .tbl-detalle tbody td {
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 2px;
            padding-right: 2px;
            text-align: right;
            border-right: 1px solid black;
            border-left: 1px solid black;
        }

        .tbl-detalle-precio {
            width: 100%;
            border-collapse: collapse;
            font-weight: bold;
        }

        .tbl-detalle-precio tbody td {
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 2px;
            padding-right: 2px;
            text-align: right;
        }

        .tbl-detalle-precio tfoot td {
            padding-top: 2px;
            padding-bottom: 2px;
            padding-left: 2px;
            padding-right: 2px;
            text-align: left;
            font-weight: normal;

        }

        .tbl-footer {
            width: 100%;
            border-collapse: collapse;
        }

        .tbl-footer tbody td {
            padding-top: 0px;
            padding-bottom: 5px;
            padding-left: 0px;
            padding-right: 0px;
            text-align: right;
        }
    </style>
</head>

<body>
    <table class="center" style="width: 100%;">
        <tr>
            <td style="width: 10%;">
                <img src="{{ asset('images/logoFioriSolo.png') }}" alt="" height="100px">
            </td>
            <td style="width: 60%;">
                <table>
                    <thead>
                        <tr style="font-size: 12pt;">
                            <th>CENTRO MÉDICO FIORI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size: 9pt;">Av. Luis Guardia y Av. Ballivián # 802</td>
                        </tr>
                        <tr>
                            <td style="font-size: 9pt;">Zona Primero de Mayo - El Alto</td>
                        </tr>
                        <tr>
                            <td style="font-size: 9pt;">Tel/WhatsApp: 69425555</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 30%;">
                <table style="border: 1px solid black; width: 100%;">
                    <thead>
                        <tr>
                            <th colspan="2" style="padding-top: 5px; font-size: 12pt; color: red;">
                                {{ $id_recibo }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style="text-align: right">F. Registro:</th>
                            <td>{{ $compras->compra_fecha }}</td>
                        </tr>
                        <tr>
                            <th style="text-align: right">N° Recibo:</th>
                            <td>{{ $compras->numero_compra }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <table class="center" style="width: 100%;">
        <thead>
            <tr>
                <th style="font-size: 14pt;" colspan="4">COMPRA DE MERCADERÍA</th>
            </tr>
        </thead>
    </table>
    <table style="width: 100%; border: 1px solid black;">
        <tbody>
            <tr>
                <th style="text-align: right; width: 15%;">PROVEEDOR:</th>
                <td style="text-align: center; width: 85%;" colspan="3">{{ $compras->proveedor }}</td>
            </tr>
            <tr>
                <th style="text-align: right; width: 15%;">OBSERVACION:</th>
                <td style="text-align: center; width: 85%;" colspan="3">
                    {{ isset($compras->observacion) ? $compras->observacion : 'S/O' }}</td>
            </tr>
            <tr>
                <th style="text-align: right; width: 15%;">TIPO:</th>
                <td style="text-align: left; width: 35%;">{{ $compras->tipo }}</td>
                <th style="text-align: right; width: 15%;">USUARIO:</th>
                <td style="text-align: left; width: 35%;">{{ $compras->user_id }}</td>
            </tr>
        </tbody>
    </table>
    <div style="padding-top: 5px;"></div>
    <table class="tbl-detalle">
        <thead>
            <tr>
                <th style="width: 60%;">DETALLE</th>
                <th style="width: 10%;">CANT</th>
                <th style="width: 15%;">PRECIO</th>
                <th style="width: 15%;">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compra_detalles as $compra_detalle)
                <tr>
                    <td style="text-align: left;">{{ $compra_detalle->producto }}</td>
                    <td>{{ $compra_detalle->cantidad }}</td>
                    <td>{{ $compra_detalle->precio_unitario }}</td>
                    <td>{{ $compra_detalle->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="tbl-detalle-precio">
        <tbody>
            <tr>
                <td style="width: 70%; padding-top: 5px;" colspan="2"></td>
                <td style="width: 15%; padding-top: 5px;">SUBTOTAL BS.:</td>
                <td style="width: 15%; padding-top: 5px; border-bottom: 1px solid black;">
                    {{ number_format($compras->total ?? 0, 2, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td style="width: 70%;" colspan="2"></td>
                <td style="width: 15%;">TOTAL BS.:</td>
                <td style="width: 15%;">{{ $compras->total }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">{{ 'SON: ' . $totalLiteral }} </td>
            </tr>
        </tfoot>
    </table>
    <table class="tbl-footer">
        <tbody>
            <tr>
                <td style="width: 85%; ">F. Imp.:</td>
                <td style="width: 15%; ">{{ now()->format('d-m-Y') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
