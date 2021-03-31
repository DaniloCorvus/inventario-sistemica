<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalEquipoRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Equipo
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formEquipoRegister" method="POST" action="{{route('equipos.store')}}">
                    @csrf
                    <div class="modal-body" id="x">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <input class="form-control" autocomplete="off" id="selectClientesInEquiposRegister">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Numero de Factura </label>
                                <input type="text" class="form-control" name="num_factura" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Fecha Compra </label>
                                <input type="date" class="form-control" name="fecha_compra" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Descipcion </label>
                                <select name="descripcion" class="selectClientesInEquiposRegister" style="width:100%">
                                    @if (isset($descripciones) && count($descripciones)>0)
                                    @foreach ($descripciones as $descripcion)
                                    <option value="{{$descripcion->id}}">{{$descripcion->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin marcas</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Marca </label>
                                <select name="marca" class="selectClientesInEquiposRegister" style="width:100%">
                                    @if (isset($marcas) && count($marcas)>0)
                                    @foreach ($marcas as $marca)
                                    <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin marcas</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Modelo </label>
                                <input type="text" class="form-control" required="required" name="modelo"
                                    placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Serie </label>
                                <input type="text" class="form-control" required="required" name="serie" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Imei </label>
                                <input type="text" class="form-control" name="imei_uno" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Imei (Opcional) </label>
                                <input type="text" class="form-control" name="imei_dos" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Almacen de procedencia </label>
                                <input type="text" class="form-control" name="procedencia" placeholder="">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark"> Garantia </label>
                                <input type="text" class="form-control" name="garantia" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Referencia </label>
                                <input type="text" class="form-control" name="referencia" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Valor declarado </label>
                                <input type="text" class="form-control" name="v_declarado" placeholder="">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Observacion</label>
                                <textarea type="text" rows="5" class="form-control" name="observacion"
                                    placeholder=""></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnSaveEquipo"
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