<div class="modal fade mt-5" tabindex="-1" role="dialog" data-backdrop="static" data-ajax-modal id="modalUserRegister">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">

            <div class="card-header text-dark">Registrar User
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="card-body">

                <form id="formUserRegister" method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="identificacion"
                            class="col-md-4 col-form-label text-md-right">{{ __('Identificacion') }}</label>
                        <div class="col-md-6">
                            <input tag="identificacion" type="text" class="form-control" name="identificacion" required
                                autocomplete="identificacion">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input tag="name" type="text" class="form-control " name="name" value="{{ old('name') }}"
                                required autocomplete="name" autofocus>


                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input tag="email" type="email" class="form-control " name="email"
                                value="{{ old('email') }}" required autocomplete="email">


                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input tag="password" type="password" class="form-control " name="password" required
                                autocomplete="new-password">


                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input tag="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>



                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" id="btnSaveUser" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>