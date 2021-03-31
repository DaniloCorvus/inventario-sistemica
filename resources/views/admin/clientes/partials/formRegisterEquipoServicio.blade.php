<div class="modal fade " tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalEquipoRegisterEquipoServicio">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">


            <div class="card-header text-dark">Registrar Equipo Y Servicio
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formRegisterEquipoServicio" method="POST" action="{{route('equiposervicio.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Cliente <span>(Buscar por Documento) </span> </label>
                                <select name="cliente_id" class="custom-select" style="width:100%" required>
                                    @if (isset($clientes) && count($clientes)>0)
                                    @foreach ($clientes as $cliente)

                                    <optgroup label="{{$cliente->nombre .' '. $cliente->apellido}}">
                                        <option value="{{$cliente->id}}">{{$cliente->identificacion}}</option>
                                    </optgroup>

                                    @endforeach
                                    @else
                                    <option>Sin clientes</option>
                                    @endif
                                </select>
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
                                <select name="descripcion" class="selectpickeres" style="width:100%">
                                    @if (isset($descripciones) && count($descripciones)>0)
                                    @foreach ($descripciones as $descripcion)
                                    <option value="{{$descripcion->id}}">{{$descripcion->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Productos</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Marca </label>
                                <select name="marca" class="selectpickeres" style="width:100%">
                                    @if (isset($marcas) && count($marcas)>0)
                                    @foreach ($marcas as $marca)
                                    <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Marcas</option>
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
                                <label class="text-dark"> Valor declarado </label>
                                <input type="text" class="form-control" name="v_declarado" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Referencia </label>
                                <input type="text" class="form-control" name="referencia" placeholder="">
                            </div>

                            <div class="w-100 d-flex justify-content-center my-2">
                                <h6 class="text-danger font-weight-bold ">Informacion para servicio </h6>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Tecnico </label>
                                <select name="user_id" class="selectpickeres" style="width:100%" required>
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
                                <select name="staff_id" class="selectpickeres" style="width:100%" required>
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
                                <select name="tipo_id" class="selectpickeres" style="width:100%" required>
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
                                <select name="tipo_reparacion" class="selectpickeres" style="width:100%" required>
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
                                <label class="text-dark"> Tipo de Modo </label>
                                <select name="modo_id" class="selectpickeres" required>
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
                                <label class="text-dark">Accesorios del equipo</label>
                                <textarea type="text" cols="5" class="form-control" name="accesorio_equipo"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Fallos reportados por cliente</label>
                                <textarea type="text" rows="5" class="form-control" name="observacion"
                                    placeholder=""></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnSaveEquipoServicio"
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