<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalCellarUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Actualizar Cellar
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formCellarUpdate" method="" action="{{route('cellars.update')}}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="id" id="id">

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Nombre </label>
                                <input type="text" class="form-control" id="nombre" required="required" name="nombre"
                                    placeholder="Nombre">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Descripcion </label>
                                <textarea type="text" class="form-control" rows="3" cols="50" id="descripcion"
                                    required="required" name="descripcion" placeholder="Ej: Se realiza ..."></textarea>
                            </div>

                            <div class="form-group col-md-3">
                                <input type="submit" class="btn btn-outline-info btn-sm" id="btnUpdateCellar"
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
