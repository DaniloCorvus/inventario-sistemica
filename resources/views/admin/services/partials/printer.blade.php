<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="printerModal">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Documentos a Imprimir
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">
                <div class="modal-body">
                    <form id="formPrint" method="POST" action="{{route('services.printservice')}}">
                        @csrf
                        <input type="hidden" name="id">


                        <div class="row m-2">

                            <div class="custom-control custom-switch w-100">
                                <input type="checkbox" class="custom-control-input" name="orden" id="orden">
                                <label class="custom-control-label" style="cursor:pointer" for="orden">Orden de
                                    servicio</label>
                            </div>
                            <div class="custom-control custom-switch w-100">
                                <input type="checkbox" class="custom-control-input" name="ReporteInterno"
                                    id="ReporteInterno">
                                <label class="custom-control-label" style="cursor:pointer" for="ReporteInterno">Reporte
                                    tecnico interno</label>
                            </div>
                            <div class="custom-control custom-switch w-100">
                                <input type="checkbox" class="custom-control-input" name="informeLineaBlanca"
                                    id="informeLineaBlanca">
                                <label class="custom-control-label" style="cursor:pointer"
                                    for="informeLineaBlanca">Reporte
                                    Linea Blanca LG</label>
                            </div>
                            <div class="custom-control custom-switch w-100">
                                <input type="checkbox" class="custom-control-input" name="formatoGTI" id="formatoGTI">
                                <label class="custom-control-label" style="cursor:pointer" for="formatoGTI">Formato
                                    GTI
                                    Samsung</label>
                            </div>
                            <div class="custom-control custom-switch w-100">
                                <input type="checkbox" class="custom-control-input" name="LGHE" id="LGHE">
                                <label class="custom-control-label" style="cursor:pointer" for="LGHE">LG HE
                                    (Línea marrón) </label>
                            </div>

                            <div class="custom-control custom-switch w-100">
                                <input type="checkbox" class="custom-control-input" name="FormatoLGAC" id="FormatoLGAC">
                                <label class="custom-control-label" style="cursor:pointer" for="FormatoLGAC">Formato LG
                                    AC</label>
                            </div>

                            <div class="custom-control custom-switch w-100">
                                <input type="checkbox" class="custom-control-input" name="ReciboCarry" id="ReciboCarry">
                                <label class="custom-control-label" style="cursor:pointer" for="ReciboCarry">Recibo
                                    Carry In</label>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btnFormPrint" class="btn btn-primary">Enviar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>