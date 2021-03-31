<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalUserUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar User
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formUserUpdate" method="POST" action="{{ route('users.update') }}">
                    @csrf

                    @method('PATCH')

                    <input type="hidden" name="id">

                    <div class="form-group row">
                        <label for="name"
                            class="col-md-4 col-form-label text-md-right">{{ __('Nombre Completo') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" required autocomplete="name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="identificacion"
                            class="col-md-4 col-form-label text-md-right">{{ __('Identificacion') }}</label>
                        <div class="col-md-6">
                            <input id="identificacion" type="text" class="form-control" readonly name="identificacion"
                                required autocomplete="identificacion">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                        <div class="col-md-6">
                            <select name="estado" class="form-control">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required
                                autocomplete="email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="direccion"
                            class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>
                        <div class="col-md-6">
                            <input id="direccion" type="text" class="form-control" name="direccion" required
                                autocomplete="direccion">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Contacto') }}</label>
                        <div class="col-md-6">
                            <input id="telefono" type="text" class="form-control" name="telefono" required
                                autocomplete="telefono">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tipo_contrato"
                            class="col-md-4 col-form-label text-md-right">{{ __('Tipo contrato') }}</label>
                        <div class="col-md-6">
                            <input id="tipo_contrato" type="text" class="form-control" name="tipo_contrato" required
                                autocomplete="tipo_contrato">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="porcentual_taller"
                            class="col-md-4 col-form-label text-md-right">{{ __('Porcentaje en  Taller') }}</label>
                        <div class="col-md-6">
                            <input id="porcentual_taller" type="text" class="form-control" name="porcentual_taller"
                                required autocomplete="porcentual_taller">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="porcentual_home"
                            class="col-md-4 col-form-label text-md-right">{{ __('Porcentaje en Home') }}</label>
                        <div class="col-md-6">
                            <input id="porcentual_home" type="text" class="form-control" name="porcentual_home" required
                                autocomplete="porcentual_home">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="eps" class="col-md-4 col-form-label text-md-right">{{ __('EPS') }}</label>
                        <div class="col-md-6">
                            <input id="eps" type="text" class="form-control" name="eps" required autocomplete="eps">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="arl" class="col-md-4 col-form-label text-md-right">{{ __('ARL') }}</label>
                        <div class="col-md-6">
                            <input id="arl" type="text" class="form-control" name="arl" required autocomplete="arl">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ccf"
                            class="col-md-4 col-form-label text-md-right">{{ __('Caja de compensacion') }}</label>
                        <div class="col-md-6">
                            <input id="ccf" type="text" class="form-control" name="ccf" required autocomplete="ccf">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fecha_c"
                            class="col-md-4 col-form-label text-md-right">{{ __('Cumpleaños') }}</label>
                        <div class="col-md-6">
                            <input id="fecha_c" type="date" class="form-control" name="fecha_c" required
                                autocomplete="fecha_c">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fecha_ingreso"
                            class="col-md-4 col-form-label text-md-right">{{ __('Fecha ingreso') }}</label>
                        <div class="col-md-6">
                            <input id="fecha_ingreso" type="date" class="form-control" name="fecha_ingreso" required
                                autocomplete="fecha_ingreso">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fecha_retiro"
                            class="col-md-4 col-form-label text-md-right">{{ __('Fecha Retiro') }}</label>
                        <div class="col-md-6">
                            <input id="fecha_retiro" type="date" class="form-control" name="fecha_retiro" required
                                autocomplete="fecha_retiro">
                        </div>
                    </div>


                    <div class="form-group row">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="btnUpdateUser" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>