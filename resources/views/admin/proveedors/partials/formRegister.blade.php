<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalProveedorRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Proveedor
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formProveedorRegister" method="POST" action="{{route('proveedors.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Nombre </label>
                                <input type="text" class="form-control" required="required" name="nombre"
                                    placeholder="Nombre">
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label class="text-dark">Apellidos </label>
                                <input type="text" class="form-control" required="required" name="apellido"
                                    placeholder="Apellido">
                            </div> --}}

                            <div class="form-group col-md-6">
                                <label class="text-dark">Tipo de Identificación</label>
                                <select class="form-control" required="required" name="tipo_identificacion">
                                    {{-- <option disabled selected> Selecciona...</option> --}}
                                    {{-- <option value="Cedula">Cedula</option> --}}
                                    {{-- <option value="Pasaporte">Pasaporte</option> --}}
                                    <option selected value="Nit">Nit</option>
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

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnSaveProveedor"
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
