<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalHistoriaRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Traslado de bodegas
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <form action="/traslado-inventario"  id="formTraslado" method="post">

                <div class="card-body row">
                    <div class="for-group col-md-6">
                        <label for="" class="tex-dark">Cantidad</label>
                    <input required type="number" name="cantidad" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Bodega </label>
                    <select name="cellar_id" class="selectpickerp custom-select m-2" style="width:100%" required>
                        @if (isset($bodegas) && count($bodegas)>0)
                        @foreach ($bodegas as $bodega)
                        <option value="{{$bodega->id}}">{{$bodega->nombre}}</option>
                        @endforeach
                        @else
                        <option>Sin bodegas</option>
                        @endif
                    </select>
                </div>

                <button id="btnTraslado" class="btn btn-success">Guardar</button>
            </form>
        </div>


        </div>
    </div>
</div>
