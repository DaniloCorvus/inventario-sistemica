<div>
    <table style="font-size: 0.8rem">
        <thead class="">
            <tr>
                <th width="20px" style="width: 20px">Cod</th>
                <th width="20px" style="width: 20px">Fecha ingreso</th>
                <th width="20px" style="width: 20px">Fecha Reparado</th>
                <th width="20px" style="width: 20px">Fecha Entrega</th>
                <th width="20px" style="width: 20px">Modo Servicio</th>
                <th width="20px" style="width: 20px">Tipo Servicio</th>
                <th width="20px" style="width: 20px">Tipo producto</th>
                <th width="20px" style="width: 20px">Marca</th>
                <th width="20px" style="width: 20px">Modelo</th>
                <th width="20px" style="width: 20px">Serie</th>
                <th width="20px" style="width: 20px">Reporte Tecnico</th>
                <th width="20px" style="width: 20px">Ubicacion</th>
                <th width="20px" style="width: 20px">Dinero recibido</th>
                <th width="20px" style="width: 20px">Valor autorizado</th>
                <th width="20px" style="width: 20px">Dinero pendiente</th>


            </tr>
        </thead>
        <tbody style="background: #c4c4c4;">
            @if (isset($salidas))
            @foreach ($salidas as $salida)
            <tr style="background-color: #c4c4c4;">
                <td style="word-wrap:break-word">{{'GA-'.$salida->id}}</td>
                <td style="word-wrap:break-word">{{''.$salida->fecha_inicio}}</td>
                <td style="word-wrap:break-word">{{''.$salida->fecha_reparado}}</td>
                <td style="word-wrap:break-word">{{''.$salida->fecha_finalizado}}</td>
                <td style="word-wrap:break-word">{{''.$salida->modo->nombre}}</td>
                <td style="word-wrap:break-word">{{''.$salida->tipo->nombre}}</td>
                <td style="word-wrap:break-word">{{''.$salida->equipo->producto->nombre}}</td>
                <td style="word-wrap:break-word">{{''.$salida->equipo->marka->nombre}}</td>
                <td style="word-wrap:break-word">{{''.$salida->equipo->modelo}}</td>
                <td style="word-wrap:break-word">{{''.$salida->equipo->serie}}</td>
                <td style="word-wrap:break-word">{{''.$salida->reporte}}</td>
                <td style="word-wrap:break-word">{{''.$salida->equipo->observacion}}</td>
                <td style="word-wrap:break-word">{{''.$salida->totalRecibido($salida->id)}}</td>
                <td style="word-wrap:break-word">{{''.$salida->valor_cargo_cliente}}</td>
                <td style="word-wrap:break-word">
                    {{''.($salida->valor_cargo_cliente - $salida->totalRecibido($salida->id))}}</td>
                @endforeach
                @endif
        </tbody>
    </table>
</div>