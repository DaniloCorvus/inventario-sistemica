<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal
    id="modalHistoriaRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar Historia
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formHistoriaRegister" method="POST" action="{{route('historias-venta.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                        <input type="hidden" name="venta_id" value="{{$venta->id}}">

                            {{-- <!-- <div class="form-group col-md-6">
                                <label class="text-dark"> Tipo de Modo </label>
                                <select name="modo_id" class="form-control" required>
                                    @if (isset($modos) && count($modos)>0)
                                    @foreach ($modos as $modo)
                                    <option value="{{$modo->id}}">{{$modo->nombre}}</option>
                                    @endforeach
                                    @else
                                    <option>Sin Tipo de Modos</option>
                                    @endif
                                </select>
                            </div> --> --}}


                            <div class="form-group col-md-12">
                                <label class="text-dark">Observación</label>
                                <textarea type="text" cols="15" class="form-control" required
                                    name="descripcion"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-outline-info  btn-sm " id="btnSaveHistoria"
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
