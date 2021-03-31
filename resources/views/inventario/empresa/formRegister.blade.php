@extends('layouts.app')
@section('content')

<div class="card-header text-dark">
    Empresa
</div>

<div class="card-body">

    <form id="formEmpresaRegister" method="POST" action="{{route('empresa.update')}}">
        @csrf
        @method('PATCH')
        <div class="modal-body">
            <div class="row">

                <div class="form-group col-md-6">
                    <label class="text-dark"> Razon social </label>
                    <input type="text" class="form-control" id="nombre" required="required" name="nombre"
                        placeholder="Mi empresa ">
                </div>
                <div class="form-group col-md-6">
                    <label class="text-dark"> Nit </label>
                    <input type="text" class="form-control" id="nit" required="required" name="nit" placeholder="nit">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"># De Contacto</label>
                    <input type="phone" class="form-control" id="telefono" required="required" name="telefono"
                        placeholder="Telefono">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Mail </label>
                    <input type="" class="form-control" id="email" required="required" name="email"
                        placeholder="E-mail">
                </div>


                <div class="form-group col-md-12">
                    <label class="text-dark">Dirección</label>
                    <input type="text" class="form-control" id="direccion" required="required" name="direccion"
                        placeholder="Address">
                </div>

                <div class="form-group col-md-12">
                    <label class="text-dark">Espacio para publicidad</label>
                    <textarea cols="10" type="text" class="form-control" id="publicidad" name="publicidad"
                        placeholder="Ej: Se oferta ..."></textarea>
                </div>


                <div class="form-group col-md-12">
                    <label for="img" class="subir btn btn-outline-dark d-flex justify-content-center ">
                        <i class="fas fa-cloud-upload-alt"></i> Logo de Empresa
                    </label>
                    <input id="img" name="img" type="file" style='display: none;' />
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-outline-info  d-block mr-2" id="btnSaveEmpresa" value="Enviar">
                </div>
            </div>
        </div>
    </form>
</div>

@stop
@push('scripts')
<script src="{{ asset('/apisInventario/apiEmpresa.js') }}"></script>
@endpush