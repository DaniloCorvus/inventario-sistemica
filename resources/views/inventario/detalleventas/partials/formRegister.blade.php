<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalServiceRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Servicio
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formServiceRegister" method="POST" action="{{route('services.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Cliente <span>(Buscar por Documento) </span> </label>
                                <input class="form-control" autocomplete="off" id="selectClientesInServiceRegister">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"><span>¿Enviar mensaje?</span> </label>
                                <input type="checkbox" id="sendMessage" name="sendMessage" checked>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Tecnico </label>
                                <select name="user_id" class="selectpickers" style="width:100%" required>
                                    @if (isset($users) && count($users)>0)
                                    @foreach ($users as $tecnico)
                                    <option value="{{$tecnico->id}}">{{$tecnico->name}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Tecnicos</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Staff </label>
                                <select name="staff_id" class="selectpickers" style="width:100%" required>
                                    @if (isset($users) && count($users)>0)
                                    @foreach ($users as $tecnico)
                                    <option value="{{$tecnico->id}}">{{$tecnico->name}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Staffs</option>
                                    @endif
                                </select>
                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark"> Tipo de Servicio </label>
                                <select name="tipo_id" class="selectpickers" style="width:100%" required>
                                    @if (isset($tipos) && count($tipos)>0)
                                    @foreach ($tipos as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Tipo de Servicios</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Tipo de Reparacion </label>
                                <select name="tipo_reparacion" class="selectpickers" style="width:100%" required>
                                    @if (isset($typereparacions) && count($typereparacions)>0)
                                    @foreach ($typereparacions as $tipo_reparacion)
                                    <option value="{{$tipo_reparacion->id}}">{{$tipo_reparacion->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Tipo de Reparacions</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Equipo <span>(Buscar por Serie) </span> </label>
                                <input class="form-control" id="selectEquiposInServiceRegister">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark"> Tipo de Modo </label>
                                <select name="modo_id" class="selectpickers" style="width:100%" required>
                                    @if (isset($modos) && count($modos)>0)
                                    @foreach ($modos as $modo)
                                    <option value="{{$modo->id}}">{{$modo->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Tipo de Modos</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Fallos reportados por cliente</label>
                                <textarea type="text" cols="15" class="form-control" required
                                    name="observacion"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Accesorios del equipo</label>
                                <textarea type="text" cols="5" class="form-control" name="accesorio_equipo"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnSaveService"
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