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

                    <a href="{{route('ventas.create')}}" class="tooltip-wrapper btn btn-circle text-white  btn-primary mr-1"
                        title="Nueva categoria">
                        <i class="fa fa-fw fa-plus"></i>
                    </a>
                    Ventas
                </h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" style="font-size: 0.8em"
                    id="dataTableVentas">
                    <thead class="thead">
                        <tr>
                            <th>Observacion</th>
                            <th>Valor/unidad</th>
                            <th>iva</th>
                            <th>Total</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTableVentas">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('inventario.ventas.partials.formUpdate')

@stop
@push('scripts')
{{-- <script src="{{ asset('/apisInventario/adjuntar.js') }}"></script> --}}
{{-- <script src="{{ asset('/apisInventario/general.js') }}"></script> --}}
<script src="{{ asset('/apisInventario/apiVenta.js') }}"></script>
@endpush