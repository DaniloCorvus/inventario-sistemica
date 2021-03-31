@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="text text-center font-italic font-weight-bol">
                        Servicio no encontrado
                    </h5>
                </div>

                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        <small>No Hemos podido encontra tu servicio : {{$query}}</small>
                    </div>

                    <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1"
                        data-original-title="Regresar" title="Regresar a pagina anterior">
                        <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection