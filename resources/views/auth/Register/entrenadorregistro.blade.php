<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro</title>
    <link href="{{asset('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>

    <div class="container">
        <h1 class="text-center">Registro</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form class= "form mt-5" action="{{route('registers')}}" method="post">
                    @csrf
                <form>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Nombre</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" class="Escriba su nombre" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus pattern="[a-zA-Z\sáéíóúñ]{1,25}" maxlength="25" title="Solo letras y espacios, hasta 25 caracteres.">
                        @error('first_name')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Apellido</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" class="Escriba sus apellidos" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus pattern="[a-zA-Z\sáéíóúñ]{1,25}" maxlength="25" title="Solo letras y espacios, hasta 25 caracteres.">
                        @error('last_name')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Escriba su correo electrónico" value="{{ old('email') }}" required autocomplete="email" placeholder="Escriba su correo electrónico institucional (@upr.edu)" value="{{ old('email') }}" required pattern="[a-zA-Z0-9._%+-@]+upr\.edu$" title="Debe ser un correo electrónico de la UPR, sin acentos." autofocus>
                        @error('email')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Escriba su contraseña" minlength="8" maxlength="16" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$" title="La contraseña debe contener al menos una letra minúscula, una mayúscula, un número y un carácter especial. Longitud de 8 a 16 caracteres." required>
                        <label class="form-label" style="font-size: 0.8rem;">Contraseña debe tener Mayúsculas, números, símbolos y no mayor de 16 caracteres.</label>
                        @error('password')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" id="confirm-password" placeholder="Confirme su contraseña" minlength="8" maxlength="16" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$" title="La contraseña debe contener al menos una letra minúscula, una mayúscula, un número y un carácter especial. Longitud de 8 a 16 caracteres." required>
                        @error('password_confirmation')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Número de Teléfono</label>
                        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Escriba su número de telefono (Ej. 7872224444)" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus pattern="\d{10}" maxlength="10" title="Debe ser un número de 10 dígitos." required>
                        @error('phone_number')
                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Completar Registro</button>
                    <a href="/login" class="btn btn-link">Regresar a Inicio de Sesión</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
</body>

</html>
