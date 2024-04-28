<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos del Atleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Eventos del Atleta</h1>
        <h2 class="text-center mt-2">Competencia 1 - Axel Rosado</h2>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="lista_de_competidores" class="btn btn-primary">Regresar</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editEventsModal">Editar Eventos</button>
        </div>

        <div class="card mb-5">
            <div class="card-header"><h3 class="centered-text">Eventos</h3></div>
            <div class="card-body">
                <p>Evento 1: 800m - Tiempo: 1:30</p>
                <hr>
                <p>Evento 2: 1500m - Tiempo: 2:50</p>
                <hr>
                <p>Evento 3: 3000m - Tiempo: 10:30</p>
            </div>
        </div>

        <div class="d-grid gap-3">
            <a href="ver_split_table_atleta" class="btn btn-primary btn-lg">Ver Split Tables</a>
        </div>

        <div class="d-grid gap-3 mt-3">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmRemoveAthleteModal">Remover Atleta de la Competencia</button>
        </div>
    </div>

    <!-- Modal para editar eventos -->
    <div class="modal fade" id="editEventsModal" tabindex="-1" aria-labelledby="editEventsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventsModalLabel">Editar Eventos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar eventos -->
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
                            <input type="text" class="form-control" id="eventTime" placeholder="Ejemplo: 00:10:30">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-success" onclick="addEvent()">Añadir Evento</button>
                        </div>
                        <!-- Lista de eventos actuales -->
                        <ul class="list-group mt-3" id="currentEvents">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                800m - 1:30
                                <button type="button" class="btn btn-danger" onclick="removeEvent(this)">Eliminar</button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                1500m - 2:50
                                <button type="button" class="btn btn-danger" onclick="removeEvent(this)">Eliminar</button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                3000 - 10:30
                                <button type="button" class="btn btn-danger" onclick="removeEvent(this)">Eliminar</button>
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="editEventsForm" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script>

    function addEvent() {
        var eventSelect = document.getElementById('eventSelect');
        var eventTime = document.getElementById('eventTime').value;
        var list = document.getElementById('currentEvents');
        var entry = document.createElement('li');
        entry.className = 'list-group-item d-flex justify-content-between align-items-center';
        entry.innerHTML = `${eventSelect.options[eventSelect.selectedIndex].text} - ${eventTime} <button type="button" class="btn btn-danger" onclick="removeEvent(this)">Eliminar</button>`;
        list.appendChild(entry);
        eventSelect.selectedIndex = 0; // Reset selection
        document.getElementById('eventTime').value = ''; // Clear time input
    }

    function removeEvent(element) {
        element.parentElement.remove();
    }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editEventsForm');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Previene el envío real del formulario

                // Crear un objeto para almacenar los datos del formulario
                const formData = {};

                // Asignar cada valor de los campos del formulario al objeto formData
                new FormData(this).forEach((value, key) => {
                    formData[key] = value;
                });

                // Imprimir los datos en la consola
                console.log('Datos que serían enviados:', formData);

                // Aquí podrías añadir una llamada AJAX/fetch para enviar los datos manualmente si es necesario
                // fetch('tu_endpoint_de_servidor', { method: 'POST', body: JSON.stringify(formData), headers: { 'Content-Type': 'application/json' } }).then(...)
            });
        });
    </script>

        <!-- Confirmation modal for removing athlete -->
        <div class="modal fade" id="confirmRemoveAthleteModal" tabindex="-1" aria-labelledby="confirmRemoveAthleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmRemoveAthleteModalLabel">Confirmación</h5>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
