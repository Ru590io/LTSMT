<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <title>Crear Semana de Entrenamiento</title>
    <link href="{{asset('Css/styles.css')}}" rel="stylesheet">
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
        <h1 class="text-center">Crear Semana de Entrenamiento</h1>
        {{-- method (post?) can be added down here? (method="post") --}}
        <form id="trainingForm" action="{{ route('schedule.add') }}" method="post">
            @csrf
        <div class="text-left mt-4">
            <a href="/schedule" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <!-- Campo para el nombre de la semana -->
        <div class="mb-3">
            <label for="weekName" class="form-label">Nombre de la Semana:</label>
            <input type="text" class="form-control" name="wname" id="wname" placeholder="Ej: Entrenamiento Regular" maxlength="50" title="No más de 50 caracteres." required>
        </div>

        {{-- <!-- Selector de atletas con búsqueda -->
        <div class="mb-3">
            <label for="athleteSelector" class="form-label">Asignar a Atleta:</label>
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
        </div> --}}
            <!--Lunes-->
            <div class="card mb-5 mt-5">
                <div class="card-header"><h3 class="centered-text">Lunes</h3></div>
                <div class="card-body">
                    <!-- Sección AM -->
                    <div class="time-of-day-section">
                        <h3>AM</h3>
                        <div class="options-section">
                            <input type="radio" id="lunes-am-descanso" name="lunes-am" value="Descanso" onchange="toggleTrainingOptions('lunes-am', this.value)" checked>
                            <label for="lunes-am-descanso">Descanso</label>
                            <input type="radio" id="lunes-am-fondo" name="lunes-am" value="Fondo" onchange="toggleTrainingOptions('lunes-am', this.value)">
                            <label for="lunes-am-fondo">Fondo</label>
                            <input type="radio" id="lunes-am-repeticion" name="lunes-am" value="Repeticion" onchange="toggleTrainingOptions('lunes-am', this.value)">
                            <label for="lunes-am-repeticion">Repetición</label>
                        </div>
                        <!-- Contenido dinámico para AM -->
                        <div class="dynamic-content" id="lunes-am-options"></div>
                    </div>
                    <!-- Línea divisoria -->
                    <hr>
                    <!-- Sección PM -->
                    <div class="time-of-day-section">
                        <h3>PM</h3>
                        <div class="options-section">
                            <input type="radio" id="lunes-pm-descanso" name="lunes-pm" value="Descanso" onchange="toggleTrainingOptions('lunes-pm', this.value)" checked>
                            <label for="lunes-pm-descanso">Descanso</label>
                            <input type="radio" id="lunes-pm-fondo" name="lunes-pm" value="Fondo" onchange="toggleTrainingOptions('lunes-pm', this.value)">
                            <label for="lunes-pm-fondo">Fondo</label>
                            <input type="radio" id="lunes-pm-repeticion" name="lunes-pm" value="Repeticion" onchange="toggleTrainingOptions('lunes-pm', this.value)">
                            <label for="lunes-pm-repeticion">Repetición</label>
                        </div>

                        <!-- Contenido dinámico para PM -->
                        <div class="dynamic-content" id="lunes-pm-options"></div>
                    </div>
                    <!-- Línea divisoria -->
                    <hr>
                    <!-- Notas -->
                    <div class="notes-section">
                        <label for="lunes-notas">Notas:</label>
                        <input class="form-control" name="lunes-notes" id="lunes-notes" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></input>
                    </div>
                </div>
            </div>



            <!--Martes-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Martes</h3></div>
                    <div class="card-body">
                        <!-- Sección AM -->
                        <div class="time-of-day-section">
                            <h3>AM</h3>
                            <div class="options-section">
                                <input type="radio" id="martes-am-descanso" name="martes-am" value="Descanso" onchange="toggleTrainingOptions('martes-am', this.value)" checked>
                                <label for="martes-am-descanso">Descanso</label>
                                <input type="radio" id="martes-am-fondo" name="martes-am" value="Fondo" onchange="toggleTrainingOptions('martes-am', this.value)">
                                <label for="martes-am-fondo">Fondo</label>
                                <input type="radio" id="martes-am-repeticion" name="martes-am" value="Repeticion" onchange="toggleTrainingOptions('martes-am', this.value)">
                                <label for="martes-am-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para AM -->
                            <div class="dynamic-content" id="martes-am-options"></div>
                        <!-- Línea divisoria -->
                        <hr>
                        <!-- Sección PM -->
                        <div class="time-of-day-section">
                            <h3>PM</h3>
                            <div class="options-section">
                                <input type="radio" id="martes-pm-descanso" name="martes-pm" value="Descanso" onchange="toggleTrainingOptions('martes-pm', this.value)" checked>
                                <label for="martes-pm-descanso">Descanso</label>
                                <input type="radio" id="martes-pm-fondo" name="martes-pm" value="Fondo" onchange="toggleTrainingOptions('martes-pm', this.value)">
                                <label for="martes-pm-fondo">Fondo</label>
                                <input type="radio" id="martes-pm-repeticion" name="martes-pm" value="Repeticion" onchange="toggleTrainingOptions('martes-pm', this.value)">
                                <label for="martes-pm-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para PM -->
                            <div class="dynamic-content" id="martes-pm-options"></div>
                        </div>
                        <!-- Línea divisoria -->
                        <hr>

                        <!-- Notas -->
                        <div class="notes-section">
                            <label for="martes-notas">Notas:</label>
                            <textarea class="form-control" id="martes-notes" name="martes-notes" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
                    </div>
                </div>
            </div>
            </div>

            <!--Miércoles-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Miercoles</h3></div>
                    <div class="card-body">
                        <!-- Sección AM -->
                        <div class="time-of-day-section">
                            <h3>AM</h3>
                            <div class="options-section">
                                <input type="radio" id="miércoles-am-descanso" name="miércoles-am" value="Descanso" onchange="toggleTrainingOptions('miércoles-am', this.value)" checked>
                                <label for="miércoles-am-descanso">Descanso</label>
                                <input type="radio" id="miércoles-am-fondo" name="miércoles-am" value="Fondo" onchange="toggleTrainingOptions('miércoles-am', this.value)">
                                <label for="miércoles-am-fondo">Fondo</label>
                                <input type="radio" id="miércoles-am-repeticion" name="miércoles-am" value="Repeticion" onchange="toggleTrainingOptions('miércoles-am', this.value)">
                                <label for="miércoles-am-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para AM -->
                            <div class="dynamic-content" id="miércoles-am-options"></div>

                        <!-- Línea divisoria -->
                        <hr>
                        <!-- Sección PM -->
                        <div class="time-of-day-section">
                            <h3>PM</h3>
                            <div class="options-section">
                                <input type="radio" id="miércoles-pm-descanso" name="miércoles-pm" value="Descanso" onchange="toggleTrainingOptions('miércoles-pm', this.value)" checked>
                                <label for="miércoles-pm-descanso">Descanso</label>
                                <input type="radio" id="miércoles-pm-fondo" name="miércoles-pm" value="Fondo" onchange="toggleTrainingOptions('miércoles-pm', this.value)">
                                <label for="miércoles-pm-fondo">Fondo</label>
                                <input type="radio" id="miércoles-pm-repeticion" name="miércoles-pm" value="Repeticion" onchange="toggleTrainingOptions('miércoles-pm', this.value)">
                                <label for="miércoles-pm-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para PM -->
                            <div class="dynamic-content" id="miércoles-pm-options"></div>

                        </div>
                        <!-- Línea divisoria -->
                        <hr>

                        <!-- Notas -->
                        <div class="notes-section">
                            <label for="miércoles-notas">Notas:</label>
                            <textarea class="form-control" id="miércoles-notes" name="miércoles-notes" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
                    </div>
                </div>
            </div>
            </div>

            <!--Jueves-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Jueves</h3></div>
                    <div class="card-body">
                        <!-- Sección AM -->
                        <div class="time-of-day-section">
                            <h3>AM</h3>
                            <div class="options-section">
                                <input type="radio" id="jueves-am-descanso" name="jueves-am" value="Descanso" onchange="toggleTrainingOptions('jueves-am', this.value)" checked>
                                <label for="jueves-am-descanso">Descanso</label>
                                <input type="radio" id="jueves-am-fondo" name="jueves-am" value="Fondo" onchange="toggleTrainingOptions('jueves-am', this.value)">
                                <label for="jueves-am-fondo">Fondo</label>
                                <input type="radio" id="jueves-am-repeticion" name="jueves-am" value="Repeticion" onchange="toggleTrainingOptions('jueves-am', this.value)">
                                <label for="jueves-am-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para AM -->
                            <div class="dynamic-content" id="jueves-am-options"></div>

                        <!-- Línea divisoria -->
                        <hr>
                        <!-- Sección PM -->
                        <div class="time-of-day-section">
                            <h3>PM</h3>
                            <div class="options-section">
                                <input type="radio" id="jueves-pm-descanso" name="jueves-pm" value="Descanso" onchange="toggleTrainingOptions('jueves-pm', this.value)" checked>
                                <label for="jueves-pm-descanso">Descanso</label>
                                <input type="radio" id="jueves-pm-fondo" name="jueves-pm" value="Fondo" onchange="toggleTrainingOptions('jueves-pm', this.value)">
                                <label for="jueves-pm-fondo">Fondo</label>
                                <input type="radio" id="jueves-pm-repeticion" name="jueves-pm" value="Repeticion" onchange="toggleTrainingOptions('jueves-pm', this.value)">
                                <label for="jueves-pm-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para PM -->
                            <div class="dynamic-content" id="jueves-pm-options"></div>

                        </div>
                        <!-- Línea divisoria -->
                        <hr>

                        <!-- Notas -->
                        <div class="notes-section">
                            <label for="jueves-notas">Notas:</label>
                            <textarea class="form-control" id="jueves-notes" name="jueves-notes" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
                    </div>
                </div>
            </div>
            </div>

            <!--Viernes-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Viernes</h3></div>
                    <div class="card-body">
                        <!-- Sección AM -->
                        <div class="time-of-day-section">
                            <h3>AM</h3>
                            <div class="options-section">
                                <input type="radio" id="viernes-am-descanso" name="viernes-am" value="Descanso" onchange="toggleTrainingOptions('viernes-am', this.value)" checked>
                                <label for="viernes-am-descanso">Descanso</label>
                                <input type="radio" id="viernes-am-fondo" name="viernes-am" value="Fondo" onchange="toggleTrainingOptions('viernes-am', this.value)">
                                <label for="viernes-am-fondo">Fondo</label>
                                <input type="radio" id="viernes-am-repeticion" name="viernes-am" value="Repeticion" onchange="toggleTrainingOptions('viernes-am', this.value)">
                                <label for="viernes-am-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para AM -->
                            <div class="dynamic-content" id="viernes-am-options"></div>

                        <!-- Línea divisoria -->
                        <hr>
                        <!-- Sección PM -->
                        <div class="time-of-day-section">
                            <h3>PM</h3>
                            <div class="options-section">
                                <input type="radio" id="viernes-pm-descanso" name="viernes-pm" value="Descanso" onchange="toggleTrainingOptions('viernes-pm', this.value)" checked>
                                <label for="viernes-pm-descanso">Descanso</label>
                                <input type="radio" id="viernes-pm-fondo" name="viernes-pm" value="Fondo" onchange="toggleTrainingOptions('viernes-pm', this.value)">
                                <label for="viernes-pm-fondo">Fondo</label>
                                <input type="radio" id="viernes-pm-repeticion" name="viernes-pm" value="Repeticion" onchange="toggleTrainingOptions('viernes-pm', this.value)">
                                <label for="viernes-pm-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para PM -->
                            <div class="dynamic-content" id="viernes-pm-options"></div>

                        </div>
                        <!-- Línea divisoria -->
                        <hr>

                        <!-- Notas -->
                        <div class="notes-section">
                            <label for="viernes-notas">Notas:</label>
                            <textarea class="form-control" id="viernes-notes" name="viernes-notes" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
                    </div>
                </div>
            </div>
            </div>

            <!--Sábado-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Sábado</h3></div>
                    <div class="card-body">
                        <!-- Sección AM -->
                        <div class="time-of-day-section">
                            <h3>AM</h3>
                            <div class="options-section">
                                <input type="radio" id="sábado-am-descanso" name="sábado-am" value="Descanso" onchange="toggleTrainingOptions('sábado-am', this.value)" checked>
                                <label for="sábado-am-descanso">Descanso</label>
                                <input type="radio" id="sábado-am-fondo" name="sábado-am" value="Fondo" onchange="toggleTrainingOptions('sábado-am', this.value)">
                                <label for="sábado-am-fondo">Fondo</label>
                                <input type="radio" id="sábado-am-repeticion" name="sábado-am" value="Repeticion" onchange="toggleTrainingOptions('sábado-am', this.value)">
                                <label for="sábado-am-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para AM -->
                            <div class="dynamic-content" id="sábado-am-options"></div>

                        <!-- Línea divisoria -->
                        <hr>
                        <!-- Sección PM -->
                        <div class="time-of-day-section">
                            <h3>PM</h3>
                            <div class="options-section">
                                <input type="radio" id="sábado-pm-descanso" name="sábado-pm" value="Descanso" onchange="toggleTrainingOptions('sábado-pm', this.value)" checked>
                                <label for="sábado-pm-descanso">Descanso</label>
                                <input type="radio" id="sábado-pm-fondo" name="sábado-pm" value="Fondo" onchange="toggleTrainingOptions('sábado-pm', this.value)">
                                <label for="sábado-pm-fondo">Fondo</label>
                                <input type="radio" id="sábado-pm-repeticion" name="sábado-pm" value="Repeticion" onchange="toggleTrainingOptions('sábado-pm', this.value)">
                                <label for="sábado-pm-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para PM -->
                            <div class="dynamic-content" id="sábado-pm-options"></div>
                        </div>
                        <!-- Línea divisoria -->
                        <hr>

                        <!-- Notas -->
                        <div class="notes-section">
                            <label for="sábado-notas">Notas:</label>
                            <textarea class="form-control" id="sábado-notes" name="sábado-notes" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
                        </div>
                    </div>
                </div>
            </div>


            <!--Domingo-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Domingo</h3></div>
                    <div class="card-body">
                        <!-- Sección AM -->
                        <div class="time-of-day-section">
                            <h3>AM</h3>
                            <div class="options-section">
                                <input type="radio" id="domingo-am-descanso" name="domingo-am" value="Descanso" onchange="toggleTrainingOptions('domingo-am', this.value)" checked>
                                <label for="domingo-am-descanso">Descanso</label>
                                <input type="radio" id="domingo-am-fondo" name="domingo-am" value="Fondo" onchange="toggleTrainingOptions('domingo-am', this.value)">
                                <label for="domingo-am-fondo">Fondo</label>
                                <input type="radio" id="domingo-am-repeticion" name="domingo-am" value="Repeticion" onchange="toggleTrainingOptions('domingo-am', this.value)">
                                <label for="domingo-am-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para AM -->
                            <div class="dynamic-content" id="domingo-am-options"></div>

                        <!-- Línea divisoria -->
                        <hr>
                        <!-- Sección PM -->
                        <div class="time-of-day-section">
                            <h3>PM</h3>
                            <div class="options-section">
                                <input type="radio" id="domingo-pm-descanso" name="domingo-pm" value="Descanso" onchange="toggleTrainingOptions('domingo-pm', this.value)" checked>
                                <label for="domingo-pm-descanso">Descanso</label>
                                <input type="radio" id="domingo-pm-fondo" name="domingo-pm" value="Fondo" onchange="toggleTrainingOptions('domingo-pm', this.value)">
                                <label for="domingo-pm-fondo">Fondo</label>
                                <input type="radio" id="domingo-pm-repeticion" name="domingo-pm" value="Repeticion" onchange="toggleTrainingOptions('domingo-pm', this.value)">
                                <label for="domingo-pm-repeticion">Repetición</label>
                            </div>
                            <!-- Contenido dinámico para PM -->
                            <div class="dynamic-content" id="domingo-pm-options"></div>

                        </div>

                        <!-- Línea divisoria -->
                        <hr>

                        <!-- Notas -->
                        <div class="notes-section">
                            <label for="domingo-notas">Notas:</label>
                            <textarea class="form-control" id="domingo-notes" name="domingo-notes" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
                        </div>

                    </div>
                </div>
            </div>

            @if($users->count() > 0)
        <div class="d-grid gap-3 mt-3">
            <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
        </div>
        @else
        <div class="d-grid gap-3 mt-3">
            <h5 class="text-center">No hay atletas disponibles para asignar. Por favor, añade atletas antes de continuar.</h5>
        </div>
        @endif

        <div class="d-grid gap-3 mt-3">
            <button type="button" id="copyTrainingWeekToClipboard" class="btn btn-primary btn-lg copy-to-clipboard">Copiar Semana a Portapapeles</button>
            </div>
        </form>
    </div>


    <script>
        function toggleTrainingOptions(timeOfDay, option) {
            let optionsContainer = document.getElementById(timeOfDay + '-options');
            optionsContainer.innerHTML = ''; // Clear previous options

            if (option === 'Fondo') {
                optionsContainer.innerHTML = `

                    Distancia: <input type="number" name="${timeOfDay}-Fdistancia" class="small-input" placeholder="1-30" min="1" max="30"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2); this.setCustomValidity('');"
                    oninvalid="this.setCustomValidity('Por favor, ingrese un número entre 1 y 30.')"
                    title="Kilometros entre 1 a 30." required />Km,  Zona:
                    <select name="${timeOfDay}-Fzona">

                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                `;
            } else if (option === 'Repeticion') {
                optionsContainer.innerHTML = `

            Sets: <input type="number" name="${timeOfDay}-Rsets[]" class="small-input" placeholder="1-30" min="1" max="30"
            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2); this.setCustomValidity('');"
            oninvalid="this.setCustomValidity('Por favor, ingrese un número entre 1 y 30.')"
            title="Sets entre 1 a 30." required />


            , Distancia: <input type="number" name="${timeOfDay}-Rdistancia[]" class="small-input" id="distance" placeholder="100+" min="100" max="10000" step="100"
            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 5); this.setCustomValidity('');"
            title="Distancia entre 100 y 10000, de 100 en 100." required />

            m, Tiempo Esperado: <input type="text" name="${timeOfDay}-Rtiempoesperado[]" class="small-input" id="timeExpected" placeholder="mm:ss"
            pattern="[0-9]{1,2}:[0-5][0-9]" maxlength="5"
            oninput="if (/[^0-9:]/.test(this.value)) this.value = this.value.replace(/[^0-9:]/g, ''); this.setCustomValidity('');"
            title="Por favor, siga el formato (MM:SS) para el tiempo esperado." required />


            , Recuperación: <input type="text" name="${timeOfDay}-Rrecuperacion[]" class="small-input" id="timeExpected" placeholder="mm:ss"
            pattern="[0-9]{1,2}:[0-5][0-9]" maxlength="5"
            oninput="if (/[^0-9:]/.test(this.value)) this.value = this.value.replace(/[^0-9:]/g, ''); this.setCustomValidity('');"
            title="Por favor, siga el formato (MM:SS) para la recuperación." required />


            <div id="${timeOfDay}-repetition-container"></div>
            <button type="button" class="btn btn-success mt-2" onclick="addRepetition('${timeOfDay}-repetition-container')">+</button>
        `;
        // Increment the index for next use
            } else if (option === 'Descanso') {
                 optionsContainer.innerHTML = ` <input type="hidden" name="Descanso" value="Descanso">



                `;
            }
        }
    </script>
    <script>
        window.onload = function() {
            // Reset each radio group to its default state
            resetRadioGroup('lunes-am');
            resetRadioGroup('lunes-pm');
            resetRadioGroup('martes-am');
            resetRadioGroup('martes-pm');
            resetRadioGroup('miércoles-am');
            resetRadioGroup('miércoles-pm');
            resetRadioGroup('jueves-am');
            resetRadioGroup('jueves-pm');
            resetRadioGroup('viernes-am');
            resetRadioGroup('viernes-pm');
            resetRadioGroup('sábado-am');
            resetRadioGroup('sábado-pm');
            resetRadioGroup('domingo-am');
            resetRadioGroup('domingo-pm');

            // Reset notas para cada día
            resetNotes('lunes-notas');
            resetNotes('martes-notas');
            resetNotes('miércoles-notas');
            resetNotes('jueves-notas');
            resetNotes('viernes-notas');
            resetNotes('sábado-notas');
            resetNotes('domingo-notas');

        };

        function resetRadioGroup(groupName) {
            let radios = document.querySelectorAll('input[name="' + groupName + '"]');
            for (let radio of radios) {
                radio.checked = false;
            }
            // Activar manualmente la opción 'Descanso' como default
            document.getElementById(groupName + '-descanso').checked = true;
            toggleTrainingOptions(groupName, 'Descanso');
        };

        function resetNotes(notesId) {
            document.getElementById(notesId).value = '';
        };
        function addRepetition(containerId) {

    let baseName = containerId.replace('-repetition-container', '');
    let container = document.getElementById(containerId);
    if (container) {
        let repetitionBlocks = container.getElementsByClassName('repetition-block');
        if (repetitionBlocks.length < 9) { // Modified: Set limit to 4 additional blocks
            let newRepetitionBlock = document.createElement('div');
            newRepetitionBlock.classList.add('mt-2', 'repetition-block');
            newRepetitionBlock.innerHTML = `
                Sets: <input type="number" name="${baseName}-Rsets[]" class="small-input" placeholder="1-30" min="1" max="30" required />
                , Distancia: <input type="number" name="${baseName}-Rdistancia[]" class="small-input" placeholder="100+" min="100" max="10000" step="100" required />
                m, Tiempo Esperado: <input type="text" name="${baseName}-Rtiempoesperado[]" class="small-input" placeholder="mm:ss" pattern="[0-9]{1,2}:[0-5][0-9]" required />
                , Recuperación: <input type="text" name="${baseName}-Rrecuperacion[]" class="small-input" placeholder="mm:ss" pattern="[0-9]{1,2}:[0-5][0-9]" required />
                <button type="button" class="btn btn-danger" onclick="removeRepetition(this)">-</button>
            `;
            container.appendChild(newRepetitionBlock);
        } else {
                alert('No se pueden agregar más de 10 repeticiones en total para esta sesión.'); // Added: Alert when limit is reached
            }
    }
}

function removeRepetition(button) {
    button.parentElement.remove();
}

    </script>
     <!--Copiar a portapapeles-->
<script>
window.onload = function() {
    var copyButton = document.getElementById('copyTrainingWeekToClipboard');
    if (copyButton) {
        copyButton.addEventListener('click', handleCopyButtonClick);
    }

    // Initialize any other functionality here to ensure DOM is fully ready
    initializeOtherFunctions();
};

function handleCopyButtonClick() {
    var trainingWeek = '';
    var days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

    days.forEach(function(day) {
        trainingWeek += day + ':\n';
        ['am', 'pm'].forEach(function(timeOfDay) {
            var sessionRadioSelector = 'input[name="' + day.toLowerCase() + '-' + timeOfDay + '"]:checked';
            var sessionRadio = document.querySelector(sessionRadioSelector);
            if (sessionRadio) {
                trainingWeek += timeOfDay.toUpperCase() + ': ';
                if (sessionRadio.value === 'Descanso') {
                    trainingWeek += 'Descanso\n';
                } else {
                    var optionsContainer = document.getElementById(day.toLowerCase() + '-' + timeOfDay + '-options');
                    if (optionsContainer) {
                        var inputs = optionsContainer.querySelectorAll('input, select');
                        if (sessionRadio.value === 'Fondo') {
                            var distance = inputs[0].value;
                            var zone = inputs[1].value;
                            trainingWeek += `Fondo\n- ${distance} Km, Zona: ${zone} + Enfriamiento: 10:00 + flex\n`;
                        } else if (sessionRadio.value === 'Repeticion') {
                            trainingWeek += 'Repetición:\n- Cal: 15:00 + driles + rectas 60m \n';
                            inputs.forEach(function(input, index) {
                                if (input.type !== 'button') { // Ignore button inputs
                                    if (input.name.includes('Rsets')) {
                                        trainingWeek += '- Sets: ' + input.value + ', ';
                                    } else if (input.name.includes('Rdistancia')) {
                                        trainingWeek += 'Distancia: ' + input.value + ' m, ';
                                    } else if (input.name.includes('Rtiempoesperado')) {
                                        trainingWeek += 'Tiempo Esperado: ' + input.value + ', ';
                                    } else if (input.name.includes('Rrecuperacion')) {
                                        trainingWeek += 'Recuperación: ' + input.value + ' + Enfriamiento: 10:00 + flex\n';
                                    }
                                }
                            });
                        }
                    }
                }
                trainingWeek += '\n';
            }
        });
        var notesId = day.toLowerCase() + '-notes';
        var notesInput = document.getElementById(notesId);
        if (notesInput && notesInput.value.trim() !== '') {
            trainingWeek += 'Notas: ' + notesInput.value.trim() + '\n\n';
        }
    });

    navigator.clipboard.writeText(trainingWeek).then(function() {
        alert('Semana de entrenamiento copiada al portapapeles.');
    }, function(err) {
        console.error('Error al copiar al portapapeles: ', err);
    });
}


    </script>


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
            function getMondayOfCurrentWeek(date) {
                var monday = new Date(date);
                monday.setDate(date.getDate() - (date.getDay() - 1));
                return monday;
            }

            function formatDate(date) {
                return date.toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' });
                // return date.toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            }

            function generateWeekOptions() {
                var today = new Date();
                var weekSelector = document.getElementById('weekSelector');

                // Empezamos desde el lunes de la semana actual
                var currentMonday = getMondayOfCurrentWeek(today);

                for (let i = 0; i < 5; i++) {
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure all form elements are reset correctly on page load
        ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'].forEach(day => {
            ['am', 'pm'].forEach(time => {
                let key = `${day}-${time}`;
                let selectedValue = document.querySelector(`input[name="${key}"]:checked`)?.value;
                if (selectedValue) {
                    toggleTrainingOptions(key, selectedValue);
                } else {
                    // Default to 'Descanso' if nothing is selected
                    document.getElementById(`${key}-descanso`).checked = true;
                    toggleTrainingOptions(key, 'Descanso');
                }
            });
        });

        // Call any other functions that need to run on page load
        // For example, resetting form fields, setting up listeners, etc.
        // Example: resetRadioGroup('lunes-am');
        // Example: resetNotes('lunes-notes');
    });
</script>



        <script>
            /*document.addEventListener('DOMContentLoaded', function() {
                $('#athleteSelector, #weekSelector').select2({
                    placeholder: "Seleccione",
                    allowClear: true,
                    minimumResultsForSearch: Infinity // Disables the search box
                });

                const form = document.getElementById('trainingForm');
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the form from submitting

                    // Validate that an athlete and a week are selected
                    const athleteSelector = document.getElementById('athleteSelector');
                    const weekSelector = document.getElementById('weekSelector');

                    if (!athleteSelector.value || !weekSelector.value) {
                        alert('Por favor, seleccione un atleta y una semana.');
                        return false; // Stop the form from submitting
                    }
                });

            });*/
        </script>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
