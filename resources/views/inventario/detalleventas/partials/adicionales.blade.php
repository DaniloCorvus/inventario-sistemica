<div class="card mb-0">

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a class="btn btn-circle btn-danger mr-1" href="javascript:void(0)"
            onClick="registerGasto('{{ $service->id }}')" title="Gasto">
            <i class="fa fa-fw fa-minus"></i>
        </a>
        <a class="btn btn-circle btn-primary mr-1" href="javascript:void(0)"
            onClick="registerAdicional('{{ $service->id }}')" title="Adicional">
            <i class="fa fa-fw fa-plus"></i>
        </a>

    </div>

    <div class="row">

        <div class="table-responsive p-3 col-md-6 ">
            <table class="table align-items-center table-flush table-hover" id="dataTableGasto">
                <caption class="text text-center font-weight-bold text-danger">Gastos <br> <small
                        id="tGastos"></small></caption>
                <thead class="thead">
                    <tr>
                        <th>Nombre</th>
                        <th>valor</th>
                        <th>Resta</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="table-responsive p-3 col-md-6">
            <table class="table align-items-center table-flush table-hover" id="dataTableAdicional">
                <caption class="text text-center font-weight-bold text-danger">Adicionales <br> <small
                        id="tAdicionales"></small></caption>
                <thead class="thead">
                    <tr>
                        <th>Nombre</th>
                        <th>valor</th>
                        <th>Suma</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>