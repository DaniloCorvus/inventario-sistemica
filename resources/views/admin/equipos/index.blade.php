@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row">

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1" title=""
            data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>

        <a href="javascript:void(0)" class="tooltip-wrapper mx-1 btn  btn-circle btn-danger mr-1" data-toggle="modal"
            data-placement="top" data-target="#modalEquipoRegisterEquipoServicio" title="Registrar Equipo y servicio">
            <i class="fa fa-cog "></i>
        </a>

        <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle btn-primary mr-1" data-toggle="modal"
            data-placement="top" data-target="#modalEquipoRegister" title="Registrar">
            <i class="fa fa-fw fa-plus"></i>
        </a>

    </div>

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    Equipos
                </h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableEquipos">
                    <thead class="thead">
                        <tr>
                            <th>Nº</th>
                            <th>Descripcion</th>
                            <th>Modelo</th>
                            <th>Serie</th>
                            <th>Servicios</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Row-->


@include('admin.equipos.partials.formUpdate')
@include('admin.equipos.partials.formRegister')
@include('admin.equipos.partials.formRegisterEquipoServicio')
@include('admin.equipos.partials.formRegisterEquipoAndServicio')



@stop
@push('scripts')

<script>
    const clientes = @json($clientes);
</script>

<script>
    $('.selectClientesInEquiposRegister').select2({
    dropdownParent: $("#x"),
    });
    $('.selectInEquiposAddService').select2({
    dropdownParent: $("#xy"),
    });
</script>
<script src="{{ asset('/apis/addService.js') }}"></script>
<script src="{{ asset('/apis/apiEquipo.js') }}"></script>
<script src="{{ asset('/apis/addEquipoService.js') }}"></script>
<script src="{{ asset('/apis/addEquipoServiceAndEquipo.js') }}"></script>
<script src="{{ asset('/apis/selectClientesInEquiposRegister.js') }}"></script>
<script src="{{ asset('/apis/selectClientesInEquiposRegisterEquipoServicio.js') }}"></script>

@endpush