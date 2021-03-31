<div class="card mb-0">

    @if(Session::has('flash_message'))
    <div class="row">
        <div class="col-12 mb-2">
            <div class="alert alert-info alert-icon" role="alert">
                <i class="fa fa-info-circle"></i> {{Session::get('flash_message')}}
            </div>
        </div>
    </div>
    @endif

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
            data-target="#modalEvidenciaRegister" title="subir">
            <i class="fa fa-edit btn btn-icon text-success"></i>
        </a>

    </div>
    <div class="row magnific-wrapper">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-center">
                    <h4 class="card-title"> Evidencias Cargados </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center" id="evidencias">

    </div>
</div>