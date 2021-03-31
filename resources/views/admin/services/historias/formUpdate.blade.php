<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalHistoriaUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Historia
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formHistoriaUpdate" method="POST" action="{{route('historias.update')}}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="id">

                            <div class="form-group col-md-12">
                                <label class="text-dark">Observación</label>
                                <textarea type="text" cols="15" class="form-control" required name="observacion"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdateHistoria" value="Enviar">
                                <button type="button" class="btn btn-outline-dark btn-sm " data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
