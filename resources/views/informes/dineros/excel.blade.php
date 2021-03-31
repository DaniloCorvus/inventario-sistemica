<div>
    <table style="font-size: 0.8rem">
        <thead class="">
            <tr>
                <th width="20px" style="width: 20px">Fecha de recepción</th>
                <th width="20px" style="width: 20px">Hora</th>
                <th width="20px" style="width: 20px">Cod</th>
                <th width="20px" style="width: 20px">Receptor</th>
                <th width="20px" style="width: 20px">Monto recibido</th>
                <th width="20px" style="width: 20px">Medio de pago</th>
                <th width="20px" style="width: 20px">Observacion</th>
                <th width="20px" style="width: 20px">Total cargo cliente</th>
                <th width="20px" style="width: 20px">Total cargo fabrica</th>
                <th width="20px" style="width: 20px">Dinero total recibido</th>
                <th width="20px" style="width: 20px">Dinero pendiente de pago</th>

            </tr>
        </thead>
        <tbody style="background: #c4c4c4; color: red">
            @if (isset($dineros))
            @foreach ($dineros as $dinero)
            <input type="hidden" name="" value="{{$servicio = $dinero->searhService($dinero->service_id)}}">
            <tr style="background-color: #c4c4c4; color: red">
                <td style="word-wrap:break-word">{{''.$dinero->fecha}}</td>
                <td style="word-wrap:break-word">{{''.$dinero->hora}}</td>
                <td style="word-wrap:break-word">{{'GA-'.$servicio->id}}</td>
                <td style="word-wrap:break-word">{{''.$res =  (!empty($dinero->user->name)) ? $dinero->user->name : ""}}</td>
                <td style="word-wrap:break-word">{{''.$dinero->monto}}</td>
                <td style="word-wrap:break-word">{{''.$dinero->method_pay}}</td>
                <td style="word-wrap:break-word">{{''.$dinero->observacion}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->valor_cargo_cliente}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->valor_cargo_fabrica}}</td>
                <td style="word-wrap:break-word">{{''.$dinero->totalRecibido($servicio->id)}}</td>
                <td style="word-wrap:break-word">{{''.($servicio->valor_cargo_cliente - $dinero->totalRecibido($servicio->id))}}</td>
                @endforeach
                @endif
        </tbody>
    </table>
</div>