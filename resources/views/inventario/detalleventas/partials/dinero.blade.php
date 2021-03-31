<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="DineroModalVenta">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Dinero
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">
                <div class="modal-body">
                    <form id="formDineroVenta" method="POST" action="{{route('dineros-venta.store')}}">
                        @csrf
                        <input type="hidden" name="venta_id">

                        <div class="row m-2">


                            <div class="form-group col-md-6">
                                <label class="text-dark"> Monto </label>
                                <input type="number" min="0" class="form-control" required="required" name="monto"
                                    placeholder="">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark"> Metodo de pago </label>
                                <select name="method_pay" class="form-control">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta de crédito ">Tarjeta de crédito </option>
                                    <option value="Tarjeta de debito ">Tarjeta de debito </option>
                                    <option value="Transferencia ">Transferencia </option>
                                    <option value="Consignacion">Consignacion</option>
                                </select>

                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Observacion </label>
                                <textarea type="text" class="form-control" name="observacion" placeholder=""></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btnFormDinero" class="btn btn-primary">Enviar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>