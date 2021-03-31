@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row">

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1" title=""
            data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>

    </div>

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                {{-- <h6 class="mr-2 font-weight-bold text-primary ">
                    <a class="primary" href="{{route('services.index')}}">Servicios <i class="fa fa-fw fa-eye"></i> Ver
                todos</a>
                </h6> --}}
            </div>

            <form action="{{route('update.busqueda')}}" id="customsearch" method="get" autocomplete="off">
                @csrf
                <div class="row m-3">
                    <div class="col-md-6">
                        <select name="filter" class="custom-select" style="border: none; font-size: 15px;width: 200px;">
                            <option value=null>No Asignados</option>
                            <option value="Auditar Servicio">Auditar Servicio</option>
                            <option value="Happy Call Realizado">Happy Call Realizado</option>
                            <option value="Sin Realizar">Sin Realizar</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-small btn-primary"> Buscar </button>
                    </div>
                </div>
            </form>



            <div class="table-responsive p-3">
                <table style="font-size: 0.5rem" class="table align-items-center table-flush table-hover text-dark"
                    id="dataTableServices">
                    <thead class="">
                        <tr>
                            <th style="cursor: pointer">COD</th>
                            <th style="cursor: pointer">Fecha Ingreso</th>
                            <th style="cursor: pointer">Modo</th>
                            <th style="cursor: pointer">Tipo servicio</th>
                            <th style="cursor: pointer">Reporte</th>
                            <th style="cursor: pointer">Observacion Happy Call </th>
                            <th style="cursor: pointer">Happy Call estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($services as $service)
                        <tr>
                            <form id="updateByHappyForm{{$service->id}}" method="POST"
                                action="{{route('services.update')}}">

                                @csrf
                                @method('PATCH')

                                <div class="row">

                                    <input type="hidden" name="id" value="{{$service->id}}">

                                    <td>
                                        {{$service->service}}
                                    </td>
                                    <td>
                                        {{$service->fecha_inicio}}
                                    </td>
                                    <td>

                                        <select name="modo_id" class="custom-select"
                                            style="border: none; font-size: 15px;width: 200px;">
                                            @if (isset($modos) && count($modos)>0)
                                            <option selected disabled value="{{$service->modo->id}}">
                                                {{$service->modo->nombre}}
                                            </option>
                                            @foreach ($modos as $modo)
                                            <option value="{{$modo->id}}">{{$modo->nombre}}
                                            </option>
                                            @endforeach
                                            @else
                                            <option>Sin Happy Call Estado</option>
                                            @endif
                                        </select>

                                    </td>
                                    <td>

                                        <select name="tipo_id" class="custom-select"
                                            style="border: none; font-size: 15px;width: 200px;">
                                            @if (isset($tipos) && count($tipos)>0)
                                            <option selected disabled value="{{$service->tipo->id}}">
                                                {{$service->tipo->nombre}}
                                            </option>
                                            @foreach ($tipos as $tipo)
                                            <option value="{{$tipo->id}}">{{$tipo->nombre}}
                                            </option>
                                            @endforeach
                                            @else
                                            <option>Sin Happy Call Estado</option>
                                            @endif
                                        </select>

                                    </td>

                                    <td>
                                        <textarea style="border: none; font-size: 15px;width: 200px;" type="text"
                                            name="">{{$service->reporte}}</textarea>
                                    </td>

                                    <td>
                                        <textarea style="border: none; font-size: 15px;width: 200px;" type="text"
                                            name="" value="{{$service->observacion_happycallestado}}"></textarea>
                                    </td>

                                    <td>


                                        <select name="happycall_estado" class="custom-select"
                                            style="border: none; font-size: 15px;width: 200px;">
                                            @if (isset($happys) && count($happys)>0)
                                            @if ($service->happycallestado == null)
                                            <option selected>

                                            </option>
                                            @else
                                            <option selected value="{{$service->happycallestado->id}}">
                                                {{$service->happycallestado->nombre}}
                                            </option>
                                            @endif

                                            @foreach ($happys as $happycallestado)
                                            <option value="{{$happycallestado->id}}">
                                                {{$happycallestado->nombre}}
                                            </option>
                                            @endforeach

                                            @else
                                            <option>Sin Happy Call Estado</option>
                                            @endif
                                        </select>
                                    </td>

                                    <td>
                                        <input class="btn btn-primary" type="submit"
                                            id="updateByHappyBtn{{$service->id}}"
                                            onclick="updateByHappy({{$service->id}})" value="Update">
                                    </td>

                                </div>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$services->render()}}
            </div>
        </div>
    </div>
</div>

@stop

@push('scripts')
<script>
    async function updateByHappy(service) {
            let updateByHappyForm = document.getElementById('updateByHappyForm'+service);
            updateByHappyForm.Service = service;
            updateByHappyForm.addEventListener('submit', ajaxFormUpdateService)
        }
        
        async function ajaxFormUpdateService(event) {
             event.preventDefault();
            const  service = event.currentTarget.Service
            let updateByHappyForm = document.getElementById('updateByHappyForm'+service);
            let updateByHappyBtn = document.getElementById('updateByHappyBtn'+service);

                updateByHappyBtn.value = "Enviando..."
                updateByHappyBtn.disabled = true

                const dataUpdate = new FormData(updateByHappyForm);
                const update = await axios.post(updateByHappyForm.action, dataUpdate).then(async res => {
                    toastr.info('Success', res.data)
                    console.log(res);
                }).catch((error) => {
                    if (error.response.data.errors) {
                        loadErrors(error.response.data.errors, updateByHappyForm);
                    }
                    console.error(error.response.data);
                })

                updateByHappyBtn.value = "Update"
                updateByHappyBtn.disabled = false
            }

           
</script>
@endpush