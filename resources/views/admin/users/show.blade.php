@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="float-right">
                    <a href="javascript:history.back()" class="tooltip-wrapper" data-toggle="tooltip"
                        data-placement="top" title="" data-original-title="Regresar">
                        <i class="fa fa-reply text-primary"></i>
                    </a>

                    <a href="javascript:void(0)" class="tooltip-wrapper" data-toggle="modal" data-placement="top"
                        data-target="#modalUser_RoleRegister" title="Registrar">
                        <i class="fa fa-edit btn btn-icon text-success"></i>
                    </a>
                </div>

                <div class="export-table-wrapper table-responsive">
                    <table class="table table-bordered " id="dataTableRol" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Roll</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.roles.partials.formRegister')

<input type="hidden" name="user_id" id="user_id" value={{$user->id}}>

@stop
@push('scripts')
<script src="{{ asset('/apis/apiRol.js') }}"></script>
@endpush