@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row">

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1" title=""
            data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>

        {{-- <a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)" data-toggle="modal" data-placement="top"
            data-target="#modalEquipoRegisterEquipoServicio" onclick="addEquipoService({{$cliente}})"
            title="Agregar Servicio" id="addEquipoService">
            <i class="fa fa-fw fa-plus"></i>
        </a> --}}

    </div>

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    Servicios
                </h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableServices">
                    <thead class="thead">
                        <tr>
                            <th>COD</th>
                            <th>Radicado</th>
                            <th>Razon Pendiente</th>
                            <th class="fecha">Fecha recepcion</th>
                            <th>Tecnico</th>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Serie</th>
                            <th>Nombre Cliente</th>
                            <th>ID</th>
                            <th>Direccion Cliente</th>
                            <th>Estado</th>
                            <th>Tipo servicio</th>
                            <th>Fecha finalizado</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Row-->

@include('admin.services.partials.formRegister')
@include('admin.equipos.partials.formRegisterEquipoServicio')


@stop

@push('scripts')
<script>
    const cliente = @JSON($cliente)
</script>

<script src="{{ asset('/apis/getServicesToCliente.js') }}"></script>
<script src="{{ asset('/apis/addEquipoService.js') }}"></script>
<script src="{{ asset('/apis/deleteService.js') }}"></script>
<script>
    function addEquipoService(item_id) {
    console.log(item_id)
    formRegisterEquipoServicio.cliente_id.value = cliente;
}
</script>
@endpush