<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalCellarRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Bodega
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formCellarRegister" method="POST" action="{{route('cellars.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row text-left">

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Nombre </label>
                                <input type="text" class="form-control" id="nombre" required="required" name="nombre"
                                    placeholder="Nombre">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Estado </label>
                                <select class="custom-select" name="estado" id="">
                                    <option value="activo">Activa</option>
                                    <option value="inactivo">Inactiva</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Direccion </label>
                                <textarea type="text" class="form-control" rows="3" cols="50" id="direccion"
                                    required="required" name="direccion" placeholder="Direccion..."></textarea>
                            </div>


                            <div class="form-group col-md-3">
                                <input type="submit" class="btn btn-outline-info  btn-sm" id="btnSaveCellar"
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