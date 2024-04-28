<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Competidores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Lista de Competidores</h1>
        <h2 class="text-center">Competencia 1</h2>
        <div class="d-flex justify-content-between mb-4">
            <a href="detalles_de_la_competencia_general" class="btn btn-primary">Regresar</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompetitorModal">Añadir Competidores</button>
        </div>
        <div class="d-grid gap-3">
            <!-- Lista de competidores con sus eventos -->
            <button class="btn btn-primary btn-lg" onclick="location.href='eventos_del_atleta'">Axel Rosado - 800m, 1500m</button>
            <button class="btn btn-primary btn-lg" onclick="location.href='eventos_del_atleta'">Rubén Marrero - 5k, 10k</button>
            <button class="btn btn-primary btn-lg" onclick="location.href='eventos_del_atleta'">Enrique Compré - 3000m obstáculos</button>

            <!-- Más botones de competidores pueden ser añadidos aquí -->
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
                <form id="addCompetitorForm">
                    <!-- Lista desplegable de competidores -->
                    <div class="mb-3">
                        <label for="competitorSelect" class="form-label">Selecciona un Competidor</label>
                        <select class="form-select" id="competitorSelect">
                            <option selected>Elige un competidor</option>
                            <option value="1">Competidor 1</option>
                            <option value="2">Competidor 2</option>
                            <option value="3">Competidor 3</option>
                        </select>
                    </div>

                    <!-- Sección de eventos -->
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
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="addCompetitorForm" class="btn btn-primary">Añadir</button>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const eventsSection = document.getElementById('eventsSection');

        eventsSection.addEventListener('click', function(event) {
            if (event.target.classList.contains('add-event')) {
                const newEventTimePair = event.target.parentElement.cloneNode(true);
                newEventTimePair.querySelector('.add-event').classList.replace('btn-success', 'btn-danger');
                newEventTimePair.querySelector('.add-event').textContent = '-';
                newEventTimePair.querySelector('.add-event').classList.replace('add-event', 'remove-event');
                newEventTimePair.querySelector('select').selectedIndex = 0; // Resetea el evento seleccionado
                newEventTimePair.querySelector('input').value = ''; // Limpia el campo de tiempo
                eventsSection.appendChild(newEventTimePair);
            } else if (event.target.classList.contains('remove-event')) {
                event.target.parentElement.remove(); // Solo elimina el contenedor padre del botón "-"
            }
        });
    });
</script>

    <!-- Aquí se incluyen los scripts de Bootstrap y cualquier otro script que necesites -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
