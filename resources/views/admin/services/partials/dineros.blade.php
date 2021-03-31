<div class="card mb-0">

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a class="btn btn-circle btn-danger mr-1" href="javascript:void(0)"
            onClick="registerDinero('{{ $service->id }}')" title="Dinero">
            <i class="fa fa-university" aria-hidden="true"></i>
        </a>

    </div>

    <div class="row">
        <div class="table-responsive p-3 col-md-12 ">
            <table class="table align-items-center table-flush table-hover" id="dataTableDinero">
                <caption class="text text-center font-weight-bold text-danger">Dineros <br> <small
                        id="tGastos"></small></caption>
                <thead class="thead">
                    <tr>

                        <td> Monto </td>
                        <td> Fecha </td>
                        <td> Observación </td>
                        <td> Usuario </td>
                        <td> Medio de recepcion</td>

                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>