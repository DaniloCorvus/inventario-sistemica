<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalClienteUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Actualizar Cliente
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formClienteUpdate" method="" action="{{route('clientes.update')}}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row text-left">

                            <input type="hidden" name="id" id="id">

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Nombres </label>
                                <input type="text" class="form-control" id="nombre" required="required" name="nombres"
                                    placeholder="nombre">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-dark">Apellidos </label>
                                <input type="text" class="form-control" id="apellido" required="required"
                                    name="apellidos" placeholder="Last Name">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Tipo de Identificación</label>
                                <select class="form-control" required="required" name="tipo_identificacion"
                                    id="tipo_identificacion">
                                    <option disabled selected> Selecciona...</option>
                                    <option value="Cedula">Cedula</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                    <option value="Nit">Nit</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark"># Identificacion</label>
                                <input type="number" class="form-control" id="identificacion" required="required"
                                    name="identificacion" placeholder="">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Mail </label>
                                <input type="email" class="form-control" id="email" required="required" name="email"
                                    placeholder="E-mail">
                            </div>


                            {{-- <div class="form-group col-md-6">
                                <label class="text-dark">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" required="required" name="ciudad"
                                    placeholder="ciudad">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Departamento</label>
                                <input type="text" class="form-control" id="departamento" required="required"
                                    name="departamento" placeholder="Dpto">
                            </div> --}}

                            <div class="form-group col-md-6">
                                <label class="text-dark">Dirección</label>
                                <input type="text" class="form-control" id="direccion" required="required"
                                    name="direccion" placeholder="Address">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="text-dark">Barrio</label>
                                <input type="text" class="form-control" id="barrio" required="required" name="barrio"
                                    placeholder="Barrio">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="text-dark">Telefono</label>
                                <input type="phone" class="form-control" id="telefono" required="required"
                                    name="telefono" placeholder="Telefono">
                            </div>

                            <div class="form-group col-md-3">
                                <label class="text-dark">Telefono (opcional)</label>
                                <input type="phone" class="form-control" id="opcional_telefono" name="opcional_telefono"
                                    placeholder="Telefono ">
                            </div>

                            <div class="form-group col-md-3">
                                <input type="submit" class="btn btn-outline-info btn-sm" id="btnUpdateCliente"
                                    value="Enviar">
                                <button type="button" class="btn btn-outline-dark btn-sm"
                                    data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
