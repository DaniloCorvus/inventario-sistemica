<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalServiceUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Service
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formServiceUpdate" method="POST" action="{{route('services.update')}}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="id">

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Cliente </label>
                                <select name="cliente_id" class="form-control" required>
                                    @if (isset($clientes) && count($clientes)>0)
                                    @foreach ($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin clientes</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Tecnico </label>
                                <select name="user_id" class="form-control" required>
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
                                <label class="text-dark"> Tipo de Servicio </label>
                                <select name="tipo_id" class="form-control" required>
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
                                <select name="tipo_reparacion" class="form-control" required>
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
                                <label class="text-dark"> Equipo </label>
                                <select name="equipo_id" class="form-control" required>
                                    @if (isset($equipos) && count($equipos)>0)
                                    @foreach ($equipos as $equipo)
                                    <option value="{{$equipo->id}}">{{$equipo->serie}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Equipos</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Tipo de Modo </label>
                                <select name="modo_id" class="form-control" required>
                                    @if (isset($modos) && count($modos)>0)
                                    @foreach ($modos as $modo)
                                    <option value="{{$modo->id}}">{{$modo->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Tipo de Modos</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Tipo de Estado </label>
                                <select name="estado_id" class="form-control" required>
                                    @if (isset($estados) && count($estados)>0)
                                    @foreach ($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Tipo de Estados</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Tipo de Razon </label>
                                <select name="razon_id" class="form-control" required>
                                    @if (isset($razons) && count($razons)>0)
                                    @foreach ($razons as $razon)
                                    <option value="{{$razon->id}}">{{$razon->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Tipo de Razons</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Fecha registro de servicio</label>
                                <input type="date" class="form-control" required name="fecha_inicio">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Fecha reparado de equipo</label>
                                <input type="date" class="form-control" required onchange="validateDate()" name="fecha_reparado">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Fecha Finalizado servicio</label>
                                <input type="date" class="form-control" required name="fecha_finalizado">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Valor Mano de Obra</label>
                                <input type="number" class="form-control" required name="valor_obra">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Valor Aprobado </label>
                                <input type="number" class="form-control" required name="valor_aprobado">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Valor Cotizado </label>
                                <input type="number" class="form-control" required name="valor_cotizado">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Valor Cargo Fabrica </label>
                                <input type="number" class="form-control" required name="valor_cargo_fabrica">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Valor Cargo cliente </label>
                                <input type="number" class="form-control" required name="valor_cargo_cliente">
                            </div>

                            {{-- <div class="form-group col-md-6">
                                <label class="text-dark">Valor Total </label>
                                <input type="number" class="form-control" required name="valor_total">
                            </div> --}}

                            <div class="form-group col-md-6">
                                <label class="text-dark">Happy Call Estado </label>
                                <input type="text" class="form-control" required name="happycall_estado">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Happy Call Calificado </label>
                                <input type="text" class="form-control" required name="happycall_calificacion">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Reporte del Tecnico</label>
                                <textarea type="text" cols="15" class="form-control" required name="reporte"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="text-dark">Observación</label>
                                <textarea type="text" cols="15" class="form-control" required
                                    name="observacion"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdateService"
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