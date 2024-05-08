<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Información del Entrenador</title>
    <a href="/home" style="text-decoration: none;">
        <div class="logo-container">
            <div class="logo-text">LTSMT</div>
        </div>
    </a>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

        <nav class="navbar custom-navbar">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">Menú Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/lista">Lista de Atletas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/schedule">Registro de Entrenamientos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/competition">Lista de Competencias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/light">Sistema de Luces</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1 class="text-center">Información del Entrenador</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <a href="/home" class="btn btn-primary mb-3">Regresar</a> {{-- 🡸 --}}
                    <a href="{{route('entrenador.edit', ['user' => $user])}}" class="btn btn-primary mb-3">Editar Información</a>
                </div>
                <div class="card mb-3 mt-3">
                    <div class="card-body text-center">
                <div class="mb-3">
                    <h5><label class="form-label">Nombre:</label> <span class="form-label" id="nombre" > {{ $user->first_name }} {{ $user->last_name }}</span>
                </div>
                <hr>
                <div class="mb-3">
                    <h5><label class="form-label">Correo Electrónico:</label> <span class="form-label" id="correo" > {{$user->email}}</span>
                </div>
                <hr>
                <div class="mb-3">
                    <h5><label class="form-label">Número de Teléfono:</label> <span class="form-label" id="telefono" > {{$user->phone_number}}</span>
                </div>
            </div>
        </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="/entrenadorinfo/coach/password" class="btn btn-primary mt-3">Cambiar Contraseña</a>
                        <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal">Terminar Sesión </button>
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
                    <form class="form" action="{{route('logout')}}" method="post" id="logoutForm">
                        @csrf
                        <button type="submit" class="btn btn-danger" id="logoutConfirmButton">Terminar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneNumberSpan = document.getElementById('telefono');
            const phoneNumber = phoneNumberSpan.textContent.trim();
            const formattedPhoneNumber = formatPhoneNumber(phoneNumber);
            phoneNumberSpan.textContent = formattedPhoneNumber;

            const logoutConfirmButton = document.getElementById('logoutConfirmButton');
            const logoutForm = document.getElementById('logoutForm');

            logoutForm.addEventListener('submit', function() {
                logoutConfirmButton.disabled = true;
            });
        });

        function formatPhoneNumber(phoneNumber) {
            // Remove any non-digit characters from the phone number
            const cleaned = ('' + phoneNumber).replace(/\D/g, '');

            // Match and extract groups from the cleaned phone number
            const match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);

            if (match) {
                // Format the phone number as (###) ###-####
                return '(' + match[1] + ') ' + match[2] + ' - ' + match[3];
            }

            return phoneNumber; // Return original phone number if the format is invalid
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
