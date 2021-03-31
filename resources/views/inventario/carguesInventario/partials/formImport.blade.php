<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalProductoImport">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Importar productos
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formProductoImport" method="POST" action="{{route('productox.import')}}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row text-center d-flex justify-content-center">


                            <input type="file" name="prodcuts" id="file" />
                            <label for="file" class="btn-3">
                                <span></span>
                            </label>


                        </div>

                        <div class="form-group col-md-6">

                            <input type="submit" class="btn btn-outline-info  btn-sm " id="btnImportProducto"
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
