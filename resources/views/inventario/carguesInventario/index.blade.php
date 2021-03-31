@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row mb-0">
    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

                        <a href="javascript:history.back()" class="text-white btn btn-circle btn-success mr-1" title=""
                            data-original-title="Regresar">
                            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
                        </a>
                        CARGUES DEL PRODUCTO
                  
                    </div>
                    <input type="hidden"  id="inventario_id"  name="inventario_id" value="{{$inventario->id}}">
                </h6>
            </div>
            <div class="row px-4">
                <div class="col-md" >
                    <div class="form-group">
                        <label for="staticEmail" >Cod. Interno</label>
                        
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ strtoupper( $inventario->producto->cod_interno )}}">
                    
                    </div>  
                </div>
                <div class="col-md" >
                    <div class="form-group">
                        <label for="staticEmail" >Serie</label>
                        
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ strtoupper( $inventario->serie )}}">
                    
                    </div>  
                </div>
                <div class="col-md" >
                    <div class="form-group">
                        <label for="staticEmail" >Modelo</label>
                        
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ strtoupper( $inventario->producto->modelo )}}">
                    
                    </div>  
                </div>
                <div class="col-md" >
                    <div class="form-group">
                        <label for="staticEmail" >Núm. parte</label>
                        
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ strtoupper( $inventario->producto->num_parte )}}">
                    
                    </div>  
                </div>
              
                <div class="col-md" >
                    <div class="form-group">
                        <label for="staticEmail" >Descripción</label>
                        
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ strtoupper( $inventario->producto->descripcion )}}">
                    
                    </div>  
                </div>
            </div>
            <div class="table-responsive p-4">

                @isset($success)
                <span class="alert-success">Importacion exitosa</span>
                @endisset


                <table class="table align-items-center table-flush table-hover" id="dataTableInventario">
                    <thead class="thead">
                        <tr>
                            <th></th>
                            <th>Cantidad</th>
                            <th>Cost. Inicial</th>
                            <th>Imp.</th>
                            <th>Cost. Total</th>
                            <th>Cost. Venta</th>
                            <th>Guia</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          <!--   <th>action</th> -->

                        </tr>
                    </thead>
                    <tbody id="bodyTableProducto"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('inventario.productos.partials.formImport')
@endSection

@push('scripts')
<script src="{{ asset('/apisInventario/general.js') }}"></script>
<script src="{{ asset('/apisInventario/cargueInventario/apiCargueInventario.js') }}"></script>
<script>
    $('#modalProductoRegister').on('shown.bs.modal', function () {
            $('#codigo').trigger('focus')
    })
</script>
@endpush