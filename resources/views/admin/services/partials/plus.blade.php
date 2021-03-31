<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalAdicionalRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Adicional
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">
                <div class="modal-body">
                    <form id="formAdicionalRegister" method="POST" action="{{route('adicionales.store')}}">
                        @csrf
                        <input type="hidden" name="service_id">

                        <div class="row m-2">

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Nombre </label>
                                <input type="text" class="form-control" required="required" name="nombre"
                                    placeholder="">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark"> Valor </label>
                                <input type="number" min="0" class="form-control" required="required" name="valor"
                                    placeholder="">
                            </div>

                            <div class="form-group col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" name="importeplus" class="form-check-input"
                                        id="CheckImporteplus">
                                    <label class="form-check-label" for="CheckImporteplus"> ¿Suma?</label>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark"> Descripcion </label>
                                <textarea type="text" class="form-control" required="required" name="descripcion"
                                    placeholder=""></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btnSaveAdicional" class="btn btn-primary">Enviar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>