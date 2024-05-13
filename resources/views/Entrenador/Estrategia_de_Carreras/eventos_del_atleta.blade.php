@php
    $currentEvents = $competitor->events->count();
    $maxEventsAllowed = 5;
    $maxAdditionalEvents = $maxEventsAllowed - $currentEvents;
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos del Atleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h1 class="text-center">Eventos del Atleta</h1>
        <h2 class="text-center mt-2">{{ $competitor->competition->cname }} - {{ $competitor->users->first_name }} {{ $competitor->users->last_name }}</h2>
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
        <div class="d-flex justify-content-between mt-4 mb-3">

            <a href="{{route('competition.listatleta', $competitor->competition->id)}}" class="btn btn-primary">Regresar</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompetitorModal" id="addEventButton">Añadir Eventos</button>

        </div>

        <div class="card mb-5">
            <div class="card-header"><h3 class="centered-text">Eventos</h3></div>
            <div class="card-body">
                @if($competitor->events->isEmpty())
                <h5 class="text-center">{{ $competitor->users->first_name }} {{ $competitor->users->last_name }} no tiene eventos asignados.</h5>
                @else
                @foreach($competitor->events as $event)
                <p class="d-flex justify-content-between align-items-center">
                    Evento: {{$event->edistance}}  - Tiempo: {{sprintf('%02d:%02d', floor($event->etime_range / 60), $event->etime_range % 60)}}
                    <button class="btn btn-danger delete-event-btn" data-bs-toggle="modal" data-bs-target="#confirmRemoveEventModal" data-eventid="{{$event->id}}">Eliminar</button>
                    <hr>
                </p>
            @endforeach


                     @endif

            </div>
        </div>

        <div class="d-grid gap-3">
            <a href="{{ route('table.atleta', $competitor->id) }}" class="btn btn-primary btn-lg">Ver Split Tables</a>
        </div>

        <div class="d-grid gap-3 mt-3">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmRemoveAthleteModal">Remover Atleta de la Competencia</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCompetitorModal" tabindex="-1" aria-labelledby="
    " aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Añadir Eventos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para añadir competidor -->
                <form id="addCompetitorForm" method="POST" action="{{ route('event.add', $competitor->id) }}">
                        @csrf
                        <input type="hidden" name="competitor_id" value="{{ $competitor->id }}">
                        <!-- Sección de eventos -->
                        <div id="eventsSection">
                            <!-- Un solo conjunto de evento y tiempo para empezar -->
                            <div class="event-time-pair mb-3" data-index="0">
                                <div class="d-flex align-items-center mb-2">
                                    <label class="form-label me-2">Evento</label>
                                    <select class="form-select me-2" name="events[0][edistance]" id="edistance">
                                        <option value="800m">800m</option>
                                        <option value="1500m">1500m</option>
                                        <option value="3000m">3000m</options>
                                        <option value="5000m">5000m</options>
                                        <option value="10000m">10000m</options>
                                    </select>
                                    <input type="text" class="form-control me-2" placeholder="mm:ss" name="events[0][etime_range]" id="etime_range" placeholder="mm:ss" pattern="[0-9]{1,2}:[0-5][0-9]" maxlength="5" title="Formato: (MM:SS), Valor Máximo: 99:59" required>
                                    <button type="button" class="btn btn-success add-event">+</button>
                                   <button type="button" class="btn btn-danger remove-event" style="display: none;">-</button>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" form="addCompetitorForm" class="btn btn-primary" id="guardarCambiosButton">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Modal for Confirming Removal of Athlete -->
        <div class="modal fade" id="confirmRemoveAthleteModal" tabindex="-1" aria-labelledby="confirmRemoveAthleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmRemoveAthleteModalLabel">Confirmar Eliminación del Atleta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas remover al atleta de la competencia?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form class="form" action="{{ route('competitor.delete', ['competitor' => $competitor->id]) }}" method="post" id="deleteAthleteForm">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" id="removeAthlete">Remover</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Confirming Removal of Event -->
        <div class="modal fade" id="confirmRemoveEventModal" tabindex="-1" aria-labelledby="confirmRemoveEventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmRemoveEventModalLabel">Confirmar Eliminación del Evento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas remover este Evento?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        @if($competitor->events->isNotEmpty())
                        <form class="form" action="#" method="post" id="deleteEventForm">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Remover</button>
                        </form>


                        @else
                        <p>No events to display.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <script>
document.addEventListener('DOMContentLoaded', function() {
    const maxAdditionalEvents = {{ $maxAdditionalEvents }};
    const addEventButton = document.getElementById('addEventButton');
    const eventsSection = document.getElementById('eventsSection');

    function updateAttributes(element, index) {
        element.querySelectorAll('input, select').forEach(input => {
            const name = input.name.replace(/\[\d+\]/, `[${index}]`); // Update index in name attribute
            input.name = name;
            if (input.tagName === 'INPUT' && input.type === 'text') input.value = ''; // Reset text inputs
        });
    }

    function manageButtons() {
        const allEvents = eventsSection.querySelectorAll('.event-time-pair');
        const currentEvents = allEvents.length;
        const addButtons = document.querySelectorAll('.add-event');
        addButtons.forEach((addBtn, index) => {
            const removeBtn = allEvents[index].querySelector('.remove-event');
            // Only the last event-time-pair should show the add button
            if (index === allEvents.length - 1 && currentEvents < maxAdditionalEvents) {
                addBtn.style.display = 'inline-block';
                removeBtn.style.display = 'inline-block'; // Show remove if not the first
                addEventButton.disabled = false;
            } else {
                addBtn.style.display = 'none';
            }
            // Do not show remove button for the first event
            if (index === 0) {
                removeBtn.style.display = 'none';
            } else {
                removeBtn.style.display = 'inline-block';
            }
        });

        // Disable add event button if the maximum is reached
        if (currentEvents >= maxAdditionalEvents+1) {
            addEventButton.disabled = true;
        } else {
            addEventButton.disabled = false;
        }
    }

    eventsSection.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-event')) {
            const currentEvent = e.target.closest('.event-time-pair');
            const newIndex = document.querySelectorAll('.event-time-pair').length; // Get new index based on total count

            const newEvent = currentEvent.cloneNode(true);
            newEvent.setAttribute('data-index', newIndex);
            updateAttributes(newEvent, newIndex);

            eventsSection.appendChild(newEvent); // Append the new event at the end
            manageButtons(); // Update button visibility based on new structure
        }

        if (e.target.classList.contains('remove-event')) {
            const eventToRemove = e.target.closest('.event-time-pair');
            eventToRemove.parentNode.removeChild(eventToRemove);
            manageButtons(); // Re-evaluate button visibility after removal
        }
    });

    manageButtons(); // Initial call to set up correct button visibility
});
        </script>

        {{-- Prevent spamming of submit --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const guardarCambiosButton = document.getElementById('guardarCambiosButton');
                const addCompetitorForm = document.getElementById('addCompetitorForm');

                addCompetitorForm.addEventListener('submit', function() {
                    guardarCambiosButton.disabled = true;
                });
            });
        </script>

        {{-- Prevent spamming of remove on modals (Remover Evento) --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const removeEventButton = document.getElementById('removeEvent');
                const deleteEventForm = document.getElementById('deleteEventForm');

                if (removeEventButton && deleteEventForm) {
                    deleteEventForm.addEventListener('submit', function() {
                        removeEventButton.disabled = true;
                    });
                }
            });
        </script>

        {{-- Disables the remove athlete button --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const removeAthleteButton = document.getElementById('removeAthlete');
                const deleteAthleteForm = document.getElementById('deleteAthleteForm');

                if (removeAthleteButton && deleteAthleteForm) {
                    deleteAthleteForm.addEventListener('submit', function() {
                        removeAthleteButton.disabled = true;
                    });
                }
            });
        </script>
{{-- Tells Modal the ID of the event we want to delete --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attach a click event listener to each delete button
        document.querySelectorAll('.delete-event-btn').forEach(button => {
            button.addEventListener('click', function() {
                const eventId = this.getAttribute('data-eventid'); // Get the event ID from the clicked button
                const deleteForm = document.getElementById('deleteEventForm'); // Get the delete form
                const actionUrl = '{{ route("event.delete", ["event" => "event_id"]) }}'.replace('event_id', eventId); // Replace placeholder with actual ID
                deleteForm.action = actionUrl; // Set the form action
            });
        });
    });
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
