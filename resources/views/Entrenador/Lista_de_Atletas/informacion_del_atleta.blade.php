<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Información del Atleta</title>
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Información del Atleta</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <a href="registro_del_atleta" class="btn btn-primary mb-3">Regresar</a>
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
                <div class="d-flex justify-content-end align-items-center mb-4">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#invalidateSessionModal">Invalidar Sesión</button>
                </div>
                <!-- Formulario oculto para la invalidación de la sesión -->
                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para confirmación de invalidación de sesión -->
    <div class="modal fade" id="invalidateSessionModal" tabindex="-1" aria-labelledby="invalidateSessionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invalidateSessionModalLabel">Confirmar Invalidación de Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de querer invalidar esta sesión?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('logout-form').submit();">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
