<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Información del Atleta</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container text-center my-4">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Editar Información del Atleta</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form>
                    @csrf
                    <div class="mb-3">
                        <a href="informacion_del_usuario_atleta" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <!-- Solo letras y espacios, máximo 50 caracteres -->
                        <input type="text" class="form-control" id="name" name="name" value="Axel Rosado" pattern="[a-zA-Z\sáéíóúñ]{1,50}" title="Solo letras y espacios, hasta 50 caracteres." required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <!-- Debe terminar en @upr.edu -->
                        <input type="email" class="form-control" id="email" name="email" value="axel.rosado@upr.edu" pattern=".*@upr\.edu$" title="Debe ser un correo electrónico de UPR." required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Número de Teléfono</label>
                        <!-- Solo números, 10 dígitos -->
                        <input type="tel" class="form-control" id="phone" name="phone" value="7877354444" pattern="\d{10}" title="Debe ser un número de 10 dígitos." required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
