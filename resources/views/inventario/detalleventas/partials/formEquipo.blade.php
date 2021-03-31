<div class="card mb-0">
    <br>
    <h6 class="text text-center font-weight-bold text-danger"> Historia del Equipo </h6>

    <div class="row mt-5">
        <div class="table-responsive p-3 col-md-12 ">
            <table class="table align-items-center table-flush table-hover">
                <thead class="thead">
                    <tr>
                        <th> Fecha Ingreso </th>
                        <th> Fecha Reparado</th>
                        <th> Fecha Entrega </th>
                        <th> Cliente </th>
                        <th> Doc Cliente</th>
                        <th> Reporte </th>
                        <th> Cargo </th>
                        <th> Repuestos </th>
                    </tr>
                </thead>
                <tbody id="mhBody"></tbody>
            </table>
        </div>
    </div>
    <form id="formEquipoUpdate" method="" action="{{route('equipos.update')}}">
        @csrf
        @method('PATCH')
        <div class="modal-body">
            <div class="row">

                <input type="hidden" name="id">

                <div class="form-group col-md-6">
                    <label class="text-dark"> Numero de Factura </label>
                    <input type="text" class="form-control" name="num_factura" placeholder="">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Fecha Compra </label>
                    <input type="date" class="form-control" name="fecha_compra" placeholder="">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Descipcion </label>
                    <select name="descripcion" class="form-control" required>
                        @if (isset($descripciones) && count($descripciones)>0)
                        @foreach ($descripciones as $descripcion)
                        <option value="{{$descripcion->id}}">{{$descripcion->nombre}}</option>
                        @endforeach
                        @else
                        <option>Sin marcas</option>
                        @endif
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Marca </label>
                    <select name="marca" class="form-control" required>
                        @if (isset($marcas) && count($marcas)>0)
                        @foreach ($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                        @endforeach
                        @else
                        <option>Sin marcas</option>
                        @endif
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Modelo </label>
                    <input type="text" class="form-control" required="required" name="modelo" placeholder="">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Serie </label>
                    <input type="text" class="form-control" required="required" name="serie" placeholder="">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Imei </label>
                    <input type="text" class="form-control" name="imei_uno" placeholder="">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Imei (Opcional) </label>
                    <input type="text" class="form-control" name="imei_dos" placeholder="">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark"> Almacen de procedencia </label>
                    <input type="text" class="form-control" name="procedencia" placeholder="">
                </div>


                <div class="form-group col-md-6">
                    <label class="text-dark"> Garantia </label>
                    <input type="text" class="form-control" name="garantia" placeholder="">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-dark">Referencia </label>
                    <input type="text" class="form-control" name="referencia" placeholder="">
                </div>

                <div class="form-group col-md-12">
                    <label class="text-dark">Ubicación del producto en la bodega</label>
                    <textarea type="text" rows="1" class="form-control" name="observacion" placeholder=""></textarea>
                </div>

                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-outline-info  btn-sm " id="btnUpdateEquipo" value="Enviar">
                </div>
            </div>
        </div>
    </form>


</div>