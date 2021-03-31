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
            data-placement="top" data-target="#modalClienteRegister" title="Nuevo Cliente">
            {{-- <i class="fa fa-fw fa-plus"></i> --}}
            <i class="fa fa-fw fa-plus"></i>

        </a>

    </div>

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    Clientes
                </h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableClientes">
                    <thead class="thead">
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Direccion</th>
                            <th>Ciudad</th>
                            <th>Barrio</th>
                            <th>Telefono</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Row-->


@include('admin.clientes.partials.formUpdate')
@include('admin.clientes.partials.formRegister')
@include('admin.clientes.partials.formRegisterEquipoServicio')

@stop

@push('scripts')

<script>
    $('.selectClientesInEquiposRegister').select2({
    dropdownParent: $("#x"),
    });
    $('.selectInEquiposAddService').select2({
    dropdownParent: $("#xy"),
    });
    function addEquipoService(item_id) {
    formRegisterEquipoServicio.cliente_id.value = item_id;
    }

   function checkState(element) {
        document.querySelector('[name=accept]')
            if(element.checked == true) {
                document.querySelector('[name=accept]').value='on'; 
            }else{
                document.querySelector('[name=accept]').value='off'; 
            }
    }

</script>

<script src="{{ asset('/apis/apiClient.js') }}"></script>
<script src="{{ asset('/apis/addEquipoService.js') }}"></script>
<script src="{{ asset('/js/custom/cliente.js') }}"></script>
@endpush