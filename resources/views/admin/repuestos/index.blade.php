@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row">

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1" title=""
            data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>

        <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle btn-primary mr-1" data-toggle="modal"
            data-placement="top" data-target="#modalRepuestoRegister" title="Registrar">
            <i class="fa fa-fw fa-plus"></i>
        </a>

    </div>

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    Repuestos
                </h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableRepuestos">
                    <thead class="thead">
                        <tr>
                            <th>Fecha de Solicitud</th>
                            <th>Proveedor</th>
                            <th># de Parte</th>
                            <th>Radicado</th>
                            <th>Cantidad</th>
                            <th>Factura</th>
                            <th>Confirmacion</th>
                            <th>Disponibles</th>
                            <th>Estado</th>
                            <th>Servicio</th>
                            <th>Recibido</th>
                            <th>Descripcion</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Row-->


@include('admin.repuestos.partials.formUpdate')
@include('admin.repuestos.partials.formCarga')
@include('admin.repuestos.partials.formRegister')
@stop

@push('scripts')
<script src="{{ asset('/apis/apiRepuesto.js') }}"></script>
<script src="{{ asset('/js/custom/repuesto.js') }}"></script>
<script src="{{ asset('/js/custom/repuestoUp.js') }}"></script>
<script>
    const formUpdate = document.querySelector('#formRepuestoUpdate')
    const estado = formUpdate.querySelector('[name=estado]')
    const fecha_recibido = formUpdate.querySelector('[name=fecha_recibido]')
    const recibidoClass = formUpdate.querySelector('.fecha_recibido')

    estado.addEventListener('change',(e) => {
        if(e.target.value =='recibido'){
            recibidoClass.style.display='block'
            fecha_recibido.setAttribute('required',true)
        }else{
            recibidoClass.style.display='none'
            fecha_recibido.removeAttribute('required')
        }
    })



    $('.selectpickerp').select2({
    dropdownParent: $("#formRepuestoRegister"),
    theme: "classic",
    width: 'resolve',

});
</script>
@endpush