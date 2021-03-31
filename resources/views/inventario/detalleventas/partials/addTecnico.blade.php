<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="addTecnicoModal">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Agregar Tecnico al servicio
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">
                <div class="modal-body">
                    <form id="addTecnicoForm" method="POST" action="{{route('services.addtecnico')}}">
                        @csrf
                        <input type="hidden" name="id">


                        <div class="row m-2">

                            <div class="form-group col-md-12">
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


                                <label class="text-dark my-3"> Porcentaje </label>
                                <input type="number" name="percent" class="form-control">


                                <div class="custom-control custom-switch w-100 my-5">
                                    <input type="checkbox" class="custom-control-input" name="main"
                                        id="tecnicoPrincipal">
                                    <label class="custom-control-label" style="cursor:pointer"
                                        for="tecnicoPrincipal">¿Tecnico Principal?</label>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btnSaveAddTecnico" class="btn btn-primary">Enviar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>