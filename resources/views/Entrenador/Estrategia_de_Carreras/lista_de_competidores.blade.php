<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <title>Lista de Competidores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <a href="/home" style="text-decoration: none;">
        <div class="logo-container">
            <div class="logo-text">LTSMT</div>
        </div>
    </a>

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
        <h1 class="text-center">Lista de Competidores</h1>
        <h2 class="text-center">{{$competition->cname}}</h2>
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('competition.show', ['competition' => $competition->id]) }}" class="btn btn-primary">Regresar</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompetitorModal">Añadir Competidores</button>
        </div>
        <div class="d-grid gap-3">
            <!-- Lista de competidores con sus eventos -->
                @foreach($competitors as $competitor)
                <button class="btn btn-primary btn-lg" onclick="location.href='{{ route('competitors.listing', $competitor->id) }}'"> {{ $competitor->users->first_name }} {{$competitor->users->last_name}}</button>
                <!-- Más botones de competidores pueden ser añadidos aquí -->
                @endforeach
        </div>
    </div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="addCompetitorModal" tabindex="-1" aria-labelledby="addCompetitorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCompetitorModalLabel">Añadir Competidor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Formulario para añadir competidor -->
                <form id="addCompetitorForm" method="POST" action="{{ route('competition.atleta') }}">
                    @csrf
                    <!-- Lista desplegable de competidores -->
                            <!-- Selector de atletas con búsqueda -->
                    <input type="hidden" name="competition_id" value="{{ $competition->id }}">
                    <div class="mb-3">
                        <label for="athleteSelector" class="form-label">Asignar a Atleta:</label>
                        <select class="form-control" id="athleteSelector" name="users_id">
                            <!-- Las opciones se pueden cargar dinámicamente desde una base de datos -->
                            <option></option> <!-- Opción vacía para la búsqueda -->
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{$user->first_name}} {{$user->last_name}}</option>
                            @endforeach
                            <!-- más atletas -->
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="competitorSelect" class="form-label">Selecciona un Competidor</label>
                        <select class="form-select" id="competitorSelect">
                            <option selected>Elige un competidor</option>
                            <option value="1">Competidor 1</option>
                            <option value="2">Competidor 2</option>
                            <option value="3">Competidor 3</option>
                        </select>
                    </div> --}}

                    {{-- <!-- Sección de eventos -->
                    <div id="eventsSection">
                        <!-- Un solo conjunto de evento y tiempo para empezar -->
                        <div class="event-time-pair mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <label class="form-label me-2">Evento</label>
                                <select class="form-select me-2">
                                    <option selected>Elige un evento</option>
                                    <option value="800">800m</option>
                                    <option value="1500">1500m</option>
                                    <option value="3000obs">3000m Obs</option>
                                    <option value="5k">5k</option>
                                    <option value="10k">10k</option>
                                </select>
                                <input type="text" class="form-control me-2" placeholder="mm:ss">
                                <button type="button" class="btn btn-success add-event">+</button>
                            </div>
                        </div>
                    </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="addCompetitorForm" class="btn btn-primary">Añadir</button>
            </div>
                </form>
        </div>
    </div>
</div>

</div>
<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Disable Bootstrap's modal focus management -->
<script>
    $.fn.modal.Constructor.prototype._enforceFocus = function() {};
</script>

<script>
    /*function setCompetitionId(competitionId) {
        document.getElementById('competitionIdInput').value = competitionId;
    }*/
</script>

<!-- Initialize Select2 with proper configurations -->
<script>
    $(document).ready(function() {
        $('#athleteSelector').select2({
            placeholder: "Selecciona un atleta",
            dropdownParent: $('#addCompetitorModal'),
            allowClear: true
        });

        // Close Select2 on modal close
        $('#addCompetitorModal').on('hidden.bs.modal', function () {
            $('#athleteSelector').select2('close');
        });
    });
</script>

<!-- Additional event handling script if necessary -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const eventsSection = document.getElementById('eventsSection');

        eventsSection.addEventListener('click', function(event) {
            if (event.target.classList.contains('add-event')) {
                const newEventTimePair = event.target.parentElement.cloneNode(true);
                newEventTimePair.querySelector('.add-event').classList.replace('btn-success', 'btn-danger');
                newEventTimePair.querySelector('.add-event').textContent = '-';
                newEventTimePair.querySelector('.add-event').classList.replace('add-event', 'remove-event');
                newEventTimePair.querySelector('select').selectedIndex = 0;
                newEventTimePair.querySelector('input').value = '';
                eventsSection.appendChild(newEventTimePair);
            } else if (event.target.classList.contains('remove-event')) {
                event.target.parentElement.remove();
            }
        });
    });
</script>

</body>
</html>
