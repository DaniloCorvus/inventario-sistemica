@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row">

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1" title="" data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>

        <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle btn-primary mr-1" data-toggle="modal" data-placement="top"
            data-target="#modalServiceRegister" onclick="addService({{$equipo}})" title="Registrar">
            <i class="fa fa-fw fa-plus"></i>
        </a>

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
                            <th>S. No</th>
                            <th>Tecnico</th>
                            <th>Cliente</th>
                            <th>Pediente</th>
                            <th>Estado</th>
                            <th>Equipo</th>
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

@stop

@push('scripts')
<script>
const equipo = @JSON($equipo)
</script>

<script src="{{ asset('/apis/getServicesToEquipo.js') }}"></script>
<script src="{{ asset('/apis/addService.js') }}"></script>
<script src="{{ asset('/apis/deleteService.js') }}"></script>
@endpush
