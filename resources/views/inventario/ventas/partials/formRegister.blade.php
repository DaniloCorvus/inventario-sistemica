@extends('layouts.app')
@section('content')

<div class="card ">

    <div class="card-header text-dark">Registrar Venta
    </div>

    <div class="card-body">

        <form id="formCodigoBuscar" method="POST" action="{{route('inventario.inventariocantidades')}}">
            @csrf
            <div class="modal-body">
                <div class="row text-left">
                <div class="form-group col-md-4">
                            <label class="text-dark"> Bodega </label>
                            <select name="cellar_id" id="cellar_id"class="selectpickerp custom-select m-2" style="width:100%" required>
                                @if (isset($bodegas) && count($bodegas)>0)
                                @foreach ($bodegas as $bodega)
                                <option value="{{$bodega->id}}">{{$bodega->nombre}}</option>
                                @endforeach
                                @else
                                <option>Sin bodegas</option>
                                @endif
                            </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-dark"> Codigo de barras </label>
                        <input id="codigo" type="text" class="form-control" name="codigo" value="{{ old('codigo') }}"
                            autocomplete="off">
                        <span class="invalid-feedback" role="alert">
                        </span>
                    </div>


                    <div class="form-group col-md-3">
                        <input type="submit" class="btn btn-outline-info  btn-sm" id="btnBuscarCodigo" value="Enviar">
                    </div>
                </div>
            </div>
        </form>



        <form id="formVentaRegister" method="POST" action="{{route('ventas.store')}}">
            @csrf
            <div class="modal-body">
                <div class="row text-left">

                    <div class="table-responsive">
                        <table style="table-layout:fixed;" class="table align-items-center" style="font-size: 0.8em"
                            id="dataTableCodigos">
                            <thead class="thead">
                                <tr>

                                    {{-- <th style="width: 30px">Descripción</th> --}}
                                    <th style="width: 80px;">Cod</th>
                                    <th style="width: 100px;">Modelo</th>
                                    <th style="width: 110px;">Disponibe</th>
                                    <th style="width: 120px;">C. Venta</th>
                                    <th style="width: 150px;" class="text-center d">Lotes</th>
                                    <th style="width: 140px">Vr Unidad</th>
                                    <th style="width: 90px;"> %RT. Fuente</th>
                                    <th style="width: 120px;">RT. Fuente</th>
                                    <th style="width: 120px;">Impuesto</th>
                                    <th  style="width: 140px;" >Sub. Impuesto</th>
                                    <th  style="width: 140px;" >Subtotal</th>
                                    <th style="width: 140px;">Total</th>
                                    <th style="width: 50px"></th>
                                </tr>
                            </thead>
                            <tbody id="bodyTableCodigos">
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <label class="text-dark">Cliente </label>
                        <select id="clientes" name="cliente_id">
                            @if (isset($clientes) && count($clientes)>0)
                            @foreach ($clientes as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->nombre}} {{$cliente->apellido}}
                            </option>
                            @endforeach
                            @else
                            <option>Sin clientes</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="text-dark">Numero de factura </label>
                        <input id="num_factura" type="text" class="form-control" name="num_factura"
                            value="{{ old('num_factura') }}" autocomplete="num_factura">
                        <span class="invalid-feedback" role="alert">
                        </span>
                    </div>
                    <div class="col-md-12">
                        <label class="text-dark"> Total Bruto </label>
                        <input id="total_bruto" readonly type="text" class="form-control" name="total_bruto"
                            value="{{ old('total_bruto') }}" autocomplete="total_bruto">
                        <span class="invalid-feedback" role="alert">
                        </span>
                    </div>
                    <div class="col-md-12">
                        <label class="text-dark"> Total RT. Fuente </label>
                        <input id="total_rtFuente" readonly type="text" class="form-control" name="total_rtFuente"
                            value="{{ old('total_bruto') }}" autocomplete="total_rtFuente">
                        <span class="invalid-feedback" role="alert">
                        </span>
                    </div>
                    <div class="col-md-12">
                        <label class="text-dark">Subtotal Impuesto </label>
                        <input id="impuesto" type="text" readonly class="form-control" name="impuesto"
                            value="0" autocomplete="impuesto" onchange="drawValors()">
                        <span class="invalid-feedback" role="alert">
                        </span>
                    </div>

                    <div class="col-md-12">
                        <label class="text-dark"> Total </label>
                        <input id="total" type="text" readonly class="form-control" name="total"
                            value="{{ old('total') }}" autocomplete="total">
                        <span class="invalid-feedback" role="alert">
                        </span>
                    </div>

                    <div class="col-md-12">
                        <label class="text-dark"> Observaciones </label>
                        <textarea id="observaciones" type="text" class="form-control" name="observaciones">
                                </textarea>
                        </span>
                    </div>

                    <div class="form-group col-md-3">
                        <input type="submit" class="btn btn-outline-info  btn-sm" id="btnSaveVenta" value="Enviar">
                        <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@stop
@push('scripts')
<script>
    amagiDropdown(
        {
            elementId: 'clientes',
            searchButtonInnerHtml: 'Buscar',
            closeButtonInnerHtml: 'Cerrar',
            title: 'Selecciona un cliente',
            bodyMessage: 'Selecciona u cliente dando doble click.',
        });

$('#modalVentaRegister').on('shown.bs.modal', function () {
    $('#codigo').trigger('focus')
})
</script>
<script src="{{ asset('/apisInventario/adjuntar.js') }}"></script>
<script src="{{ asset('/apisInventario/apiVentaCreate.js') }}"></script>
@endpush
