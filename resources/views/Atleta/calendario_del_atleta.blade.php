<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <title>Detalles de la Semana</title>
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
        <h1 class="text-center">Detalles de la Semana</h1>
        <h2 class="text-center">Fecha 1 - Fecha 2</h2>
        <div class="d-flex justify-content-between mb-3">
            <button onclick="location.href='{{ route('atleta.weeks')}}'" class="btn btn-primary">Regresar</button>
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
                <div class="card-header"><h3 class="centered-text">Sábado</h3></div>
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


</body>
</html>




{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Calendario del Atleta</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <a href="/atlhome" style="text-decoration: none;">
        <div class="logo-container">
            <div class="logo-text">LTSMT</div>
        </div>
    </a>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Calendario del Atleta</h1>
        <h2 class="text-center mt-2">Axel Rosado</h2>
        <div class="text-left mt-4">
            <a href="menu_principal_atleta" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <div class="text-center mb-3">
            <a href="#" class="btn">&lt;</a> <!-- Previous week -->
            <select class="form-select d-inline-block w-auto" id="weekDropdown">
                <option value="week1">6 Marzo 24 - 12 Marzo 24</option>
                <!-- More weeks can be added here -->
            </select>
            <a href="#" class="btn">&gt;</a> <!-- Next week -->
        </div>
        <div id="schedule">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const weekDropdown = document.getElementById('weekDropdown');

            function loadWeekData(week) {
                fetch('athlete_schedules.json')  // Make sure this path matches your JSON file location
                .then(response => response.json())
                .then(data => {
                    updateSchedule(data.weeks[week]);
                });
            }

            function updateSchedule(weekData) {
                const scheduleContainer = document.getElementById('schedule');
                scheduleContainer.innerHTML = ''; // Clear current schedule

                Object.entries(weekData.days).forEach(([day, activities]) => {
                    const dayCard = document.createElement('div');
                    dayCard.className = 'card mb-5';
                    dayCard.innerHTML = `
                        <div class="card-header"><h3 class="centered-text">${day}</h3></div>
                        <div class="card-body">
                            <h3>AM:</h3>
                            ${activities.AM.map(activity => `<div>${activity}</div>`).join('')}
                            <hr>
                            <h3>PM:</h3>
                            ${activities.PM.map(activity => `<div>${activity}</div>`).join('')}
                            <hr>
                            <div class="notes-section">
                                <label><h4>Notas:</h4></label>
                                ${activities.Notes}
                            </div>
                        </div>
                    `;
                    scheduleContainer.appendChild(dayCard);
                });
            }

            weekDropdown.addEventListener('change', function() {
                loadWeekData(this.value);
            });

            loadWeekData(weekDropdown.value);
        });
    </script>
</body>
</html> --}}
