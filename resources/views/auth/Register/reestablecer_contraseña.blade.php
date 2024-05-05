<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Restablecer Contraseña</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Restablecer Contraseña</h1>
        <div class="row justify-content-center mt-5">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('coach.index', ['user' => $user->id]) }}" class="btn btn-primary">Regresar</a>
                </div>

                <!--Need to update password.update route-->

                <form id="passwordForm" class= "form mt-3" action="{{route('password.updates')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input id="new-password" type="password" name="password" class="form-control" @error('password') is-invalid @enderror name="password" required autocomplete="new-password" id="password" placeholder="Escriba su nueva contraseña" maxlength="16" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$" title="La contraseña debe contener al menos una letra minúscula, una mayúscula, un número y un carácter especial. Longitud de 8 a 16 caracteres.">
                        @error('password')
                                <strong class="d-block fs-6 text-danger mt-2">{{$message}}</strong>

                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Confirmar Nueva Contraseña</label>
                        <input id="confirm-new-password" type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="Confirme su nueva contraseña" require maxlength="16" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$" title="La contraseña debe contener al menos una letra minúscula, una mayúscula, un número y un carácter especial. Longitud de 8 a 16 caracteres.">
                        @error('password_confirmation')
                                <strong class="d-block fs-6 text-danger mt-2">{{$message}}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<script>
    document.getElementById('passwordForm').addEventListener('submit', function(event) {
        var password = document.getElementById('new-password').value;
        var confirmPassword = document.getElementById('confirm-new-password').value;

        if (password !== confirmPassword) {
            alert('Las contraseñas no coinciden.');
            event.preventDefault(); // Evita que el formulario se envíe
        }
    });
</script>
