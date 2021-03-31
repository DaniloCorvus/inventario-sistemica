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


    <!-- <a class="btn btn-circle btn-warning mr-1" href="javascript:void(0)"
        onClick="showPrintServiceDetails('{{ $venta->id }}')" title="Imprimir">
        <i class="fa fa-fw fa-print"></i>
    </a> -->


  <!--   <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle btn-primary mr-1" data-toggle="modal"
        data-placement="top" data-target="#modalsms" title="sms">
        <i class="fa fa-fw fa-sms"></i>
    </a> -->

</div>

<div class="container-custom">
    <ul class="tabs">

        <li class="item-custom text-center active-custom">Servicio</li>
         @can('get', \App\User::class)
        <li class="item-custom text-center">Cliente</li>
        <li class="item-custom text-center">Historia</li>
        <!-- <li class="item-custom text-center">Otros</li> -->
        <li class="item-custom text-center">Dinero</li>
        <!-- <li class="item-custom text-center">Line Time</li> -->
         @endcan


    </ul>

    <div class="panels">
    @can('get', \App\User::class) 
 
        <div class=" panels-item  active-panels">
         @include('inventario.detalleventas.partials.formService') 
        </div>

        <div class=" panels-item ">
        @include('admin.services.partials.formCliente')
        </div>
        
        <div class=" panels-item ">
        @include('inventario.detalleventas.partials.historias')
        </div>

        <!-- <div class=" panels-item ">
        clientes!
        </div> -->
        
        <div class=" panels-item ">
        @include('inventario.detalleventas.partials.dineros')
        </div>
        
        <!-- <div class=" panels-item ">
        clientes!
        </div> -->


        @endcan
        {{--  
        <div class=" panels-item ">
          <!--   @include('admin.services.partials.formEquipo') -->
        </div>

        <div class=" panels-item ">
        <!--     @include('admin.services.partials.formCliente') -->
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
  --}}
    </div>

</div>

@include('inventario.detalleventas.historias.formRegister')
@include('inventario.detalleventas.partials.dinero')
{{--@include('admin.evidencias.partials.formEvidenciaRegister')
@include('admin.sms.sms')
@include('admin.services.partials.addTecnico')
@include('admin.services.partials.printer')
@include('admin.services.partials.minus')
@include('admin.services.partials.plus')
--}}


@stop
@push('scripts')

<script>
     const venta = @JSON($venta)
    </script>

window.onload = () => {
    <script src="{{ asset('/apisInventario\venta\apiHistoriaVenta.js') }}"></script>    
    <script src="{{ asset('/apisInventario\venta\apiProductosVenta.js') }}"></script>   
    <!-- <script src="{{ asset('\apisInventario\venta\miniHistoriaVenta.js') }}"></script>  -->
<script src="{{ asset('/apis/otros.js') }}"></script>
<script src="{{ asset('/apisInventario/venta/apiDineroVenta.js') }}"></script>
<script src="{{ asset('/apisInventario/venta/showVenta.js') }}"></script>
<script src="{{ asset('/apisInventario\venta\updateCliente.js') }}"></script>
<!-- <script src="{{ asset('/apis/addtecnicoToService.js') }}"></script>
<script src="{{ asset('/apis/evidenciaCarga.js') }}"></script>
<script src="{{ asset('/apis/updateEquipo.js') }}"></script>
-->
<script src="{{ asset('/apisInventario/venta/apiVenta.js') }}"></script>
<!--
<script src="{{ asset('/apis/apiEvidencia.js') }}"></script>
<script src="{{ asset('/apis/apiDinero.js') }}"></script>
<script src="{{ asset('/apis/apiAdicional.js') }}"></script>
<script src="{{ asset('/apis/apiGasto.js') }}"></script>
<script src="{{ asset('/apis/apiAccesorio.js') }}"></script>
<script src="{{ asset('/apis/printService.js') }}"></script>
<script src="{{ asset('/apis/sms.js') }}"></script>
<script src="{{ asset('/apis/mensajes.js') }}"></script>
<script src="{{ asset('/apis/validaciones.js') }}"></script>
 -->
}

@endpush