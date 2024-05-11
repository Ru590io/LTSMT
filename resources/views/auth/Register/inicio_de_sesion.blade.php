<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio de Sesión</title>
    <link href= "{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>

    <div class="container">
        <h1 class="text-center">Inicio de Sesión</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                @if(session()->has('Exito'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('Exito')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($errors->has('email') || $errors->has('password'))
                <div class="alert alert-danger">
                    {{ $errors->first('email') ?? $errors->first('password') }}
                </div>
                @endif

                @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
                @endif

                {{--@if ($errors->has('throttle'))
                <div class="alert alert-warning">
                    {{ $errors->first('throttle') }}
                </div>
                @endif--}}
                <!-- Login form -->
                <form class= "form mt-5" action="{{route('login')}}" method="post">
                    @csrf
                <form>
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>

                        <input type="email" class="form-control" name="email" id="email" placeholder="Escriba su correo electrónico" value="{{ old('uemail') }}" required autocomplete="uemail" autofocus pattern="[a-zA-Z0-9._%+-@]+upr\.edu$" maxlength="60" title="Debe ser un correo electrónico de la UPR, sin acentos.">
                        @error('email')

                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Escriba su contraseña" value="{{ old('upassword') }}" required autocomplete="upassword" autofocus pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$" title="La contraseña debe contener al menos una letra minúscula, una mayúscula, un número y un carácter especial. Longitud de 8 a 16 caracteres.">
                        @error('password')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recuerdame') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="loginButton" class="btn btn-primary">Iniciar Sesión</button>
                    <a href="/register" class="btn btn-primary">Registrarse</a>
                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Se le olvido la contraseña?') }}
                                    </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Check if email or password is empty
            if (email.trim() === '' || password.trim() === '') {
                // Show missing field alert if either email or password is empty
                document.getElementById('missingFieldAlert').classList.remove('d-none');
                document.getElementById('loginAlert').classList.add('d-none');
                document.getElementById('invalidEmailAlert').classList.add('d-none');
            } else if (!email.endsWith('@upr.edu')) {
                // Show invalid email format alert if email does not end with '@upr.edu'
                document.getElementById('invalidEmailAlert').classList.remove('d-none');
                document.getElementById('loginAlert').classList.add('d-none');
                document.getElementById('missingFieldAlert').classList.add('d-none');
            } else {
                // Hide any previous alert messages
                document.getElementById('missingFieldAlert').classList.add('d-none');
                document.getElementById('invalidEmailAlert').classList.add('d-none');

                // Check if email and password match expected values (dummy validation)
                if (email === 'athlete@upr.edu' && password === 'apassword') {
                    // Redirect to athlete_main_menu if login is successful
                    window.location.href = '/menu_principal_atleta.html';
                } else if (email === 'coach@upr.edu' && password === 'cpassword') {
                    // Redirect to coach_main_menu if login is successful
                    window.location.href = '/menu_principal_entrenador.html';
                } else {
                    // Show error message if login fails
                    document.getElementById('loginAlert').classList.remove('d-none');
                }

            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const loginButton = document.getElementById('loginButton');

    // Check if there's a throttle time set by Laravel and disable the button accordingly
        @if ($errors->has('throttle'))
        // Laravel passes the remaining time in seconds, JavaScript needs milliseconds
        const throttleTime = {{ $errors->first('throttle') }} * 1000;
        loginButton.disabled = true;

        setTimeout(() => {
            loginButton.disabled = false;
        }, throttleTime);
        @endif
    });
    </script>
</body>
</html>
