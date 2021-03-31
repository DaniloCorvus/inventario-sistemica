<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalRepuestoCarga">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Cagar Repuesto
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formRepuestoCarga" method="POST" action="{{route('repuestos.carga')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="id">


                            <div class="form-group col-md-6">
                                <label class="text-dark"> ID Servicio </label>
                                <input type="text" class="form-control" name="service_id" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Cantidad</label>
                                <input type="number" min="0" class="form-control" name="cantidad" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Proveedor </label>
                                <select name="proveedor_id" disabled class="custom-select" style="width:100%" required>
                                    @if (isset($proveedores) && count($proveedores)>0)
                                    @foreach ($proveedores as $proveedor)
                                    <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin proveedores</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Estado </label>
                                <select name="estado" disabled class="custom-select" style="width:100%" required>
                                    <option value="solicitado">Solicitado</option>
                                    <option value="cancelado">Cancelado</option>
                                    <option value="en backorder">En backorder</option>
                                    <option value="reservado">Reservado</option>
                                    <option value="recibido">Recibido</option>

                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Descripcion </label>
                                <input disabled type="text" class="form-control" name="descripcion" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Serie </label>
                                <input disabled type="text" class="form-control" name="serie" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Modelo </label>
                                <input disabled type="text" class="form-control" name="modelo" placeholder="">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark"> Numero de Pedido </label>
                                <input disabled type="text" class="form-control" name="num_pedido" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Numero de Factura </label>
                                <input disabled type="text" class="form-control" name="num_factura" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Fecha Compra </label>
                                <input disabled type="date" class="form-control" name="fecha_compra" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Orden Compra </label>
                                <input disabled type="text" class="form-control" name="orden_compra" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Cod Interno Pedido </label>
                                <input disabled type="text" class="form-control" name="cod_interno" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Delivery Orden </label>
                                <input disabled type="text" class="form-control" name="delivery_orden" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Confirmación </label>
                                <input disabled type="text" class="form-control" name="confirmacion" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Numero de parte </label>
                                <input disabled type="text" class="form-control" name="num_parte" placeholder="">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Observacion </label>
                                <textarea disabled type="text" class="form-control" name="observacion"
                                    placeholder=""></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnCargaRepuesto"
                                    value="Enviar">
                                <button type="button" class="btn btn-outline-dark btn-sm "
                                    data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>