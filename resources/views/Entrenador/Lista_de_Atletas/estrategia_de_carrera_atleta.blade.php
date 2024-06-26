<!-- estrategia_de_carrera_atleta.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Estrategia de Carrera</title>
    <a href="/home" style="text-decoration: none;">
        <div class="logo-container">
            <div class="logo-text">LTSMT</div>
        </div>
    </a>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link href="{{asset('Css/styles.css')}}" rel="stylesheet">
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
        <h1 class="text-center">Competencias del Atleta</h1>
        <h2 class="text-center mt-5">{{ $user->first_name }} {{ $user->last_name }}</h2>

        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="{{ route('athlete.details', ['user'=> $user->id]) }}" class="btn btn-primary">Regresar</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompetitionModal">Agregar Competencia</button>
        </div>
        <div class="d-grid gap-3">
            @if($user_competitions->isEmpty())
            <h5 class="text-center">{{ $user->first_name }} {{ $user->last_name }} no está inscrito en una competencia actualmente.</h5>
            @else
            @foreach($user_competitions as $competition)
                <a href="{{ route('competition.details', ['user' => $user->id, 'competition' => $competition->id]) }}" class="btn btn-primary btn-lg">{{ $competition->cname }}</a>
            @endforeach
        @endif
            <div class="d-flex justify-content-center mt-3">
                {{ $user_competitions->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="addCompetitionModal" tabindex="-1" aria-labelledby="addCompetitionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCompetitionModalLabel">Agregar Competencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="competitionForm" action="{{ route('competition.atleta') }}" method="POST" onsubmit="return validateForm()">
                    @csrf
                    <input type="hidden" name="users_id" value="{{ $user->id }}">
                    <div class="mb-3">
                        <label for="competitionSelect" class="form-label">Selecciona una Competencia</label>
                        <select class="form-select" id="competitionSelect" name="competition_id">
                            @foreach($all_competitions as $competition)
                                <option value="{{ $competition->id }}">{{ $competition->cname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="guardarButton">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

{{-- Este codigo previene spam de guardar pero no es necesario y tranca la pagina si se da gaurdar sin seleccionar una compe --}}
{{--
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('competitionForm');
        const guardarButton = document.getElementById('guardarButton');

        form.addEventListener('submit', function() {
            guardarButton.disabled = true;
        });
    });
</script> --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('competitionForm');
    const competitionSelect = document.getElementById('competitionSelect');

    form.addEventListener('submit', function(event) {
        if (competitionSelect.value === "") {
            event.preventDefault(); // Prevent form from submitting
            alert('Por favor, selecciona una competencia antes de guardar.');
            return false;
        }
        form.submit();
    });
});
</script>

