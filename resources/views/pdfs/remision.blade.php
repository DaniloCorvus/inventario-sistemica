<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <title>Remision {{\Carbon\Carbon::now()}}</title> --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/css/main.css')}}"> --}}
</head>

<body>

    <title>Certificado de Remisiòn</title>
    <style>
        #invoice {
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
          margin-top: -100px;
            font-size: 1.5em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #3989c6;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }
    </style>

    <div id="invoice">

        <div class="toolbar hidden-print">

            <hr>
        </div>
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <a target="_blank" href="#">
                                <img src="data:image/png;base64,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"
                                    data-holder-rendered="true" style="height: 3em" />
                            </a>
                        </div>
                        <div class="col company-details">
                            <h2 class="name">
                                <a target="_blank" href="#">
                                    Operación Sistemica
                                </a>
                            </h2>
                            <div>Isla del Zapato, Barrancabermeja, Colombia</div>
                            <div>3172603279</div>
                            <div>Gerencia@operacionsistemica.com</div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">Remision a:</div>
                            <h2 class="to">{{$cliente->nombre}} {{$cliente->apellido}}</h2>
                            <div class="address">{{$cliente->direccion}}</div>
                            <div class="email"><a href="#">{{$cliente->email}}</a></div>
                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">Remision {{$venta->id}}</h1>
                            <div class="date">{{\Carbon\Carbon::now()}}</div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 30px">
                        <thead>
                   
                            <tr >
                                <th>#</th>
                                <th class="text-left">Descripcion</th>
                                <th class="text-left">Modelo</th>
                                <th class="text-left">Serie</th>
                                <th class="text-right">Cantidad</th>
                                <th class="text-right">Precio</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                       
                        </thead>
                        <tbody>
                            @foreach ($detalles  as $key => $detalle)
                                <tr >
                                <td class="no">{{$key + 1}}</td>
                                    <td class="text-left">{{$detalle->inventario->producto->descripcion}}</td>
                                    <td class="text-left">{{$detalle->inventario->producto->modelo}}</td>
                                    <td class="text-left">{{$detalle->inventario->serie}}</td>
                                    <td class="unit">{{$detalle->cantidad}}</td>
                                    <td class="qty">${{$detalle->precio}}</td>
                                    <td class="total">${{$detalle->precio  * $detalle->cantidad}}</td>
                                </tr>
                            @endforeach;
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="3">SUBTOTAL</td>
                                <td>${$venta->total_bruto}}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="3">Impuestos {{$venta->impuesto}} %</td>
                                <td>${{ ( $venta->impuesto *  $venta->total_bruto ) / 100  }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="3">TOTAL</td>
                                <td>${{$venta->total}}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="thanks">Gracias por tu compra</div>
                    <div class="notices">
                        <div>Nota:</div>
                        <div class="notice">Cualquier reclamo habil detro de los siguientes 30 dias presente este
                            documento.
                        </div>
                    </div>
                </main>
                <footer>
                    Este documento fùe generado por software Operacion Sistemica.
                </footer>
            </div>
            <div></div>
        </div>

</body>

</html>