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
            width: 70mm;
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
            font-size: 9pt;
            border-collapse: collapse;
            border-top: 1px dashed black;
            border-bottom: 1px dashed black;
        }

        .tbl-detalle thead th {
            padding-top: 3px;
            padding-bottom: 3px;
            padding-left: 2px;
            padding-right: 2px;
            text-align: right;
            border-bottom: 1px dashed black;
        }

        .tbl-detalle tbody td {
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 0px;
            text-align: right;
        }

        .tbl-detalle-precio {
            width: 100%;
            font-size: 9pt;
            border-collapse: collapse;
            font-weight: bold;
        }

        .tbl-detalle-precio tbody td {
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 0px;
            text-align: right;
        }

        .tbl-footer {
            width: 100%;
            border-collapse: collapse;
        }

        .tbl-footer tbody td {
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 0px;
            text-align: center;
        }
    </style>
</head>

<body>
    <table class="center">
        <tr>
            <td>
                <img src="{{ asset('images/logoFioriN.png') }}" alt="" height="80px">
            </td>
        </tr>
    </table>
    <table class="tbl-head">
        <thead>
            <tr>
                <th>RECIBO</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Av. Luis Guardia y Av. Ballivián # 802</td>
            </tr>
            <tr>
                <td>Zona Primero de Mayo - El Alto</td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;">Tel/WhatsApp: 69425555</td>
            </tr>
        </tbody>
    </table>

    <table class="tbl-info">
        <tr>
            <th style="padding-top: 5px;">N°:</th>
            <td style="padding-top: 5px;">000001</td>
        </tr>
        <tr>
            <th>NOMBRE:</th>
            <td>JOSE ANTONIO SAAVEDRA DE LA ZAGARNAGA BEIZAGA</td>
        </tr>
        <tr>
            <th>FECHA EMISIÓN:</th>
            <td>21/05/2025 09:16 AM</td>
        </tr>
        <tr>
            <th>TIPO PAGO:</th>
            <td>21/05/2025 09:16 AM</td>
        </tr>
        <tr>
            <th style="padding-bottom: 5px;"></th>
            <td style="text-align: right; padding-bottom: 5px;">BC4449</td>
        </tr>
    </table>

    <table class="tbl-detalle">
        <thead>
            <tr>
                <th style="width: 45%; text-align: center;">DETALLE</th>
                <th style="width: 10%;">CANT</th>
                <th style="width: 20%;">PRECIO</th>
                <th style="width: 25%;">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: left;">AGUA PARA INYECCION 5ML</td>
                <td>50</td>
                <td>500,60</td>
                <td>500,60</td>
            </tr>
            <tr>
                <td style="text-align: left;">ALCOHOL MEDICINAL 70% 1L</td>
                <td>100</td>
                <td>500,60</td>
                <td>500,60</td>
            </tr>
        </tbody>
    </table>
    <table class="tbl-detalle-precio">
        <tbody>
            <tr>
                <td style="width: 45%; padding-top: 5px;"></td>
                <td style="width: 30%; padding-top: 5px;">EFECTIVO BS.:</td>
                <td style="width: 25%; padding-top: 5px;">500,60</td>
            </tr>
            <tr>
                <td style="width: 45%;"></td>
                <td style="width: 30%;">QR BS.:</td>
                <td style="width: 25%;">500,60</td>
            </tr>
            <tr>
                <td style="width: 45%;"></td>
                <td style="width: 30%; border-bottom: 1px dashed black;">TOTAL BS.:</td>
                <td style="width: 25%; border-bottom: 1px dashed black;">500,60</td>
            </tr>
        </tbody>
    </table>

    <table class="tbl-footer">
        <tbody>
            <tr>
                <td style="padding-top: 15px;">GRACIAS POR SU COMPRA</td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;">NO VALIDO PARA CREDITO FISCAL</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
