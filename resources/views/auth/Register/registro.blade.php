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
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="username" placeholder="Escriba su nombre de usuario">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" placeholder="Escriba su correo electrónico">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Escriba su contraseñá">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Número de Teléfono</label>
                        <input type="text" class="form-control" id="phone" placeholder="Escriba su número de telefono">
                    </div>
                    <div class="mb-3">
                        <label for="access-code" class="form-label">Código de Acceso</label>
                        <input type="text" class="form-control" id="access-code" placeholder="Escriba el código de acceso">
                    </div>
                    <button type="submit" class="btn btn-primary">Completar Registro</button>
                    <a href="login.html" class="btn btn-link">Regresar a Inicio de Sesión</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
