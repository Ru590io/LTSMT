<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <title>Asignar Semana de Entrenamiento</title>
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
        <h1 class="text-center">Asignar Semana de Entrenamiento</h1>
        {{-- method (post?) can be added down here? (method="post") --}}
        <form id="trainingForm">
        <div class="text-left mt-4">
            <a href="detalles_semana_de_entrenamiento" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <!-- Campo para el nombre de la semana -->
        {{-- <div class="mb-3">
            <label for="weekName" class="form-label">Nombre de la Semana:</label>
            <input type="text" class="form-control" id="weekName" placeholder="Ej: Semana del 1 al 7 de Marzo">
        </div> --}}

        <!-- Selector de atletas con búsqueda -->
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
        </div>
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
                        <textarea class="form-control" id="lunes-notas" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
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
                                <input type="radio" id="martes-pm-descanso" name="martes-pm" value="Descanso" onchange="toggleTrainingOptions('martes-pm', this.value)">
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
                            <textarea class="form-control" id="martes-notas" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
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
                            <textarea class="form-control" id="miércoles-notas" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
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
                            <textarea class="form-control" id="jueves-notas" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
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
                            <textarea class="form-control" id="viernes-notas" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
                    </div>
                </div>
            </div>
            </div>

            <!--Sábado-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Sabado</h3></div>
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
                            <textarea class="form-control" id="sábado-notas" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
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
                            <textarea class="form-control" id="domingo-notas" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No mas de 500 caracteres"></textarea>
                        </div>

                    </div>
                </div>
            </div>

        <div class="d-grid gap-3 mt-5">
            <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
            <button class="btn btn-primary btn-lg copy-to-clipboard">Copiar Semana a Portapapeles</button>
        </div>
    </div>

    <script>
        function toggleTrainingOptions(timeOfDay, option) {
            let optionsContainer = document.getElementById(timeOfDay + '-options');
            optionsContainer.innerHTML = ''; // Clear previous options

            if (option === 'Fondo') {
                optionsContainer.innerHTML = `
                    <input type="number" style="width: 189px;" id="distance" placeholder="Distancia (Kilometros)" min="1" max="30" title= "Distancia entre 1 y 10" required />
                    <select>
                        <option value="">Zona</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                `;
            } else if (option === 'Repeticion') {
                optionsContainer.innerHTML = `
                    <input type="number" style="width: 189px;" placeholder="Cantidad de Sets" min="1" max="30" title= "Sets entre 1 a 30." required />
                    <input type="number" id="distance" placeholder="Distancia (metros)" min="100" title= "Distancia entre 100 y 10000" required />
                    <input type="text" id="timeExpected" placeholder="Tiempo Esperado (mm:ss)" pattern="[0-9]{1,2}:[0-9]{1,2}" title= "Porfavor, siga el formato (MM:SS)." required />
                    <input type="text" placeholder="Recuperación (mm:ss)" pattern="[0-9]{1,2}:[0-9]{1,2}" title= "Porfavor, siga el formato (MM:SS)." required />
                    <div id="${timeOfDay}-repetition-container">

                    </div>
                    <button type="button" class="btn btn-success mt-2" onclick="addRepetition('${timeOfDay}-repetition-container')">+</button>

                `;
            } else if (option === 'Descanso') {
                // optionsContainer.innerHTML = 'Descanso';
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
            resetRadioGroup('sabado-am');
            resetRadioGroup('sabado-pm');
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
2
        function resetNotes(notesId) {
            document.getElementById(notesId).value = '';
        };
        function addRepetition(containerId) {
            let container = document.getElementById(containerId);
            if (container) {
                let newRepetitionBlock = document.createElement('div');
                newRepetitionBlock.classList.add('mt-2');
                newRepetitionBlock.innerHTML = `
                    <input type="number" style="width: 189px;" placeholder="Cantidad de Sets" min="1" max="30" title="Sets entre 1 a 30." required />
                    <input type="number" id="distance" placeholder="Distancia (metros)" min="100" title= "Distancia entre 100 y 10000" required />
                    <input type="text" id="timeExpected" placeholder="Tiempo Esperado (mm:ss)" pattern="[0-9]{1,2}:[0-9]{1,2}" title= "Porfavor, siga el formato (MM:SS)." required />
                    <input type="text" placeholder="Recuperación (mm:ss)" pattern="[0-9]{1,2}:[0-9]{1,2}" title= "Porfavor, siga el formato (MM:SS)." required />
                    <button type="button" class="btn btn-danger" onclick="removeRepetition(this)">-</button>
                `;
                container.appendChild(newRepetitionBlock);
            }
        }

        function removeRepetition(button) {
            button.parentElement.remove();
        }


    </script>

    <!--Copiar a portapapeles-->
    <script>
        function copyTrainingWeekToClipboard() {
            var trainingWeek = '';
            var days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

            days.forEach(function(day) {
                trainingWeek += day + '\\n';
                ['am', 'pm'].forEach(function(timeOfDay) {
                    var sessionRadio = document.querySelector('input[name="' + day.toLowerCase() + '-' + timeOfDay + '"]:checked');
                    if (sessionRadio) {
                        trainingWeek += timeOfDay.toUpperCase() + ': ' + sessionRadio.value + '\\n';
                        if (sessionRadio.value !== 'Descanso') {
                            var inputs = document.getElementById(day.toLowerCase() + '-' + timeOfDay + '-options').querySelectorAll('input, select');
                            inputs.forEach(function(input) {
                                if (input.type === 'number' || input.type === 'text') {
                                    trainingWeek += input.placeholder + ': ' + input.value + '\\n';
                                } else if (input.tagName.toLowerCase() === 'select') {
                                    trainingWeek += 'Zona: ' + input.options[input.selectedIndex].text + '\\n';
                                }
                            });
                        }
                    }
                });

                var notes = document.getElementById(day.toLowerCase() + '-notas').value;
                if (notes) {
                    trainingWeek += 'Notas: ' + notes.trim() + '\\n';
                }
                trainingWeek += '\\n';
            });

            // Copia al portapapeles usando una función anónima para convertir los '\\n' a saltos de línea reales
            navigator.clipboard.writeText(trainingWeek.split('\\n').join('\n')).then(function() {
                alert('Semana de entrenamiento copiada al portapapeles.');
            }, function(err) {
                console.error('Error al copiar al portapapeles: ', err);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            var copyButton = document.querySelector('.copy-to-clipboard');
            copyButton.addEventListener('click', copyTrainingWeekToClipboard);
        });
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
                return date.toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
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

            });
        </script>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
