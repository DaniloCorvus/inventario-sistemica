<div class="modal fade " tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalClienteUpdate">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Actualizar Cliente
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formClienteUpdate" method="" action="{{route('clientes.update')}}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="id">

                            <div class="form-group col-md-6" id="blockNombre">
                                <label class="text-dark"> Nombres </label>
                                <input type="text" class="form-control" required="required" name="nombre"
                                    placeholder="Nombre">
                            </div>
                            <div class="form-group col-md-6" id="blockApellido">
                                <label class="text-dark">Apellidos </label>
                                <input type="text" class="form-control" required="required" name="apellido"
                                    placeholder="Apellido">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Tipo de Identificación</label>
                                <select class="form-control" required="required" name="tipo_identificacion">
                                    <option disabled selected> Selecciona...</option>
                                    <option value="Cedula">Cedula</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                    <option value="Nit">Nit</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"># Identificacion</label>
                                <input type="text" class="form-control" required="required" name="identificacion"
                                    placeholder="1096216530">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Mail </label>
                                <input type="email" class="form-control" required="required" name="email"
                                    placeholder="E-mail">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark">Ciudad</label>
                                <input type="text" class="form-control" required="required" name="ciudad"
                                    placeholder="Ciudad">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Departamento</label>
                                <input type="text" class="form-control" required="required" name="departamento"
                                    placeholder="Departamento">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Dirección</label>
                                <input type="text" class="form-control" required="required" name="direccion"
                                    placeholder="Direccion">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Barrio</label>
                                <input type="text" class="form-control" required="required" name="barrio"
                                    placeholder="Barrio">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Telefono</label>
                                <input type="phone" class="form-control" required="required" name="telefono"
                                    placeholder="Telefono">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Telefono (opcional)</label>
                                <input type="phone" class="form-control" name="opcional_telefono"
                                    placeholder="Telefono ">
                            </div>

                            <div class="custom-control custom-switch w-100 my-2">
                                <input type="hidden" name="accept">
                                <input type="checkbox" class="custom-control-input" id="acceptSelect" onchange="checkState(this)">
                                <label class="custom-control-label" style="cursor:pointer" for="acceptSelect">Desea
                                    recibir mensajes Promocionales?</label>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdateCliente"
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