<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Atletas con Cuentas Desactivadas</title>
    <link href="{{asset('Css/styles.css')}}" rel="stylesheet">
    <a href="/home" style="text-decoration: none;">
        <div class="logo-container">
            <div class="logo-text">LTSMT</div>
        </div>
    </a>
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
        <h1 class="text-center mb-4">Atletas con Cuentas Desactivadas</h1>
        @if(session()->has('Exito'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('Exito')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
        <a href="/lista" class="btn btn-primary mb-4">Regresar</a>

            <!-- List of athletes with invalid accounts -->
            <div class="list-group" id="inactiveAthletesList">
                @if($users->isEmpty())
                <h5 class="text-center">No Hay Cuentas Desactivadas.</h5>
                @else
                @foreach ($users as $user)
                <div class="list-group-item d-flex justify-content-between align-items-center" data-name="{{ $user->first_name }} {{ $user->last_name }}">
                    <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
                    <button class="btn btn-primary rehabilitarButton mb-2 mt-3" data-bs-toggle="modal" data-bs-target="#confirmRestoreModal" data-userid="{{ $user->id }}">Activar Cuenta</button>
                </div>
                @endforeach
            </div>
            @endif
            <div class="d-flex justify-content-center mt-3">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>

        <!-- Confirmation Modal -->
        <div class="modal fade" id="confirmRestoreModal" tabindex="-1" aria-labelledby="confirmRestoreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmRestoreModalLabel">Confirmar Activación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas activar esta cuenta?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('users.restore', ':id') }}" method="POST" id="confirmRestoreForm">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary" id="confirmRestoreButton">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.rehabilitarButton');
            const confirmRestoreForm = document.getElementById('confirmRestoreForm');
            const confirmRestoreButton = document.getElementById('confirmRestoreButton');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-userid');
                    confirmRestoreForm.action = confirmRestoreForm.action.replace(':id', userId);
                });
            });

            confirmRestoreForm.addEventListener('submit', function() {
                confirmRestoreButton.disabled = true;
            });
        });
    </script>

</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
