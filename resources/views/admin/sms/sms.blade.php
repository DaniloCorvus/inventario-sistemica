<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalsms">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark"> Enviar mensaje
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formsms" method="POST" action="{{route('sendMensaje')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="service_id" value="{{$service->id}}">

                            <div class="form-group col-md-12">
                                <label class="text-dark">Numero (Sin espacios ni guiones)</label>
                                <input type="number" class="form-control" required name="number">
                            </div>

                            <div class="form-group col-md-12">

                                <select class="custom-select" id="selectSms"></select>

                                <button type="button" onclick="cargarBody()"
                                    class="btn btn-outline-primary btn-sm ">cargar
                                    Predeterminado </button>

                                <button type="button" onclick="deleteBody()"
                                    class="btn btn-outline-danger btn-sm ">Eliminar Contenido</button>

                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">sms</label>
                                <textarea type="text" cols="15" class="form-control" id="bodyMessage" required
                                    name="body"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnSms" value="Enviar">
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