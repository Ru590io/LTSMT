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
    <link href="{{asset('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        @if(session()->has('Exito'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('Exito')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                </div>
                @endif
        <h1 class="text-center">Información del Atleta</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <a href="/atlhome" class="btn btn-primary mb-3">Regresar</a>

                    <a href="{{route('atleta.edit', ['user' => $user])}}" class="btn btn-primary mb-3">Editar Información</a>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">
                <div class="mb-3">
                    <h5><label class="form-label">Nombre:</label> <span class="form-label" id="nombre"> {{ $user->first_name }} {{ $user->last_name }}</span>
                </div>
                <hr>
                <div class="mb-3">
                    <h5><label class="form-label">Correo Electrónico:</label> <span class="form-label" id="correo"> {{$user->email}} </span>
                </div>
                <hr>
                <div class="mb-3">
                    <h5><label class="form-label">Número de Teléfono:</label> <span class="form-label" id="telefono"> {{$user->phone_number}} </span>
                </div>
            </div>
        </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{route('password.edits', ['user' => $user])}}" class="btn btn-primary">Cambiar Contraseña</a>
                    <!-- Logout Button Trigger -->
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal" id="logoutButton">Terminar Sesión</button>
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
