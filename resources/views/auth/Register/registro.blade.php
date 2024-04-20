
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>

    <div class="container">
        <h1 class="text-center">Registro</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form class= "form mt-5" action="{{route('register')}}" method="post">
                    @csrf
                <form>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Nombre</label>
                        <input type="text" name="ufirst_name" class="form-control" id="ufirst_name" placeholder="Escriba su nombre (Ej. Juan Carlos)" value="{{ old('ufirst_name') }}" required autocomplete="ufirst_name" autofocus>
                        @error('ufirst_name')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Apellido</label>
                        <input type="text" name="ulast_name" class="form-control" id="ulast_name" placeholder="Escriba sus apellidos (Ej. Torrez Figueroa)" value="{{ old('ulast_name') }}" required autocomplete="ulast_name" autofocus>
                        @error('ulast_name')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="uemail" class="form-control" id="uemail" placeholder="Escriba su correo electrónico institucional (@upr.edu)" value="{{ old('uemail') }}" required autocomplete="uemail" autofocus>
                        @error('uemail')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="upassword" class="form-control" id="upassword" placeholder="Escriba su contraseñá">
                        <label class="form-label" style="font-size: 0.8rem;">Contraseña debe tener Mayúsculas, números, símbolos y no mayor de 16 caracteres.</label>
                        @error('upassword')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="upassword_confirmation" class="form-control" id="confirm-upassword" placeholder="Confirme su contraseñá">
                        @error('upassword_confirmation')
                                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Número de Teléfono</label>
                        <input type="text" name="uphone_number" class="form-control" id="uphone_number" placeholder="Escriba su número de telefono (Ej. 7872224444)" value="{{ old('uphone_number') }}" required autocomplete="uphone_number" autofocus>
                        @error('uphone_number')
                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="access-code" class="form-label">Código de Acceso</label>
                        <input type="text" class="form-control" id="access-code" placeholder="Escriba el código de acceso">
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
