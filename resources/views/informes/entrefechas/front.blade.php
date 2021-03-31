@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row">

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1" title=""
            data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>

    </div>

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0 p-3">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    Servicios Por Fecha de ingreso.
                </h6>
            </div>
            <form action="/services/informe/informeServicios/" method="get">
                <div class="row w-100">
                    @csrf

                    <div class="col-md-6">
                        <input type="text" class="form-control" id="min" name="min" placeholder="De:"
                            onfocus="(this.type='date')">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="max" name="max" placeholder="Hasta:"
                            onfocus="(this.type='date')">
                    </div>

                    <div class="col-md-6">
                        <select class="form-control" name="garantia" id="">
                            <option value=null>No Aplicar</option>
                            <option value="IW"> En Garantia </option>
                            <option value="EW"> Garantia Extendida</option>
                            <option value="OOW">Sin Garantia</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <select class="form-control" name="marca" id="">
                            <option value=null>No Aplicar</option>
                            @forelse ($marcas as $marca)
                            <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                            @empty
                            <option>Sin Marcas</option>
                            @endforelse
                        </select>
                    </div>

                    {{-- <div class="row w-100 align-items-center mt-2"> --}}
                    <div class="col text-center mt-3">
                        <button type="submit" class="btn btn-success ">Filtrar</button>
                    </div>
                    {{-- </div> --}}
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@push('scripts')
<script async src="{{ asset('/js/evalfecha.js') }}"></script>
@endpush