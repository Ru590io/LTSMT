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
            @if(session()->has('Exito'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('Exito')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
            @endif
            <a href="{{ route('competition.show', ['competition' => $competition->id]) }}" class="btn btn-primary">Regresar</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompetitorModal">Añadir Competidores</button>
        </div>
        <div class="d-grid gap-3">
            <!-- Check if there are any competitors -->
            @if($competitors->isEmpty())
                <h5 class="text-center">No hay competidores registrados.</h5>
            @else
            <!-- Lista de competidores con sus eventos -->
            <input type="text" id="searchInput" onkeyup="filterList()" placeholder="Buscar competidores..." class="form-control mb-3">

                @foreach($competitors as $competitor)
                <button class="btn btn-primary btn-lg competitor-btn" onclick="location.href='{{ route('competitors.listing', $competitor->id) }}'"> {{ $competitor->users->first_name }} {{$competitor->users->last_name}}</button>
                <!-- Más botones de competidores pueden ser añadidos aquí -->
                @endforeach
            @endif
        </div>
    </div>
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
                <form id="addCompetitorForm" method="POST" action="{{ route('competition.atleta') }}" onsubmit="return validateForm()">
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
    function validateForm() {
        var selectedAthlete = $('#athleteSelector').val();
        if (!selectedAthlete) {
            alert('Por favor, selecciona un atleta.');
            return false;
        }
        return true;
    }
</script>

<script>
    function filterList() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toUpperCase();
        let buttons = document.getElementsByClassName('competitor-btn');

        for (let i = 0; i < buttons.length; i++) {
            let txtValue = buttons[i].textContent || buttons[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                buttons[i].style.display = "";
            } else {
                buttons[i].style.display = "none";
            }
        }
    }
    </script>



</body>
</html>
