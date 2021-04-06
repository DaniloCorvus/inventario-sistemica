@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row mb-0">
    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

                        <a href="javascript:history.back()" class="text-white btn btn-circle btn-success mr-1" title="" data-original-title="Regresar">
                            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
                        </a>

                        <a href="{{route('productox.create')}}" class="text-white btn btn-circle btn-primary mr-1" title="Registrar">
                            <i class="fa fa-fw fa-plus"></i>
                        </a>

                        <!-- <a href="javascript:void(0)" class="text-white btn btn-circle btn-dark mr-1" data-toggle="modal"
                            data-placement="top" data-target="#modalProductoImport" title="importar productox">
                            <i class="fa fa-fw fa-upload"></i>
                        </a> -->
                        Productos
                    </div>
                </h6>
            </div>
            <div class="table-responsive p-3">

                @isset($success)
                <span class="alert-success">Importacion exitosa</span>
                @endisset

                <table class="table align-items-center table-flush table-hover" id="dataTableProductox">
                    <thead class="thead">
                        <tr>
                            <th></th>
                            <th>Numero de parte </th>
                            <th>Modelo</th>
                            <th>Codigo interno</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                            <th>Codigo barras</th>

                        </tr>
                    </thead>
                    <tbody id="bodyTableProducto"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('inventario.productos.partials.formImport')
@endSection

@push('scripts')
<script src="{{ asset('/apisInventario/general.js') }}"></script>
<script src="{{ asset('/apisInventario/apiProducto.js') }}"></script>
<script>
    $('#modalProductoRegister').on('shown.bs.modal', function() {
        $('#codigo').trigger('focus')
    })
</script>
@endpush
