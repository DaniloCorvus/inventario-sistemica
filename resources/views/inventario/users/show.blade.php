@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    <a href="javascript:history.back()"
                        class="tooltip-wrapper btn btn-circle text-white  btn-success mr-1" title=""
                        data-original-title="Regresar">
                        <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
                    </a>

                    <a href="javascript:void(0)" class="tooltip-wrapper btn btn-circle text-white  btn-primary mr-1"
                        data-toggle="modal" data-placement="top" data-target="#modalUser_RoleRegister"
                        title="Nuevo Rol">
                        <i class="fa fa-fw fa-plus"></i>
                    </a>
                    Roles
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush table-hover" style="font-size: 0.8em"
                    id="dataTableRol">
                    <thead class="thead">
                        <tr>
                            <th>S. No</th>
                            <th>Roll</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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