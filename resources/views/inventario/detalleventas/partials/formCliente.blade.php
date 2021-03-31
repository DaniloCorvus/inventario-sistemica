<div class="card mb-0">
    <form id="formClienteUpdate" method="" action="{{route('clientes.update')}}">
        @csrf
        @method('PATCH')
        <div class="modal-body">
            <div class="row">

                <input type="hidden" name="id">

                <div class="form-group col-md-6" id="blockNombreUpdate">
                    <label class="text-dark"> Nombres </label>
                    <input type="text" class="form-control" required="required" name="nombre" placeholder="Nombre">
                </div>
                <div class="form-group col-md-6" id="blockApellidoUpdate">
                    <label class="text-dark">Apellidos </label>
                    <input type="text" class="form-control" required="required" name="apellido" placeholder="Apellido">
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
                    <input type="email" class="form-control" required="required" name="email" placeholder="E-mail">
                </div>


                <div class="form-group col-md-6">
                    <label class="text-dark">Ciudad</label>
                    <input type="text" class="form-control" required="required" name="ciudad" placeholder="Ciudad">
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
                    <input type="text" class="form-control" required="required" name="barrio" placeholder="Barrio">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Telefono</label>
                    <input type="phone" class="form-control" required="required" name="telefono" placeholder="Telefono">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Telefono (opcional)</label>
                    <input type="phone" class="form-control" name="opcional_telefono" placeholder="Telefono ">
                </div>

                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdateCliente" value="Enviar">
                </div>
            </div>
        </div>
    </form>
</div>