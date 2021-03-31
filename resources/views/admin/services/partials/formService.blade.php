<div class="card mb-0">
    <h6 class="text-center p-2 m-2">Cod: <small class="numService font-weight-bold"> </small> </h6>
    <form id="formServiceUpdate" method="POST" action="{{route('services.update')}}">
        @csrf
        @method('PATCH')
        <div class="modal-body">
            <div class="row">

                <input type="hidden" name="id">

                <div class="form-check col-md-6 p-3">
                    <label class="" for="exampleCheck1">¿Factura?</label>
                    <input type="checkbox" class="mx-2 form-check-input" id="exampleCheck1">
                </div>

                <div class="form-group col-md-6 " id="facturaBlock" style="display:none">
                    <label class="text-dark">Factura</label>
                    <input type="text" class="form-control" name="factura">
                </div>


                <div class="form-group col-md-6">
                    <label class="text-dark"> Cliente </label>
                    <ul class="list-group" id="cliente"></ul>
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Tecnicos asignados </label>
                    <ul class="list-group" id="users"></ul>
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Staff </label>
                    <select name="staff_id" class="form-control" required>
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
                    <select name="equipo_id" class="form-control" required disabled>
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
                    <input type="date" readonly class="form-control" required name="fecha_inicio">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Fecha Promesa</label>
                    <input type="date" class="form-control" name="fecha_promesa">
                </div>
                <div class="form-group col-md-6">
                    <label class="text-dark">Fecha Autorizado</label>
                    <input type="date" class="form-control" name="fecha_autorizado">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Radicado</label>
                    <input type="text" class="form-control" required name="radicado">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Fecha reparado de equipo</label>
                    <input type="date" class="form-control" onchange="validateDateReparado()" name="fecha_reparado">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Fecha Entregado</label>
                    <input type="date" class="form-control" onchange="validateDateEntregado()" name="fecha_finalizado">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Valor Mano de Obra</label>
                    <input type="number" class="form-control" name="valor_obra">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Valor Aprobado </label>
                    <input type="number" class="form-control" name="valor_aprobado">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Valor Cotizado </label>
                    <input type="number" class="form-control" name="valor_cotizado">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Dinero Recibido </label>
                    <input type="text" id="totalesdinero" class="form-control" disabled>
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Valor repuestos </label>
                    <input type="text" readonly class="form-control" name="valor_repuestos">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Valor Gastos </label>
                    <input type="text" readonly class="form-control" name="valor_gastos">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Valor Adicionales </label>
                    <input type="text" readonly class="form-control" name="valor_adicionales">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Valor Cargo Fabrica </label>
                    <input type="currency" class="form-control" readonly name="valor_cargo_fabrica"
                        value={{$service->getValorCargoFabrica($service->modo->nombre)}}>
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Valor Cargo cliente </label>
                    <input type="currency" class="form-control" readonly required name="valor_cargo_cliente"
                        value={{$service->getValorCargoCliente($service->modo->nombre)}}>
                    <span id="alert-valor-cliente" class="text-danger"></span>
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Happy Call Estado </label>
                    <select name="happycall_estado" class="form-control" required>
                        @if (isset($happycallestados) && count($happycallestados)>0)
                        @foreach ($happycallestados as $happycallestado)
                        <option value="{{$happycallestado->id}}">{{$happycallestado->nombre}}</option>
                        @endforeach
                        @else
                        <option>Sin Happy Call Estado</option>
                        @endif
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Happy Call Calificado </label>
                    <select name="happycall_calificacion" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>


                <div class="form-group col-md-12">
                    <label class="text-dark">Obsevacion Happy Call</label>
                    <textarea type="text" cols="15" class="form-control" name="observacion_happycallestado"></textarea>
                </div>

                <div class="form-group col-md-12">
                    <label class="text-dark">Reporte del Tecnico</label>
                    <textarea type="text" cols="15" class="form-control" name="reporte" id="reporteTenico"></textarea>
                    <button type="button" class="btn btn-outline btn-sm" onclick="copiarAlPortapapeles()">Copy</button>
                </div>

                <div class="form-group col-md-12">
                    <label class="text-dark">Fallos reportados por cliente</label>
                    <textarea type="text" cols="15" class="form-control" name="observacion"></textarea>
                </div>

                <div class="form-group col-md-12">
                    <label class="text-dark">Accesorios del equipo</label>
                    <textarea type="text" cols="5" class="form-control" name="accesorio_equipo"></textarea>
                </div>

                <div class="form-group col-md-6">
                    <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdateService" value="Enviar">
                </div>
            </div>
        </div>
    </form>
</div>