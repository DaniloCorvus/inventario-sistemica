@extends('layouts.app')
@section('content')

<div class=" card mt-5" id="modalProductoRegister">

    <div class="card-header text-dark">
        <a href="javascript:history.back()" class="text-white btn btn-circle btn-success mr-1" title="" data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>Registrar producto en el inventario
    </div>

    <div class="card-body">
        <div class="modal-body">

            <div class="row">

                <div class="col-md-12">
                    <h4>Datos del producto</h4>
                </div>

                <div class="col-md-6 ">

                    <form id="formCodigoBuscar" method="POST" action="{{route('codigo.buscar')}}">
                        @csrf

                        <div class="row text-left " style="margin-top:15px">

                            <div class="col-md-10">
                                <label class="text-dark"> Código de barras </label>

                                <div class="d-flex  d-row">
                                    <input id="codigo" type="text" style="margin-right: 10px;" placeholder="Producto a buscar" class="form-control" name="codigo" value="{{ old('codigo') }}" autocomplete="off">
                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                    <input type="submit" class="btn btn-outline-info  btn-sm" id="btnBuscarCodigo" value="Buscar">
                                </div>
                            </div>



                        </div>

                    </form>


                </div>

            </div>

            <div class="row" style="margin-top:15px" id="dataProduct">

            </div>
            <hr>

            <div id="dataCargue">

                <form id="formProductoRegister" style="visibility:hidden" method="POST" action="{{route('inventario.store')}}">
                    <div class="row text-left">
                        @csrf
                        <div class="col-md-12" style="margin-bottom:15px">
                            <h4>Información de cargue</h4>
                        </div>
                        <select name="proveedor_id" class="selectpickerp custom-select m-2" style="width:100%" required>
                            @if (isset($proveedores) && count($proveedores)>0)
                            @foreach ($proveedores as $proveedor)
                            <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                            @endforeach
                            @else
                            <option>Sin proveedores</option>
                            @endif
                        </select>

                        <div class="form-group col-md-6">
                            <label class="text-dark"> Estado </label>
                            <select name="estado" class="form-contol custom-select" style="width:100%" required>
                                <option value="solicitado">Solicitado</option>
                                <option value="cancelado">Cancelado</option>
                                <option value="en backorder">En backorder</option>
                                <option value="reservado">Reservado</option>
                                <option value="recibido">Recibido</option>
                                <option value="devuelto">Devuelto</option>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="text-dark"> Serie </label>
                            <input type="text" class="form-control" name="serie" placeholder="">
                        </div>


                        <div class="form-group col-md-6">
                            <label class="text-dark"> Radicado </label>
                            <input type="text" class="form-control" name="num_pedido" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark"> Guia </label>
                            <input type="text" class="form-control" name="guia" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark"> Numero de Factura </label>
                            <input type="text" class="form-control" name="num_factura" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark"> Fecha Compra </label>
                            <input type="date" class="form-control" name="fecha_compra" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark"> Fecha solicitud </label>
                            <input type="date" class="form-control" name="fecha_solicitud" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark"> Orden Compra </label>
                            <input type="text" class="form-control" name="orden_compra" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark"> Delivery </label>
                            <input type="text" class="form-control" name="delivery_orden" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark"> Confirmación </label>
                            <input type="text" class="form-control" name="confirmacion" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark">Valor unidad (Antes de IVA)</label>
                            <input type="text" tag="0" class="form-control" name="costo_antes_iva" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark">Impuesto</label>
                            <select class="custom-select" name="impuesto">
                                <option value="19">19</option>
                                <option selected value="0">0</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark">Costo de entrada</label>
                            <input type="text" readonly class="form-control" name="costo_in" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark">Cantidad</label>
                            <input type="text" tag="0" class="form-control" required name="cantidad" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark">Costo Total de Ingreso </label>
                            <input type="text" readonly class="form-control" name="costo_total" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark">Costo de venta (Unidad)</label>
                            <input type="text" class="form-control" name="costo_venta" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark"> Ubicacion </label>
                            <input type="text" class="form-control" name="ubicacion" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark"> Bodega </label>
                            <select name="cellar_id" class="selectpickerp custom-select m-2" style="width:100%" required>
                                @if (isset($bodegas) && count($bodegas)>0)
                                @foreach ($bodegas as $bodega)
                                <option value="{{$bodega->id}}">{{$bodega->nombre}}</option>
                                @endforeach
                                @else
                                <option>Sin bodegas</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="text-dark">Observacion </label>
                            <textarea type="text" class="form-control" name="observacion" placeholder=""></textarea>
                        </div>

                        
                

                    <div class="form-group col-md-12">
                        <input type="submit" class="btn btn-outline-info  btn-sm " id="btnSaveProducto" value="Enviar">
                        <button type="button" class="btn btn-outline-dark btn-sm " data-dismiss="modal">Cancel</button>
                    </div>
            </div>

            </form>
        </div>

    </div>
</div>
</div>
@endSection

@push('scripts')
<script src="{{ asset('/apisInventario/inventario/create.js') }}"></script>
<!-- <script src="{{ asset('/apisInventario/apiProductoCreate.js') }}"></script> -->
<script src="{{ asset('/apisInventario/calcularProductRegister.js') }}"></script>

@endpush