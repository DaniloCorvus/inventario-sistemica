<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-logo ">
                        <img src="img/me.png" class="img-fluid" style="border-radius: 0%; background: ;" alt="...">
                    </span>

                    <span class="login100-form-title mb-3">
                        {{-- Ingreso --}}
                    </span>

                    @if (Session::has('errors'))
                    @foreach (Session::get('errors')->all() as $item)
                    <li class="alert-danger form-control">
                        {{$item}}
                    </li>
                    @endforeach
                    @endif

                    <div class="wrap-input100 validate-input mt-3" data-validate="Enter Numero de identidad">
                        <input style="border-radius: 10px;" class="input100 text-white" type="text"
                            name="identificacion" placeholder="Numero de identidad" autofocus
                            aria-autocomplete="inline">
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input style="border-radius: 10px;" class="input100" type="password" name="password"
                            placeholder="Contraseña">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="rememberme">
                        <label class="label-checkbox100" for="ckb1">
                            Recuerdame
                        </label>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Ingresar
                        </button>
                    </div>

                    <div class="text-center p-t-90 m-2">
                        <a class="txt1" href="{{route('password.request')}}">
                            Olvidaste tu Contraseña?
                        </a>
                    </div>

                </form>


            </div>
        </div>
    </div>
</body>

</html>