<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalUser_RoleRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Asignacion de roles
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formUser_RoleRegister" method="POST" action="{{route('rols.asignarRole')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="user_id" id="user_id" value={{$user->id}}>


                            <div class="form-group col-md-12">

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Admin" name="admin">
                                    <label class="custom-control-label" for="Admin">Administrador
                                    </label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="User" name="user">
                                    <label class="custom-control-label" for="User">User
                                    </label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Cliente" name="cliente">
                                    <label class="custom-control-label" for="Cliente">Cliente
                                    </label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Tecnico" name="tecnico">
                                    <label class="custom-control-label" for="Tecnico">Tecnico
                                    </label>
                                </div>

                            </div>

                            <div class="form-group col">
                                <input type="submit" class="btn btn-outline-info  btn-sm" id="btnSaveUser_Role"
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