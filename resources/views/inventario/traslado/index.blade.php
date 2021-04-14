@extends('layouts.app')
@section('content')

<div class="card ">

    <div class="card-header text-dark">Realizar traslado
    </div>

    <div class="card-body">

        <form id="formCodigoBuscar" method="POST" action="{{route('inventario.trasladoIn')}}">

            @csrf
            <div class="modal-body">
                <div class="row text-left">
                    <div class="form-group col-md-4">
                        <label class="text-dark"> Bodega Origen </label>
                        <select name="from_cellar_id" id="from_cellar_id"class="selectpickerp custom-select m-2" style="width:100%" required>
                                @if (isset($bodegas) && count($bodegas)>0)
                                @foreach ($bodegas as $bodega)
                            <option value="{{$bodega->id}}">{{$bodega->nombre}}</option>
                                @endforeach
                                @else
                            <option>Sin bodegas</option>
                                @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="text-dark"> Bodega Destino </label>
                        <select name="to_cellar_id" id="to_cellar_id"class="selectpickerp custom-select m-2" style="width:100%" required>
                            @if (isset($bodegas) && count($bodegas)>0)
                            @foreach ($bodegas as $bodega)
                            <option value="{{$bodega->id}}">{{$bodega->nombre}}</option>
                            @endforeach
                            @else
                            <option>Sin bodegas</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="text-dark"> Codigo de barras </label>
                        <input id="codigo" type="text" class="form-control" name="codigo" value="{{ old('codigo') }}"
                            autocomplete="off">
                        <span class="invalid-feedback" role="alert">
                        </span>
                    </div>


                    <div class="form-group col-md-3">
                        <label for=""></label>
                        <input type="submit" class="btn btn-outline-info  btn-sm" id="btnBuscarCodigo" value="Enviar">
                    </div>
                </div>
            </div>
        </form>

        <form id="formGuardar" method="POST" action="{{route('inventario.trasladar')}}">
            @csrf
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" style="font-size: 0.8em"
                    id="dataTableVentas">
                    <thead class="thead">
                        <tr>
                            <th>Lote</th>
                            <th>Ubicación</th>

                            <th>Cantidad Disponible</th>
                            <th>Canitdad Traslado</th>
                            <th>Nueva Ubicación</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTableCodigos">

                    </tbody>

                </table>
                <input type="submit" class="btn btn-outline-info  mt-3 btn-sm" id="btnGuardar" value="Guardar">
            </div>

        </form>

    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('apisInventario\trasladoinventario\apiGetProducto.js') }}"></script>
<script src="{{ asset('apisInventario\trasladoinventario\guardar.js') }}"></script>
@endpush
