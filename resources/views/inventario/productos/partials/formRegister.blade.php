@extends('layouts.app')
@section('content')

<div class=" card mt-5" id="modalProductoRegister">

    <div class="card-header text-dark">
        <a href="javascript:history.back()" class="text-white btn btn-circle btn-success mr-1" title=""
            data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>Registrar Producto
    </div>

    <div class="card-body">

        <form id="formProductoRegister" method="POST" action="{{route('productox.store')}}">
            @csrf
            <div class="modal-body">
                <div class="row text-left">

                    <div class="col-md-6">
                        <label class="text-dark"> Codigo </label>
                        <input id="codigo" type="text" class="form-control" name="codigo" value="{{ old('codigo') }}"
                            autocomplete="codigo" autofocus=true>
                        <span class="invalid-feedback" role="alert">
                        </span>
                    </div>

                  

                  
                  
                    <div class="form-group col-md-6">
                        <label class="text-dark"> Modelo </label>
                        <input type="text" class="form-control" name="modelo" placeholder="">
                    </div>

                
                    <div class="form-group col-md-6">
                        <label class="text-dark"> Cod Interno Producto </label>
                        <input type="text" class="form-control" name="cod_interno" placeholder="">
                    </div>

                  
                    <div class="form-group col-md-6">
                        <label class="text-dark">Numero de parte </label>
                        <input type="text" class="form-control" name="num_parte" placeholder="">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="text-dark"> Descripcion </label>
                        <input type="text" class="form-control" name="descripcion" placeholder="">
                    </div>


                    <div class="form-group col-md-6">
                        <input type="submit" class="btn btn-outline-info  btn-sm " id="btnSaveProducto" value="Enviar">
                        <!-- <button type="button" class="btn btn-outline-dark btn-sm " data-dismiss="modal">Cancel</button> -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endSection

@push('scripts')
<script src="{{ asset('/apisInventario/apiProductoCreate.js') }}"></script>
<script src="{{ asset('/apisInventario/calcularProductRegister.js') }}"></script>

@endpush