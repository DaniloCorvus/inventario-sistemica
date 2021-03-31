@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row">
@can('get', \App\User::class)
    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1" title=""
            data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>

        <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle btn-primary mr-1" data-toggle="modal"
            data-placement="top" data-target="#modalServiceRegister" title="Registrar  Servicio">
            <i class="fa fa-fw fa-plus"></i>
        </a>

        <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle btn-warning mr-1" data-toggle="modal"
            data-placement="top" data-target="#modalEquipoRegisterEquipoServicio" title="Registrar Equipo, Servicio">
            <i class="fa fa-fw fa-plus"></i>
        </a>

    </div>
     @endcan

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            @can('get', \App\User::class)
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">


                    <a class="primary" href="{{route('services.index')}}">Servicios <i class="fa fa-fw fa-eye"></i> Ver
                        todos</a>

                </h6>
            </div>

            <form action="{{route('query.busqueda')}}" id="customsearch" method="get" autocomplete="off">
                @csrf
                <div class="row m-3">
                    <div class="col-md-6">

                        <select name="columna" class="form-control">
                            <option value="id">COD</option>
                            <option value="radicado">Radicado</option>
                            <option value="razon">Razon Pendiente</option>
                            <option value="modelo">Modelo</option>
                            <option value="marca">Marca</option>
                            <option value="serie">Serie</option>
                            <option value="identificacion">Identificacion Cliente </option>
                            <option value="estado">Estado</option>
                            <option value="tipo">Tipo servicio</option>
                            <option value="modo">Modo servicio</option>
                            <option value="tecnico">Tecnico</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="filter" placeholder="Buscar...">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-small btn-primary mt-2"> Buscar </button>
                    </div>
                </div>
            </form>
            @endcan

            <div class="table-responsive p-3">
                <table style="font-size: 0.8rem" class="table align-items-center table-flush table-hover text-dark"
                    id="dataTableServices">
                    <thead class="">
                        <tr>
                            <th style="cursor: pointer">COD</th>
                            <th style="cursor: pointer">Radicado</th>
                            <th style="cursor: pointer">Razon Pendiente</th>
                            <th style="cursor: pointer" class="fecha">Fecha recepcion</th>
                            <th style="cursor: pointer">Tecnico</th>
                            <th style="cursor: pointer">Modelo</th>
                            <th style="cursor: pointer">Marca</th>
                            <th style="cursor: pointer">Serie</th>
                            <th style="cursor: pointer">Nombre Cliente</th>
                            <th style="cursor: pointer">ID</th>
                            <th style="cursor: pointer">Direccion Cliente</th>
                            <th style="cursor: pointer">Estado</th>
                            <th style="cursor: pointer">Tipo servicio</th>
                            <th style="cursor: pointer">Modo servicio</th>
                            <th style="cursor: pointer">Fecha finalizado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                        <tr>
                            <td>{{$service->service}}</td>
                            <td>{{$service->radicado}}</td>
                            <td @switch ($service->razon->id)
                                @case (1)
                                class= "red"
                                @break
                                @case (2)
                                class= 'pink'
                                @break
                                @case (3)
                                class= 'purple '
                                @break
                                @case (4)
                                class= 'dee'
                                @break
                                @case (5)
                                class= 'indigo'
                                @break
                                @case (6)
                                class= "blue"
                                @break
                                @case (7)
                                class= 'light-blue'
                                @break
                                @case (8)
                                class= 'cyan'
                                @break
                                @case (9)
                                class= 'teal'
                                @break
                                @case (10)
                                class= 'green'
                                @break
                                @case (11)
                                class= "light-green"
                                @break
                                @case (12)
                                class= 'lime'
                                @break
                                @case (13)
                                class= 'yellow'
                                @break
                                @case (14)
                                class= 'alert-success'
                                @break
                                @case (15)
                                class= 'blue-gray'
                                @break
                                @case (16)
                                class= "deep"
                                @break
                                @case (17)
                                class= 'brown'
                                @break
                                @case (18)
                                class= 'gray'
                                @break
                                @case (20)
                                class= 'purple'
                                @break
                                @endswitch>
                                {{$service->razon->nombre}}
                            </td>
                            <td>{{$service->created_at}}</td>

                            <td> @foreach ($service->users as $tec)
                                {{$tec->name}}
                                @endforeach
                            </td>

                            <td>{{$service->equipo->modelo}}</td>
                            <td>{{$service->equipo->marka->nombre}}</td>
                            <td>

                                <a href="javascript:void(0)" class="text text-dark"
                                    onclick="editarEquipo({{$service->equipo->id}})">{{$service->equipo->serie}}</a>
                            </td>
                            <td>{{$service->cliente->fullname}}</td>
                            <td>
                                <a href="javascript:void(0)" class="text text-dark"
                                    onclick="editarCliente({{$service->cliente->id}})">{{$service->cliente->identificacion}}</a>
                            </td>
                            <td>{{$service->cliente->direccion}}</td>
                            <td>{{$service->estado->nombre}}</td>
                            <td>{{$service->tipo->nombre}}</td>
                            <td>{{$service->modo->nombre}}</td>
                            <td>{{$service->fecha_finalizado}}</td>
                            <td>

                                <div class="text-lg-right text-wrap">

                                    <a class="btn btn-circle btn-dark mr-1" href="/services/{{$service->id }}"
                                        title="Editar">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a class="btn btn-circle btn-warning mr-1" href="javascript:void(0)"
                                        onClick="showPrintService({{$service->id }})" title="Imprimir">
                                        <i class="fa fa-fw fa-print"></i>
                                    </a>


                                    <a class="btn btn-circle btn-success mr-1" href="javascript:void(0)"
                                        data-toggle="modal" data-placement="top"
                                        data-target="#modalRegisterEquipoAndServicio"
                                        onclick="addService({{$service->equipo->id}},{{$service->cliente->id}})"
                                        title="Agregar Servicio" id="addService">
                                        <i class="fa fa-fw fa-plus"></i>
                                    </a>

                                </div>

                            </td>
                        </tr>


                        @empty
                        <tr>
                            <td colspan="16" style="font-size: 1.5em font-weight: bold">
                                Sin resultados ...
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>

                {{$services->render()}}

            </div>
        </div>
    </div>
</div>

@include('admin.services.partials.formUpdate')
@include('admin.services.partials.formRegister')
@include('admin.services.partials.formRegisterEquipoServicio')
@include('admin.services.partials.formRegisterEquipoAndServicio')
@include('admin.equipos.partials.formUpdate')
@include('admin.clientes.partials.formUpdate')
@include('admin.services.partials.printer')


@stop

@push('scripts')

<script>
    const clientes = @json($clientes);
    const equipos = @json($equipos);
</script>

<script>
    document.getElementById('customsearch').addEventListener('submit', () => {
        toastr.info('Estamos Buscando ...')
    })
</script>
<script>
    $('.selectpickeresServicioAndEquipo').select2({
        dropdownParent: $("#formRegisterEquipoAndServicio"),
        placeholder: "Select a state",
        allowClear: true,
        })
        
</script>

<script src="{{ asset('/apis/apiService.js') }}"></script>
<script src="{{ asset('/apis/printService.js') }}"></script>
<script src="{{ asset('/js/evalfecha.js') }}"></script>
<script src="{{ asset('/apis/addEquipoService.js') }}"></script>
<script src="{{ asset('/apis/addService.js') }}"></script>
<script src="{{ asset('/apis/apiEquipoUpdate.js') }}"></script>
<script src="{{ asset('/apis/apiClientUpdate.js') }}"></script>
<script src="{{ asset('/apis/addEquipoServiceAndEquipo.js') }}"></script>
<script src="{{ asset('/apis/selectClientesInEquiposRegisterEquipoServicio.js') }}"></script>
<script src="{{ asset('/apis/selectClientesInServiceRegister.js') }}"></script>
<script src="{{ asset('/apis/selectEquiposInServiceRegister.js') }}"></script>
<script src="{{ asset('/apis/verificarIngreso.js') }}"></script>

@endpush