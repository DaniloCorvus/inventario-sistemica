@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    <a href="javascript:history.back()"
                        class="tooltip-wrapper btn btn-circle text-white  btn-success mr-1" title=""
                        data-original-title="Regresar">
                        <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
                    </a>

                    <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle text-white  btn-primary mr-1"
                        data-toggle="modal" data-placement="top" data-target="#modalCellarRegister"
                        title="Nueva categoria">
                        <i class="fa fa-fw fa-plus"></i>
                    </a>
                    Bodegas
                </h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" style="font-size: 0.8em"
                    id="dataTableCellars">
                    <thead class="thead">
                        <tr>
                        <tr>
                            <th>S. No</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th></th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('inventario.cellars.partials.formUpdate')
@include('inventario.cellars.partials.formRegister')

@stop
@push('scripts')
<script src="{{ asset('/apisInventario/apiCellar.js') }}"></script>
@endpush