<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Información del Usuario</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Infromación del Atleta</h1>

        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="text-left mt-4">
                    <a href="menu_principal_entrenador.html" class="btn btn-primary mb-3">Regresar</a>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" value="Axel Rosado" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electronico</label>
                    <input type="email" class="form-control" id="email" value="xxxxxxxxxx@upr.edu" disabled>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Número de Telefono</label>
                    <input type="text" class="form-control" id="phone" value="(xxx) xxx - xxxx" disabled>
                </div>
                <div class="mb-3" >
                    <a heref="logout" class ="btn btn-danger">Invalidar Cuenta</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
