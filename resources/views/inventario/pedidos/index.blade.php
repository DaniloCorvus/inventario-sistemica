@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row">

    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

                        <a href="javascript:history.back()" class="text-white btn btn-circle btn-success mr-1"
                            title="" data-original-title="Regresar">
                            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
                        </a>

                        <a href="javascript:void(0)" class="text-white btn btn-circle btn-primary mr-1"
                            data-toggle="modal" data-placement="top" data-target="#modalPedidoRegister"
                            title="Registrar">
                            <i class="fa fa-fw fa-plus"></i>
                        </a>
                        Pedidos

                    </div>
                </h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTablePedidos">
                    <thead class="thead">
                        <tr>
                            <th>Cantidad</th>
                            <th>Cod interno</th>
                            <th>Confirmacion</th>
                            <th>Costo antes iva</th>
                            <th>Costo In</th>
                            <th>Costo promoción</th>
                            <th>Costo venta</th>
                            <th>Delivery orden</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Fecha compra</th>
                            <th>Fecha recibido</th>
                            <th>Fecha solicitud</th>
                            <th>Guia</th>
                            <th>Impuesto</th>
                            <th>Modelo</th>
                            <th>Num factura</th>
                            <th>Num parte</th>
                            <th>Num pedido</th>
                            <th>Observacion</th>
                            <th>Orden compra</th>
                            <th>Proveedor id</th>
                            <th>Serie</th>
                            <th>Ubicacion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="bodyTablePedido"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Row-->


@include('inventario.pedidos.partials.formUpdate')
@include('inventario.pedidos.partials.formRegister')
@stop

@push('scripts')
<script src="{{ asset('/apisInventario/general.js') }}"></script>
<script src="{{ asset('/apisInventario/apiPedido.js') }}"></script>
<script src="{{ asset('/apisInventario/calcular.js') }}"></script>

@endpush