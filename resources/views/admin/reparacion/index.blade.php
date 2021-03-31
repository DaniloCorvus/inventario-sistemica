@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row mb-0">

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1" title=""
            data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>

        <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle btn-primary mr-1" data-toggle="modal"
            data-placement="top" data-target="#modalReparacionRegister" title="Registrar">
            <i class="fa fa-fw fa-plus"></i>
        </a>

    </div>

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    Reparacions
                </h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableReparacions">
                    <thead class="thead">
                        <tr>
                            <th>S. No</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Row-->


@include('admin.reparacion.partials.formUpdate')
@include('admin.reparacion.partials.formRegister')
@stop

@push('scripts')
<script src="{{ asset('/apis/apiReparacion.js') }}"></script>
@endpush