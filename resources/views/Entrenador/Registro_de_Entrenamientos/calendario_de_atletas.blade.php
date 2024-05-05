<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <title>Calendario de Atletas</title>
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
        <h1 class="text-center">Calendario de Atletas</h1>
        <div class="d-flex justify-content-between mb-3">
            <button onclick="location.href='registro_de_entrenamientos'" class="btn btn-primary">Regresar</button>
            <button onclick="location.href='editar_semana_del_atleta'" class="btn btn-primary">Editar Entrenamiento del Atleta</button>
        </div>
        {{-- <div class="text-center mb-3">
            <!-- Athlete navigation -->
            <a href="#" class="btn">&lt;</a> <!-- Previous athlete -->
            <select class="form-select d-inline-block w-auto" id="athleteDropdown">
                <!-- Dropdown for selecting athletes -->
                <option value="athlete1">Axel Rosado</option>
                <option value="athlete2">Guillermo Colón</option>
                <!-- More athletes can be added here -->
            </select>
            <a href="#" class="btn">&gt;</a> <!-- Next athlete -->
        </div>
        <div class="text-center mb-3">
            <!-- Week navigation -->
            <a href="#" class="btn">&lt;</a> <!-- Previous week -->
            <select class="form-select d-inline-block w-auto" id="weekDropdown">
                <!-- Dropdown for selecting the week -->
                <option value="week1">6 Marzo 24 - 12 Marzo 24</option>
                <!-- More weeks can be added here -->
            </select>
            <a href="#" class="btn">&gt;</a> <!-- Next week -->
        </div> --}}

        <div class="mb-3">
            <label for="athleteSelector" class="form-label">Seleccionar Atleta:</label>
            <select class="form-control" id="athleteSelector">
                <!-- Las opciones se pueden cargar dinámicamente desde una base de datos -->
                <option></option> <!-- Opción vacía para la búsqueda -->
                <option value="1">Axel Rosado</option>
                <option value="2">Guillermo Colón</option>
                <option value="3">Rubén Marrero</option>
                <!-- más atletas -->
            </select>
        </div>

        <div class="mb-3">
            <label for="weekSelector" class="form-label">Seleccionar Semana:</label>
            <select class="form-control" id="weekSelector">
                <!-- Las opciones se pueden cargar dinámicamente desde una base de datos -->
                <option></option> <!-- Opción vacía para la búsqueda -->
            </select>
        </div>

        <div id="schedule">
            <!-- Cards for each day -->
            <!--Lunes-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Lunes</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Martes-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Martes</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Miercoles-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Miercoles</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Jueves-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Jueves</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Viernes-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Viernes</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Sabado-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Sabao</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Domingo-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Domingo</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#athleteSelector').select2({
                placeholder: "Selecciona un atleta",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#weekSelector').select2({
                placeholder: "Selecciona una semana",
                allowClear: true
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        //Added to hide schedule BEFORE selecting an athlete and a week
            // Initialize the Select2 components
            $('#athleteSelector').select2({
                placeholder: "Selecciona un atleta",
                allowClear: true
            });
            $('#weekSelector').select2({
                placeholder: "Selecciona una semana",
                allowClear: true
            });

            // Function to update the display of the schedule
            function updateScheduleDisplay() {
                var athleteId = $('#athleteSelector').val();
                var weekId = $('#weekSelector').val();
                var scheduleSection = document.getElementById('schedule');

                // Only display the schedule if both an athlete and a week are selected
                if (athleteId && weekId) {
                    scheduleSection.style.display = 'block';
                    // Here you could also make an AJAX call to load the schedule data from the server
                } else {
                    scheduleSection.style.display = 'none';
                }
            }

            // Event listeners for the selectors
            $('#athleteSelector').on('change', updateScheduleDisplay);
            $('#weekSelector').on('change', updateScheduleDisplay);

            // Initially hide the schedule section
            document.getElementById('schedule').style.display = 'none';

        // Week generation
            function getMondayOfCurrentWeek(date) {
                var monday = new Date(date);
                monday.setDate(date.getDate() - (date.getDay() - 1));
                return monday;
            }

            function formatDate(date) {
                //return date.toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                return date.toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' });
            }
            //generates week
            function generateWeekOptions() {
                var today = new Date();
                var weekSelector = document.getElementById('weekSelector');

                // Empezamos desde el lunes de la semana actual
                var currentMonday = getMondayOfCurrentWeek(today);

                for (let i = -5; i < 5; i++) {
                    var startOfWeek = new Date(currentMonday);
                    startOfWeek.setDate(currentMonday.getDate() + (7 * i));
                    var endOfWeek = new Date(startOfWeek);
                    endOfWeek.setDate(startOfWeek.getDate() + 6);

                    var option = document.createElement('option');
                    option.value = `${startOfWeek.toISOString()}/${endOfWeek.toISOString()}`; // Formato para uso con timestamps
                    option.textContent = `${formatDate(startOfWeek)} - ${formatDate(endOfWeek)}`;
                    weekSelector.appendChild(option);
                }
            }

            generateWeekOptions();

            $('#weekSelector').select2({
                placeholder: "Selecciona una semana",
                allowClear: true
            });
        });
    </script>

</body>
</html>
