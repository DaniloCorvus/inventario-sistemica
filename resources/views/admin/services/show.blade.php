@extends('layouts.app')
@section('content')


<div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

    <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1" title=""
        data-original-title="Regresar">
        <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
    </a>

    <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle btn-primary mr-1" data-toggle="modal"
        data-placement="top" data-target="#modalHistoriaRegister" title="Registrar">
        <i class="fa fa-fw fa-plus"></i>
    </a>


    <a class="btn btn-circle btn-warning mr-1" href="javascript:void(0)"
        onClick="showPrintServiceDetails('{{ $service->id }}')" title="Imprimir">
        <i class="fa fa-fw fa-print"></i>
    </a>

    @can('get', \App\User::class)
    <a class="btn btn-circle btn-danger mr-1" href="javascript:void(0)" onClick="blockDetails('{{ $service->id }}')"
        title="Bloqueo">
        <i class="fa fa-fw fa-key"></i>
    </a>
    @endcan

    <a class="btn btn-circle btn-dark mr-1" href="javascript:void(0)" onClick="addTecnicoModal('{{ $service->id }}')"
        title="add tecnico">
        <i class="fa fa-fw fa-user"></i>
    </a>

    <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle btn-primary mr-1" data-toggle="modal"
        data-placement="top" data-target="#modalsms" title="sms">
        <i class="fa fa-fw fa-sms"></i>
    </a>

</div>

<div class="container-custom">
    <ul class="tabs">

        <li class="item-custom text-center active-custom">Servicio</li>
         @can('get', \App\User::class)
        <li class="item-custom text-center">Equipo</li>
        <li class="item-custom text-center">Cliente</li>
        <li class="item-custom text-center">Historia</li>
        <li class="item-custom text-center">Repuestos</li>
        <li class="item-custom text-center">Evidencias</li>
        <li class="item-custom text-center">Otros</li>
        <li class="item-custom text-center">Dinero</li>
        <li class="item-custom text-center">Line Time</li>
         @endcan


    </ul>

    <div class="panels">

        <div class=" panels-item  active-panels">
            @include('admin.services.partials.formService')

        </div>

 @can('get', \App\User::class)
 
        <div class=" panels-item ">
            @include('admin.services.partials.formEquipo')
        </div>

        <div class=" panels-item ">
            @include('admin.services.partials.formCliente')
        </div>

        <div class=" panels-item ">
            @include('admin.services.partials.historias')
        </div>

        <div class=" panels-item ">
            @include('admin.services.partials.accesorios')
        </div>

        <div class=" panels-item ">
            @include('admin.services.partials.evidencias')
        </div>

        <div class=" panels-item ">
            @include('admin.services.partials.adicionales')
        </div>

        <div class=" panels-item ">
            @include('admin.services.partials.dineros')
        </div>

        <div class=" panels-item ">
            @include('admin.services.partials.comentarios')
        </div>
 @endcan
    </div>

</div>
@include('admin.evidencias.partials.formEvidenciaRegister')
@include('admin.services.historias.formUpdate')
@include('admin.services.historias.formRegister')
@include('admin.sms.sms')
@include('admin.services.partials.addTecnico')
@include('admin.services.partials.printer')
@include('admin.services.partials.minus')
@include('admin.services.partials.plus')
@include('admin.services.partials.dinero')


@stop
@push('scripts')

<script>
    const service = @JSON($service)
    </script>

window.onload = () => {
<script src="{{ asset('/apis/addtecnicoToService.js') }}"></script>
<script src="{{ asset('/apis/evidenciaCarga.js') }}"></script>
<script src="{{ asset('/apis/updateCliente.js') }}"></script>
<script src="{{ asset('/apis/updateEquipo.js') }}"></script>
<script src="{{ asset('/apis/showService.js') }}"></script>
<script src="{{ asset('/apis/updateService.js') }}"></script>
<script src="{{ asset('/apis/apiHistoria.js') }}"></script>
<script src="{{ asset('/apis/apiEvidencia.js') }}"></script>
<script src="{{ asset('/apis/apiDinero.js') }}"></script>
<script src="{{ asset('/apis/apiAdicional.js') }}"></script>
<script src="{{ asset('/apis/apiGasto.js') }}"></script>
<script src="{{ asset('/apis/apiAccesorio.js') }}"></script>
<script src="{{ asset('/apis/otros.js') }}"></script>
<script src="{{ asset('/apis/printService.js') }}"></script>
<script src="{{ asset('/apis/sms.js') }}"></script>
<script src="{{ asset('/apis/mensajes.js') }}"></script>
<script src="{{ asset('/apis/validaciones.js') }}"></script>
<script src="{{ asset('/apis/miniHistoria.js') }}"></script>
}

@endpush