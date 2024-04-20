<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Información del Atleta</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Información del Atleta</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <a href="menu_principal_entrenador.html" class="btn btn-primary mb-3">Regresar</a>
                    <a href="/edit_information.html" class="btn btn-primary mb-3">Editar Información</a>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre:</label> <span class="form-label"> Axel Rosado</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico:</label> <span class="form-label"> axel.rosado@upr.edu</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Número de Teléfono:</label> <span class="form-label"> (787) 735 - 4444</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="/change_password.html" class="btn btn-primary">Cambiar Contraseña</a>
                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">Terminar Sesión</button>
                </div>
                <form id="logout-form" action="{{route('logout')}}" method="post" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
