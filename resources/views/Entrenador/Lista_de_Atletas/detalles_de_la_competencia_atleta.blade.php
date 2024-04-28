<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de la Competencia</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
    <div class="container">
        <h1 class="text-center">Detalles de la Competencia</h1>
        <h2 class="text-center mt-5">Competencia 1 - Axel Rosado</h2>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="estrategia_de_carrera_atleta" class="btn btn-primary">Regresar</a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompetitorModal">Editar Eventos</button>
        </div>
        <div class="card mb-5">
            <div class="card-header"><h3 class="centered-text">Información de la Competencia</h3></div>
            <div class="card-body">
                <p>Fecha y hora: 24 marzo 2024, 4:30 pm</p>
                <hr>
                <p>Lugar: Villalba, Puerto Rico</p>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-header"><h3 class="centered-text">Eventos del Atleta</h3></div>
            <div class="card-body">
                <p>Evento: 800m - Tiempo: 1:30</p>
                <hr>
                <p>Evento: 1500m - Tiempo: 2:50</p>
                <!-- Más eventos pueden ser agregados aquí -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addCompetitorModal" tabindex="-1" aria-labelledby="addCompetitorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCompetitorModalLabel">Editar Eventos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario para añadir competidor -->
                        <form id="addCompetitorForm">
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
                        <button type="submit" form="addCompetitorForm" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.add-event').addEventListener('click', function() {
            var select = document.querySelector('.form-select');
            var input = document.querySelector('input[type="text"]');
            var eventsSection = document.getElementById('eventsSection');

            var div = document.createElement('div');
            div.className = 'd-flex align-items-center mb-2';
            div.innerHTML = `
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
                <button type="button" class="btn btn-danger remove-event">-</button>
            `;

            eventsSection.appendChild(div);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-event')) {
                e.target.parentElement.remove();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>