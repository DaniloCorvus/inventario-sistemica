<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalHistoriaRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Historia
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formHistoriaRegister" method="POST" action="{{route('historias.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">

                            <div class="form-group col-md-6">
                                <label class="text-dark">Tecnico asignado</label>
                                <select class="form-control" required="required" name="user_id" id="user_id">
                                    @foreach ($tecnicos as $tecnico)
                                    <option value="{{$tecnico->id}}">{{$tecnico->fullname}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Observacion</label>
                                <textarea type="text" class="form-control" rows="10" cols="50" id="accion" name="accion"
                                    placeholder="Observacion"></textarea>
                            </div>


                            <div class="form-group col-md-3">
                                <input type="submit" class="btn btn-outline-info  btn-sm" id="btnSaveHistoria"
                                    value="Enviar">
                                <button type="button" class="btn btn-outline-dark btn-sm"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>