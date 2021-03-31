@extends('layouts.app')
@section('content')

<!-- Row -->
<div class="row">

    <div class="ml-auto d-flex align-items-center secondary-menu text-center m-2">

        <a href="javascript:history.back()" class="tooltip-wrapper btn btn-circle btn-success mr-1" title=""
            data-original-title="Regresar">
            <i class="mr-2 fa fa-reply " aria-hidden="true"></i>
        </a>

    </div>

    <!-- DataTable with Hover -->
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="mr-2 font-weight-bold text-primary ">
                    Servicios
                </h6>
            </div>
            <div class="row w-100">
                <div class="col-md-12">
                    <form action="/services/informe/filter/" method="get">
                        @csrf

                        <div class="row p-3">

                            <div class="col-md-6 my-3">
                                <label for="">Tecnico</label>
                                <select class="custom-select" name="tecnico" id="">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}"> {{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 my-3">
                                <label for="">Descarga</label>
                                <select class="custom-select" name="option" id="">
                                    <option value="pdf">Pdf</option>
                                    <option value="excel">Excel</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <input type="text" class="form-control" id="min" name="min" placeholder="De:"
                                    onfocus="(this.type='date')">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="max" name="max" placeholder="Hasta:"
                                    onfocus="(this.type='date')">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Filtrar</button>
                            </div>
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@push('scripts')
<script async src="{{ asset('/js/evalfecha.js') }}"></script>
@endpush