<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos del Atleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
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
        <h2 class="text-center mt-2">Competencia 1 - Axel Rosado</h2>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="lista_de_competidores" class="btn btn-primary">Regresar</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editEventsModal">Añadir Eventos</button>
        </div>

        <div class="card mb-5">
            <div class="card-header"><h3 class="centered-text">Eventos</h3></div>
            <div class="card-body">
                <p class="d-flex justify-content-between align-items-center">
                    Evento: 800m - Tiempo: 1:30
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmRemoveEventModal">Eliminar</button>
                </p>
                <hr>
                <p class="d-flex justify-content-between align-items-center">
                    Evento: 1500m - Tiempo: 2:50
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmRemoveEventModal">Eliminar</button>
                </p>
                <hr>
                <p class="d-flex justify-content-between align-items-center">
                    Evento: 3000m - Tiempo: 10:30
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmRemoveEventModal">Eliminar</button>
                </p>
                
            </div>
        </div>

        <div class="d-grid gap-3">
            <a href="ver_split_table_atleta" class="btn btn-primary btn-lg">Ver Split Tables</a>
        </div>

        <div class="d-grid gap-3 mt-3">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmRemoveAthleteModal">Remover Atleta de la Competencia</button>
        </div>
    </div>

    <!-- Modal for Adding Events -->
    <div class="modal fade" id="editEventsModal" tabindex="-1" aria-labelledby="editEventsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventsModalLabel">Añadir Eventos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editEventsForm">
                        <div class="mb-3">
                            <label for="eventSelect" class="form-label">Selecciona un Evento</label>
                            <select class="form-select" id="eventSelect">
                                <option selected>Elige un evento</option>
                                <option value="800m">800m</option>
                                <option value="1500m">1500m</option>
                                <option value="3000m obs">3000m obstáculos</option>
                                <option value="5k">5k</option>
                                <option value="10k">10k</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="eventTime" class="form-label">Tiempo del Evento</label>
                            <input type="text" class="form-control" id="eventTime" placeholder="Ejemplo: 10:30" pattern="[0-9]{1,2}:[0-5][0-9]" title="Por favor, siga el formato (MM:SS)." required />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="editEventsForm" class="btn btn-primary">Guardar Evento</button>
                </div>
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
                    <button type="button" class="btn btn-danger" onclick="removeAthlete()">Remover</button>
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
                        <button type="button" class="btn btn-danger" onclick="removeEvent()">Remover</button>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
