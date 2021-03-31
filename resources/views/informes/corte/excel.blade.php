<div>
    <table style="font-size: 0.8rem">
        <thead class="">
            <tr>
                <th width="20px" style="width: 20px">COD</th>
                <th width="20px" style="width: 20px">Radicado</th>
                <th width="20px" style="width: 20px">Nombre</th>
                <th width="20px" style="width: 20px">Apellido</th>
                <th width="20px" style="width: 20px">Cedula</th>
                <th width="20px" style="width: 20px">Ciudad</th>
                <th width="20px" style="width: 20px">Direccion</th>
                <th width="20px" style="width: 20px">Telefono</th>
                <th width="20px" style="width: 20px">Marca</th>
                <th width="20px" style="width: 20px">Modo</th>
                <th width="20px" style="width: 20px">Egar</th>
                <th width="20px" style="width: 20px">Almacen</th>
                <th width="20px" style="width: 20px">Factura</th>
                <th width="20px" style="width: 20px">Modelo</th>
                <th width="20px" style="width: 20px">Serie</th>
                <th width="20px" style="width: 20px">Fecha Compra</th>
                <th width="20px" style="width: 20px">Fecha Ingreso</th>
                <th width="20px" style="width: 20px">Fecha Reparado</th>
                <th width="20px" style="width: 20px">Fecha Entrega</th>
                <th>Reporte Tecnico</th>
                <th>Tecnico</th>
                <th>Mano Obra</th>
                <th>Costo Visita</th>
                <th>Adicionales</th>
                <th>Mes</th>
                <th>Año</th>
                <th>Estado WEB</th>
                <th>Aproval Amount</th>
                <th>Reporte financiero</th>
                <th>Confirmacion</th>
                <th>Delivery </th>
                <th>Factura </th>
                <th>Nº Parte </th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Costo A iva</th>

            </tr>
        </thead>
        <tbody style="background: #c4c4c4; color: red">
            @if (isset($servicios))
            @foreach ($servicios as $servicio)
            <tr style="background-color: #c4c4c4; color: red">
                <td style="word-wrap:break-word">{{''.$servicio->id}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->radicado}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->cliente->nombre}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->cliente->apellido}}</td>
                <td style="word-wrap:break-word">{{'#'.''.$servicio->cliente->identificacion}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->cliente->ciudad}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->cliente->direccion}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->cliente->telefono}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->equipo->marka->nombre}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->modo->nombre}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->tipo->nombre}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->equipo->procedencia}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->equipo->num_factura}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->equipo->modelo}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->equipo->serie}}</td>
                <td style="word-wrap:break-word">{{''.$servicio->equipo->fecha_compra}}</td>
                <td style="word-wrap:break-word" class="fecha">{{''. $servicio->fecha_inicio}}</td>
                <td style="word-wrap:break-word" class="fecha">{{''. $servicio->fecha_reparado}}</td>
                <td style="word-wrap:break-word" class="fecha">{{''. $servicio->fecha_finalizado}}</td>
                <td style="word-wrap:break-word" width="50">{{$servicio->reporte}}</td>

                <td style="word-wrap:break-word">
                    <ul>
                        @foreach ($servicio->users()->get() as $usuario)
                        <li>
                            {{''.$usuario->name . '  %  ' .$usuario->pivot->percent}}
                        </li>
                        @endforeach
                    </ul>
                </td>
                <td style="word-wrap:break-word">{{''.$servicio->valor_obra}}</td>
                <td style="word-wrap:break-word">0</td>
                <td style="word-wrap:break-word">{{$servicio->getAdicionales($servicio->id)}}</td>
                <td style="word-wrap:break-word"></td>
                <td style="word-wrap:break-word"></td>
                <td style="word-wrap:break-word">Proceso</td>
                <td style="word-wrap:break-word"></td>
                <td style="word-wrap:break-word"></td>

                <table>

                    @foreach ($servicio->getRepuestosAll($servicio->id) as $accesorios)
                    @foreach ($accesorios as $accesorio)
                    <input type="hidden" name="" value="{{$result = $accesorio->getRepuesto($accesorio->repuesto_id)}}">
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td style="background: #76beee">
                            {{ ' '. $result->confirmacion}}

                        <td> {{' '.$result->delivery_orden}}</td>

                        <td>{{' '.$result->num_factura}}</td>

                        <td>{{' '.$result->num_parte}}</td>

                        <td> {{' '.$result->descripcion}}</td>

                        <td>{{' '.$result->cantidad}}</td>

                        <td>{{' '.$result->valor_before_iva}}
                        </td>
                    </tr>
                    @endforeach

                    @endforeach
                </table>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>