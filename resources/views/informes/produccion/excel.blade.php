<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Informe De produccion</title>
    <style>
        h3 {
            text-align: center;
            text-transform: uppercase;
        }

        body {
            overflow: hidden;
            white-space: initial;
        }

        .contenido {
            font-size: 11px;
            box-sizing: content-box;
            width: 100%;
        }

        .header {
            box-sizing: content-box;
            width: 100%;
        }

        #primero {
            background-color: #ccc;
        }

        #segundo {
            color: #44a359;
        }

        #tercero {
            text-decoration: line-through;
        }

        td {
            align-content: center;
            text-align: center;
            justify-content: center;
        }
    </style>
</head>

<body>

    <table class="header">
        <tr>
            <td colspan="12">
                <h3>Mantenimiento Electronico </h3>
            </td>
        </tr>
        <tr>
            <td colspan="12">
                <h3>Barrancabermeja S.A.S </h3>
            </td>
        </tr>
        <tr>
            <td colspan="12">
                <h4>Nit: 900.924.129-1</h4>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <h5> Tecnico : {{$requestTecnico->name}}</h5>
            </td>
            <td colspan="6">
                <h5> Desde : {{$inicio}} Hasta {{$fin}}</h5>
            </td>
        </tr>

    </table>


    @php
    $aPagar = 0;
    $adicionales = 0;
    $mo = 0;
    $getMAnoObra = 0;
    $getAdds = 0;
    @endphp

    <table class="contenido">
        <thead class="">
            <tr>
                <th>COD</th>
                <th>Inicio</th>
                <th>Finalizado</th>
                <th>Marca</th>
                <th>Autorizado</th>
                <th>Tipo</th>
                <th>Modo</th>
                <th>Repuestos</th>
                <th>Tecnico</th>
                <th>Adicionales</th>
                <th>Pago</th>
                <th>C. Cliente</th>

            </tr>
        </thead>

        <tbody>
            @if (isset($servicios))

            @foreach ($servicios as $servicio)
            <tr>
                <td style="font-size: 12px">{{$servicio->service}}</td>
                <td style="font-size: 12px">{{str_replace('-','/',$servicio->fecha_inicio)}}</td>
                <td style="font-size: 12px">{{str_replace('-', '/', $servicio->fecha_finalizado)}}</td>
                <td style="font-size: 12px">{{$servicio->equipo->marka->nombre}}</td>
                <td style="font-size: 12px">{{number_format($servicio->valor_aprobado, 0,'.',',')}}</td>
                <td style="font-size: 12px">{{$servicio->tipo->nombre}}</td>
                <td style="font-size: 12px">{{$servicio->modo->nombre}}</td>
                <td style="font-size: 12px">{{number_format($servicio->getRepuestos($servicio->id), 0, '.', ',')}}</td>
                <td style="font-size: 12px">{{number_format($servicio->getMAnoObra($requestTecnico), 0, '.', ',')}}</td>
                <td style="font-size: 12px">{{number_format($servicio->getAdds($requestTecnico), 0, '.', ',')}}</td>

                @php
                $aPagar += $servicio->getApagar($requestTecnico);
                $getMAnoObra += $servicio->getMAnoObra($requestTecnico);
                $getAdds += $servicio->getAdds($requestTecnico);
                @endphp

                <td style="font-size: 12px">{{number_format($servicio->getApagar($requestTecnico), 0, '.', ',')}}</td>
                <td>{{number_format($servicio->valor_cargo_cliente, 0,'.',',')}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>

    </table>

    <table class="contenido" style="margin-top: 80px">
        <tr>
            <td colspan="2" style="font-size: 14px">
                Cantidad: {{$servicios->count()}}
            </td>
        </tr>
        <tr>

            <td style="font-size: 14px">M.O : {{number_format($getMAnoObra , 0,'.',',')}}</td>

            <td style="font-size: 14px">
                <div>Adicionales : {{number_format($getAdds, 0 ,'.',',')}}</div>
            </td>

        </tr>
        <tr>
            <td style="font-size: 14px" colspan="2">
                <div> A pagar: {{number_format($aPagar , 0 ,'.',',')}}</div>
            </td>
        </tr>
    </table>

</body>

</html>