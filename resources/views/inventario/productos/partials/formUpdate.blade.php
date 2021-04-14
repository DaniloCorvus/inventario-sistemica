@extends('layouts.app')
@section('content')

<div class=" card mt-5" id="modalProductoUpdate">

    <div class="card-header text-dark">
        <a href="javascript:history.back()" class="text-white btn btn-circle btn-success mr-1" title=""
            data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>Registrar Producto
    </div>

    <div class="card-body">

        <form id="formProductoUpdate" method="POST" action="{{route('productox.update')}}">
            @csrf
            <div class="modal-body">
                <div class="row text-left">

                    <div class="col-md-6">
                        <label class="text-dark"> Codigo </label>
                        <input id="codigo" type="text" class="form-control" name="codigo" value="{{$producto->codigo}}"
                            autocomplete="codigo" autofocus=true>
                        <span class="invalid-feedback" role="alert">
                        </span>
                    </div>





                    <div class="form-group col-md-6">
                        <label class="text-dark"> Modelo </label>
                        <input type="text" class="form-control" value="{{$producto->modelo}}" name="modelo" placeholder="">
                    </div>


                    <div class="form-group col-md-6">
                        <label class="text-dark"> Cod Interno Producto </label>
                        <input type="text" class="form-control" value="{{$producto->cod_interno}}" name="cod_interno" placeholder="">
                    </div>


                    <div class="form-group col-md-6">
                        <label class="text-dark">Numero de parte </label>
                        <input type="text" class="form-control" name="num_parte" value="{{$producto->num_parte}}"  placeholder="">
                    </div>

                    <div class="form-group col-md-12">
                        <label class="text-dark"> Descripcion </label>
                        <input type="text" class="form-control" name="descripcion" value="{{$producto->descripcion}}" placeholder="">
                    </div>


                    <div class="form-group col-md-6">
                        <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdateProducto"
                            value="Enviar">
                        <button type="button" class="btn btn-outline-dark btn-sm " data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endSection

@push('scripts')
<script>
    const data = @JSON($producto)
</script>

<script>
    const formUpdate = document.querySelector('#formProductoUpdate')
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
</script>

<script src="{{ asset('/apisInventario/apiProductEdit.js') }}"></script>
<script src="{{ asset('/apisInventario/calcularProduct.js') }}"></script>

@endpush

