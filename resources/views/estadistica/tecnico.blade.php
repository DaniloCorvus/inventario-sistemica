@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container container-fluid">

        <form action="{{route('estadistica.tecnico')}}" id="cargarEstadisticaForm" method="get">
            @csrf

            <div class="row w-100 my-3">

                <div class="col-md-8">
                    <select name="id" class=" form-control ">
                        <option>Seleccionar tecnico</option>
                        @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="col-md-6">
                    <input type="text" class="form-control" id="min" name="min" placeholder="De:"
                        onfocus="(this.type='date')">
                </div>

                <div class="col-md-6">
                    <input type="text" class="form-control" id="max" name="max" placeholder="Hasta:"
                        onfocus="(this.type='date')">
                </div> --}}


                <div class="col-md-4 ">
                    <button type="submit" class="btn btn-success">Buscar</button>
                </div>

            </div>
        </form>


        <div class="row w-100">
            <div class="col-md-4">
                <div class="card mx-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Informacion General </h5>
                    </div>

                    <ul class=" navbar-nav accordion mx-3" id="accordionEstadisticas">

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapsePendientes" aria-expanded="true"
                                aria-controls="collapsePendientes">
                                <i class="fa fa-check"></i>
                                <span>Reparaciones Pendientes<small
                                        class="float-right text text-danger">{{count($pendientes)}}</small></span>
                            </a>
                            <div id="collapsePendientes" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($pendientes as $pendiente)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <span><small class="float-right text text-danger"></small></span>
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$pendiente->id}}">
                                        <span>{{$pendiente->service . '  ' . $pendiente->razon->nombre }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseCancelados" aria-expanded="true"
                                aria-controls="collapseCancelados">
                                <i class="fa fa-check"></i>
                                <span>Reparaciones Canceladas<small
                                        class="float-right text text-danger">{{count($cancelados)}}</small></span>
                            </a>
                            <div id="collapseCancelados" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($cancelados as $cancelada)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <span><small class="float-right text text-danger"></small></span>
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$cancelada->id}}">
                                        <span>{{$cancelada->service . '  ' . $cancelada->razon->nombre }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseHappyNoEjecutados" aria-expanded="true"
                                aria-controls="collapseHappyNoEjecutados">
                                <i class="fa fa-check"></i>
                                <span>Happy call no Ejecutados <small
                                        class="float-right text text-danger">{{count($happyCallNoEjecutados)}}</small></span>
                            </a>
                            <div id="collapseHappyNoEjecutados" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($happyCallNoEjecutados as $happyCallNoEjecutado)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <span><small class="float-right text text-danger"></small></span>
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$happyCallNoEjecutado->id}}">
                                        <span>{{$happyCallNoEjecutado->service . '  ' . $happyCallNoEjecutado->razon->nombre }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mx-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Estadisticas Razones pendientes </h5>
                    </div>

                    <ul class=" navbar-nav accordion mx-3" id="accordionEstadisticas">

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseAceptadas" aria-expanded="true" aria-controls="collapseAceptadas">
                                <i class="fa fa-check"></i>
                                <span>Reparaciones Pendientes<small
                                        class="float-right text text-danger">{{count($aceptadas)}}</small></span>
                            </a>
                            <div id="collapseAceptadas" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($aceptadas as $aceptada)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <span><small class="float-right text text-danger"></small></span>
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$aceptada->id}}">
                                        <span>{{$aceptada->service . '  ' . $aceptada->razon->nombre }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseConcertadas" aria-expanded="true"
                                aria-controls="collapseConcertadas">
                                <i class="fa fa-check"></i>
                                <span>Primera visita concertada<small
                                        class="float-right text text-danger">{{count($concertadas)}}</small></span>
                            </a>
                            <div id="collapseConcertadas" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($concertadas as $concertada)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <span><small class="float-right text text-danger"></small></span>
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$concertada->id}}">
                                        <span>{{$concertada->service . '  ' . $concertada->razon->nombre }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseSolicitados" aria-expanded="true"
                                aria-controls="collapseSolicitados">
                                <i class="fa fa-check"></i>
                                <span>Los repuestos han sido solicitados<small
                                        class="float-right text text-danger">{{count($solicitados)}}</small></span>
                            </a>
                            <div id="collapseSolicitados" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($solicitados as $solicitado)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <span><small class="float-right text text-danger"></small></span>
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$solicitado->id}}">
                                        <span>{{$solicitado->service . '  ' . $solicitado->razon->nombre }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mx-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Estadisticas de reparacion finalizada </h5>
                    </div>

                    <ul class=" navbar-nav accordion mx-3" id="accordionEstadisticas">

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseterminadosMesActual" aria-expanded="true"
                                aria-controls="collapseterminadosMesActual">
                                <i class="fa fa-check"></i>
                                <span>Mes actual<small
                                        class="float-right text text-danger">{{count($terminadosMesActual)}}</small></span>
                            </a>
                            <div id="collapseterminadosMesActual" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($terminadosMesActual as $terminadosMesActuali)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <span><small class="float-right text text-danger"></small></span>
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$terminadosMesActuali->id}}">
                                        <span>{{$terminadosMesActuali->service . '  ' . $terminadosMesActuali->razon->nombre }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseterminadosMesAnterior" aria-expanded="true"
                                aria-controls="collapseterminadosMesAnterior">
                                <i class="fa fa-check"></i>
                                <span>Mes Anterior<small
                                        class="float-right text text-danger">{{count($terminadosMesAnterior)}}</small></span>
                            </a>
                            <div id="collapseterminadosMesAnterior" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($terminadosMesAnterior as $terminadosMesAnteriori)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <span><small class="float-right text text-danger"></small></span>
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$terminadosMesAnteriori->id}}">
                                        <span>{{$terminadosMesAnteriori->service . '  ' . $terminadosMesAnteriori->razon->nombre }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseTerminadosHoy" aria-expanded="true"
                                aria-controls="collapseTerminadosHoy">
                                <i class="fa fa-check"></i>
                                <span>Hoy<small
                                        class="float-right text text-danger">{{count($terminadosHoy)}}</small></span>
                            </a>
                            <div id="collapseTerminadosHoy" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($terminadosHoy as $terminadosHoyi)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <span><small class="float-right text text-danger"></small></span>
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$terminadosHoyi->id}}">
                                        <span>{{$terminadosHoyi->service . '  ' . $terminadosHoyi->razon->nombre }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseTerminadosAyer" aria-expanded="true"
                                aria-controls="collapseTerminadosAyer">
                                <i class="fa fa-check"></i>
                                <span>Ayer<small
                                        class="float-right text text-danger">{{count($terminadosAyer)}}</small></span>
                            </a>
                            <div id="collapseTerminadosAyer" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($terminadosAyer as $terminadosAyeri)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <span><small class="float-right text text-danger"></small></span>
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$terminadosAyeri->id}}">
                                        <span>{{$terminadosAyeri->service . '  ' . $terminadosAyeri->razon->nombre }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </li>

                    </ul>
                </div>
            </div>



            <div class="col-md-4">
                <div class="card mx-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Tiempos promedios Mes Anterior</h5>
                    </div>

                    <ul class=" navbar-nav accordion mx-3" id="accordionEstadisticas">

                        <li class="nav-item">

                            @foreach ($razones as $razon)
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapsePromedios{{$razon->id}}" aria-expanded="true"
                                aria-controls="collapsePromedios{{$razon->id}}">
                                <i class="fa fa-check"></i>
                                <span>{{$razon->nombre}}<small class="float-right text text-danger">

                                        @php

                                        $cc[$razon->nombre] = 0;
                                        foreach ($servicios as $servicio){
                                        if ($servicio->razon->nombre == $razon->nombre){
                                        if ($servicio->fecha_finalizado == null){

                                        if (\Carbon\Carbon::create($servicio->created_at)->month ==
                                        (\Carbon\Carbon::now()->month - 1)) {
                                        $cc[$razon->nombre] += 1;
                                        }
                                        }}}

                                        @endphp

                                        {{  $cc[$razon->nombre] }}

                                    </small></span>
                            </a>
                            <div id="collapsePromedios{{$razon->id}}" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($servicios as $servicio)
                                @if ($servicio->razon->nombre == $razon->nombre)
                                @if ($servicio->fecha_finalizado == null)
                                @if (\Carbon\Carbon::create($servicio->created_at)->month ==
                                \Carbon\Carbon::now()->month -1)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="http://gestion-servicio-tecnico.operacionsistemica.com/service?query={{$servicio->id}}">
                                        <span>{{$servicio->service . '  ' . $servicio->razon->nombre }}
                                            <small class="float-right text text-danger">
                                                {{ number_format((\Carbon\Carbon::create($servicio->created_at))
                                                ->floatDiffInDays(\Carbon\Carbon::now()), 1)}} Dias
                                            </small>
                                        </span>
                                    </a>
                                </div>
                                @endif
                                @endif
                                @endif
                                @endforeach
                            </div>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card mx-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Tiempos promedios Mes Actual</h5>
                    </div>

                    <ul class=" navbar-nav accordion mx-3" id="accordionEstadisticas">

                        <li class="nav-item">

                            @foreach ($razones as $razon)
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapsePromediosAct{{$razon->id}}" aria-expanded="true"
                                aria-controls="collapsePromediosAct{{$razon->id}}">
                                <i class="fa fa-check"></i>
                                <span>{{$razon->nombre}}<small class="float-right text text-danger">

                                        @php

                                        $cc[$razon->nombre] = 0;
                                        foreach ($servicios as $servicio){
                                        if ($servicio->razon->nombre == $razon->nombre){
                                        if ($servicio->fecha_finalizado == null){

                                        if (\Carbon\Carbon::create($servicio->created_at)->month ==
                                        \Carbon\Carbon::now()->month) {
                                        $cc[$razon->nombre] += 1;
                                        }
                                        }}}

                                        @endphp

                                        {{  $cc[$razon->nombre] }}

                                    </small></span>
                            </a>
                            <div id="collapsePromediosAct{{$razon->id}}" class="collapse" aria-labelledby="headingTable"
                                data-parent="#accordionEstadisticas">
                                @foreach ($servicios as $servicio)
                                @if ($servicio->razon->nombre == $razon->nombre)
                                @if ($servicio->fecha_finalizado == null)
                                @if (\Carbon\Carbon::create($servicio->created_at)->month ==
                                \Carbon\Carbon::now()->month)
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header"></h6>
                                    <a class="collapse-item"
                                        href="./service?query={{$servicio->id}}">
                                        <span>{{$servicio->service . '  ' . $servicio->razon->nombre }}
                                            <small class="float-right text text-danger">
                                                {{ number_format((\Carbon\Carbon::create($servicio->created_at))
                                                ->floatDiffInDays(\Carbon\Carbon::now()), 1)}} Dias
                                            </small>
                                        </span>
                                    </a>
                                </div>
                                @endif
                                @endif
                                @endif
                                @endforeach
                            </div>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>


            <div class="col-md-4 my-2">
                <div class="card mx-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Estadisticas de ingreso monetario </h5>
                    </div>

                    <ul class=" navbar-nav accordion mx-3" id="accordionEstadisticas">

                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseterminadosMesActualMonto" aria-expanded="true"
                                aria-controls="collapseterminadosMesActualMonto">
                                <i class="fa fa-check"></i>
                                <span>Acumulado mes Actual</span>
                                <br>
                                <h6 class="float-right text text-danger">
                                    ${{number_format($montoMesActual, 2, '.' , ',')}}</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseterminadosMesAnteriorMonto" aria-expanded="true"
                                aria-controls="collapseterminadosMesAnteriorMonto">
                                <i class="fa fa-check"></i>
                                <span>Mes pasado</span>
                                <br>
                                <h6 class="float-right text text-danger">
                                    ${{number_format($montoMesAnterior, 2, '.' , ',')}}</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed text text-dark" href="#" data-toggle="collapse"
                                data-target="#collapseterminadosMesAvgMonto" aria-expanded="true"
                                aria-controls="collapseterminadosMesAvgMonto">
                                <i class="fa fa-check"></i>
                                <span>Promedio Mensual</span>
                                <br>
                                <h6 class="float-right text text-danger">${{number_format($avg, 2, '.' , ',')}}</h6>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
        const cargarEstadisticaForm = document.getElementById('cargarEstadisticaForm');
        
        cargarEstadisticaForm.addEventListener('submit', () => {
            toastr.info('Estamos buscando ...');
        })
    </script>
    @endpush