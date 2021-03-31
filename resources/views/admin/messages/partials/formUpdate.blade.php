<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalMessageUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Actualizar Message
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formMessageUpdate" method="" action="{{route('messages.update')}}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="id">

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Descripcion </label>
                                <input type="text" class="form-control" required="required" name="descripcion"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="text-dark"> Mensaje </label>
                                <textarea type="text" rows="10" class="form-control" required="required"
                                    name="body" placeholder=""></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdateMessage"
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
