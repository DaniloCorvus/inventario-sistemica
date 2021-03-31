@extends('layouts.app')
@section('content')


@if (session('success'))

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Excelente!</strong> {{ session('success') }}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif

@if (session('Error'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Excelente!</strong> {{ session('Error') }}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">

                <div class="float-right">
                    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip"
                        data-placement="top" title="" data-original-title="Regresar">
                        <i class="fas fa-reply text-primary"></i>
                    </a>

                    <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
                        data-target="#modalUserRegister" title="Registrar">
                        <i class="fa fa-edit btn btn-icon text-success"></i>
                    </a>

                </div>
                <h5 class="mb-2 font-italic">Usuarios</h5>

                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered " id="dataTableUsers" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.users.partials.formRegister')
@include('admin.users.partials.formUserUpdate')

@stop
@push('scripts')
<script src="{{ asset('/apis/apiUser.js') }}"></script>
@endpush