<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Información del Atleta</title>
    <a href="/atlhome" style="text-decoration: none;">
        <div class="logo-container">
            <div class="logo-text">LTSMT</div>
        </div>
    </a>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Información del Atleta</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <a href="/atlhome" class="btn btn-primary mb-3">Regresar</a>

                    <a href="{{route('atleta.edit', ['user' => $user])}}" class="btn btn-primary mb-3">Editar Información</a>
                </div>
                <div class="mb-3">
                    <h5><label class="form-label">Nombre:</label> <span class="form-label" id="nombre"> {{ $user->first_name }} {{ $user->last_name }}</span>
                </div>
                <div class="mb-3">
                    <h5><label class="form-label">Correo Electrónico:</label> <span class="form-label" id="correo"> {{$user->email}} </span>
                </div>
                <div class="mb-3">
                    <h5><label class="form-label">Número de Teléfono:</label> <span class="form-label" id="telefono"> {{$user->phone_number}} </span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="/atletainfo/athlete/password" class="btn btn-primary">Cambiar Contraseña</a>
                    <!-- Logout Button Trigger -->
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal">Terminar Sesión</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmLogoutModalLabel">Confirmar Terminación de Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas terminar tu sesión?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form class="form" action="{{route('atlogout')}}" method="post" id="logoutForm">
                        @csrf
                        <button type="submit" class="btn btn-danger" id="logoutConfirmButton">Terminar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutConfirmButton = document.getElementById('logoutConfirmButton');
            const logoutForm = document.getElementById('logoutForm');

            logoutForm.addEventListener('submit', function() {
                logoutConfirmButton.disabled = true;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
