@extends('layouts.app')
@section('content')

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

    <a href="{{route('evidencias.index')}}" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title=""
        data-original-title="Regresar">
        <i class="fa fa-reply btn btn-icon text-info"></i>
    </a>

    <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
        data-target="#modalDocumentacionRegister" title="subir">
        <i class="fa fa-edit btn btn-icon text-success"></i>
    </a>

</div>


<div class="row magnific-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <h4 class="card-title"> evidencias Cargados </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @foreach($service->evidencia as $item)

    <table>
        <tbody>
            <div class="card col-md-4 p-3 ">
                <div class="card-title">
                    <h5 class="card-title">{{$item->descripcion}}</h5>
                </div>
                <div class="card-body">
                    <a href="{{'/file/'. $item->img }}" data-lightbox="photos"><img class="img-fluid"
                            src="{{'/file/'. $item->img }}">
                    </a>
                </div>
                <div class="card-footer bg-white">

                    <a class="btn btn-danger delete-documento" href="javascript:void(0)" data-toggle="tooltip"
                        title="Eliminar" data-id="{{ $item->id }}">
                        <i class="fa fa-fw fa-trash"></i>
                    </a>

                </div>
            </div>

        </tbody>
    </table>

    @endforeach


</div>

@include('admin.evidencias.partials.formDocumentacionRegister')

@stop

@section('scripts')
<script src="{{ asset('/js/apiEvidencia.js') }}"></script>
@endsection