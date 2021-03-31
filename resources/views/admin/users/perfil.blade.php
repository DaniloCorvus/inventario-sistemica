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
                </div>

                <div class="bg-white text-dark">Actualizar Contraseña</div>

                @if (Session::has('success'))
                <h3 class="w-100 alert-success form-control">{{Session::get('success')}}</h3>
                @endif

                @if (Session::has('Error'))
                <h3 class="w-100 alert-danger form-control">{{Session::get('Error')}}</h3>
                @endif


                <form method="POST" id="confirm" action="{{ route('users.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label for="password"
                            class="col-md-4 col-form-label text-md-right">{{ __('Contraseña antigua') }}</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control " name="password_old" required
                                autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"
                            class="col-md-4 col-form-label text-md-right">{{ __(' Nueva Contraseña ') }}</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control " name="new_password" required
                                autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"
                            class="col-md-4 col-form-label text-md-right">{{ __(' Confirmar contraseña ') }}</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control " name="confirm_password" required
                                autocomplete="confim-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" id="btnEnviar" class="btn btn-primary">
                                {{ __('Actualizar') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script>
    const form = document.querySelector('#confirm')
    const confirm = document.querySelector('#btnEnviar')
    confirm.addEventListener('click', (e) => {
            e.preventDefault()
        if (form.new_password.value == form.confirm_password.value){
            form.submit();
        }else{
            alert("Las contraseñas no coinciden");
            return false;
        }
    })
</script>
@endpush