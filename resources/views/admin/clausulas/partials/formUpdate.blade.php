<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalClausulaUpdate">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Actualizar Clausula
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formClausulaUpdate" method="" action="{{route('clausulas.update')}}">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="id">

                            <div class="form-group col-md-6">
                                <label class="text-dark"> Tipo de Servicio </label>
                                <select name="marca_id" class="form-control" required>
                                    @if (isset($marcas) && count($marcas)>0)
                                    @foreach ($marcas as $marca)
                                    <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Marcas registradas</option>
                                    @endif
                                </select>
                            </div>


                            <div class="form-group col-md-12">
                                <label class="text-dark"> Clausula </label>
                                <input type="text" class="form-control" required="required" name="nombre"
                                    placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="text-dark"> Descripcion </label>
                                <textarea type="text" rows="5" class="form-control" required="required"
                                    name="descripcion" placeholder=""></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdateClausula"
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
