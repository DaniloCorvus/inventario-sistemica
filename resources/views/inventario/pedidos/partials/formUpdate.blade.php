<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalPedidoUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Actualizar Pedido
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formPedidoUpdate" method="" action="{{route('pedidos.update')}}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row text-left">

                            <input type="hidden" name="id">

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Proveedor </label>

                                {{-- <select name="proveedor_id" class="custom-select" style="width:100%" required>
                                    @if (isset($proveedores) && count($proveedores)>0)
                                    @foreach ($proveedores as $proveedor)
                                    <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                @endforeach
                                @else
                                <option>Sin proveedores</option>
                                @endif
                                </select> --}}
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Estado </label>
                                <select name="estado" class="custom-select" style="width:100%" required>
                                    <option value="solicitado">Solicitado</option>
                                    <option value="cancelado">Cancelado</option>
                                    <option value="en backorder">En backorder</option>
                                    <option value="reservado">Reservado</option>
                                    <option value="recibido">Recibido</option>
                                    <option value="devuelto">Devuelto</option>

                                </select>
                            </div>

                            <div class="form-group col-md-12 fecha_recibido" style="display:none">
                                <label class="text-dark"> Fecha Recibido </label>
                                <input type="date" class="form-control" name="fecha_recibido" placeholder="">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Descripcion </label>
                                <input type="text" class="form-control" name="descripcion" placeholder="">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark"> Serie </label>
                                <input type="text" class="form-control" name="serie" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Modelo </label>
                                <input type="text" class="form-control" name="modelo" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">ID Servicio </label>
                                <input type="text" class="form-control" name="service_id" placeholder="">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark"> Numero de Pedido </label>
                                <input type="text" class="form-control" name="num_pedido" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Guia </label>
                                <input type="text" class="form-control" name="guia" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Numero de Factura </label>
                                <input type="text" class="form-control" name="num_factura" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Fecha Compra </label>
                                <input type="date" class="form-control" name="fecha_compra" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Fecha solicitud </label>
                                <input type="date" class="form-control" name="fecha_solicitud" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Orden Compra </label>
                                <input type="text" class="form-control" name="orden_compra" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Cod Interno Pedido </label>
                                <input type="text" class="form-control" name="cod_interno" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Delivery Orden </label>
                                <input type="text" class="form-control" name="delivery_orden" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Confirmación </label>
                                <input type="text" class="form-control" name="confirmacion" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Numero de parte </label>
                                <input type="text" class="form-control" name="num_parte" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Valor unidad (Antes de IVA)</label>
                                <input type="text" min="0" class="form-control" name="valor_before_iva" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Impuesto</label>
                                <select class="custom-select" name="impuesto">
                                    <option value="19">19</option>
                                    <option selected value="0">0</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Costo de entrada</label>
                                <input type="text" class="form-control" name="costo_in" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Cantidad</label>
                                <input type="text" min="0" class="form-control" required name="cantidad" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Costo Total de Ingreso </label>
                                <input type="text" class="form-control" name="costo_total" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Costo de venta (Unidad)</label>
                                <input type="text" class="form-control" name="costo_venta" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Ubicacion </label>
                                <input type="text" class="form-control" name="ubicacion" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Observacion </label>
                                <textarea type="text" class="form-control" name="observacion" placeholder=""></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdatePedido"
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