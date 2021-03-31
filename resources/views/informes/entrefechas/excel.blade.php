<div class="table-responsive p-3">
    <table style="font-size: 0.8rem" class="table align-items-center table-flush table-hover text-dark"
        id="dataTableServicesInforme">
        <thead class="">
            <tr>
                <th>COD</th>
                <th>Radicado</th>
                <th>Razon Pendiente</th>
                <th class="fecha">Recepcion</th>
                <th>Tecnico</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Serie</th>
                <th>Cliente</th>
                <th>ID</th>
                <th>Direccion</th>
                <th>Estado</th>
                <th>Tipo</th>
                <th>Modo</th>
                <th>Autorizado</th>
                <th>Promesa</th>
                <th>Reparado</th>
                <th>Finalizado</th>
                <th>Reporte</th>
                <th>Mano de Obra</th>
                <th>Adicional</th>
                <th>Gastos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
            <tr>
                <td style="word-wrap:break-word">{{$servicio->service}}</td>
                <td style="word-wrap:break-word">{{$servicio->radicado}}</td>
                <td style="word-wrap:break-word">{{$servicio->razon->nombre}}</td>
                <td style="word-wrap:break-word">{{$servicio->created_at}}</td>
                <td style="word-wrap:break-word">
                    <ul>
                        @foreach ($servicio->users()->get() as $usuario)
                        <li>
                            {{''.$usuario->name . '  %  ' .$usuario->pivot->percent}}
                        </li>
                        @endforeach
                    </ul>
                </td>
                <td style="word-wrap:break-word">{{$servicio->equipo->modelo}}</td>
                <td style="word-wrap:break-word">{{$servicio->equipo->marka->nombre}}</td>
                <td style="word-wrap:break-word">{{$servicio->equipo->serie}}</td>
                <td style="word-wrap:break-word">{{$servicio->cliente->fullname}}</td>
                <td style="word-wrap:break-word">{{$servicio->cliente->identificacion}}</td>
                <td style="word-wrap:break-word">{{$servicio->cliente->direccion}}</td>
                <td style="word-wrap:break-word">{{$servicio->estado->nombre}}</td>
                <td style="word-wrap:break-word">{{$servicio->tipo->nombre}}</td>
                <td style="word-wrap:break-word">{{$servicio->modo->nombre}}</td>
                <td style="word-wrap:break-word">{{$servicio->fecha_autorizado}}</td>
                <td style="word-wrap:break-word">{{$servicio->fecha_promesa}}</td>
                <td style="word-wrap:break-word">{{$servicio->fecha_reparado}}</td>
                <td style="word-wrap:break-word">{{$servicio->fecha_finalizado}}</td>
                <td style="word-wrap:break-word">{{$servicio->reporte}}</td>
                <td style="word-wrap:break-word">{{$servicio->valor_obra}}</td>
                <td style="word-wrap:break-word">{{$servicio->getAdicionales($servicio->id)}}</td>
                <td style="word-wrap:break-word">{{$servicio->getGastos($servicio->id)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>