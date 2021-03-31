<div class="modal fade " tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalClienteRegister">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Cliente
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formClienteRegister" method="" action="{{route('clientes.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

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
                                    tag="1096216530">
                            </div>

                            <div class="form-group col-md-6" id="blockNombre">
                                <label class="text-dark"> Nombres </label>
                                <input type="text" class="form-control" required="required" name="nombre" tag="Nombre">
                            </div>
                            <div class="form-group col-md-6" id="blockApellido">
                                <label class="text-dark">Apellidos </label>
                                <input type="text" class="form-control" required="required" name="apellido"
                                    tag="Apellido">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Mail </label>
                                <input type="email" class="form-control" required="required" name="email" tag="E-mail">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="text-dark">Ciudad</label>
                                <input type="text" class="form-control" required="required" name="ciudad" tag="Ciudad">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Departamento</label>
                                <input type="text" class="form-control" required="required" name="departamento"
                                    tag="Departamento">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Dirección</label>
                                <input type="text" class="form-control" required="required" name="direccion"
                                    tag="Direccion">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Barrio</label>
                                <input type="text" class="form-control" required="required" name="barrio" tag="Barrio">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Telefono</label>
                                <input type="phone" class="form-control" required="required" name="telefono"
                                    tag="Telefono">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Telefono (opcional)</label>
                                <input type="phone" class="form-control" name="opcional_telefono" tag="Telefono ">
                            </div>


                            <div class="custom-control custom-checkbox my-1  col-md-6">
                                <input type="checkbox" name="accept" class="custom-control-input" id="acceptRadio">
                                <label class="custom-control-label" for="acceptRadio">Desea recibir mensajes
                                    Promocionales</label>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnSaveCliente"
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