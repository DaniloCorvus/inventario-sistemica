<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalEstadoUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Actualizar Estado
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formEstadoUpdate" method="" action="{{route('estados.update')}}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        
                        <div class="row">

                            <input type="hidden" name="id">

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Estado </label>
                                <input type="text" class="form-control" required="required" name="nombre"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="text-dark"> Descripcion </label>
                                <textarea type="text" rows="5" class="form-control" required="required"
                                    name="descripcion" placeholder=""></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdateEstado"
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