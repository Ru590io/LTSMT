<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Semana de Entrenamiento</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
    <div class="container">
        <h1 class="text-center">Editar Semana de Entrenamiento</h1>
        <h2 class="text-center mt-5">Entrenamiento 1</h2>
        <div class="text-left mt-4">
            <a href="menu_principal_entrenador.html" class="btn btn-primary mb-3">Regresar</a>
        </div>

            <!--Lunes-->
            <div class="card mb-2">
                <div class="card-header"><h3>Lunes</h3></div>
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
                        <textarea class="form-control" id="lunes-notas" rows="2" placeholder="Escribe notas extras aquí..."></textarea>
                    </div>
                </div>
            </div>



            <!--Martes-->
            <div class="card mb-2">
                <div class="card-header"><h3>Martes</h3></div>
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
                            <textarea class="form-control" id="martes-notas" rows="2" placeholder="Escribe notas extras aquí..."></textarea>
                    </div>
                </div>
            </div>
            </div>

            <!--Miércoles-->
            <div class="card mb-2">
                <div class="card-header"><h3>Miércoles</h3></div>
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
                            <textarea class="form-control" id="miércoles-notas" rows="2" placeholder="Escribe notas extras aquí..."></textarea>
                    </div>
                </div>
            </div>
            </div>

            <!--Jueves-->
            <div class="card mb-2">
                <div class="card-header"><h3>Jueves</h3></div>
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
                            <textarea class="form-control" id="jueves-notas" rows="2" placeholder="Escribe notas extras aquí..."></textarea>
                    </div>
                </div>
            </div>
            </div>

            <!--Viernes-->
            <div class="card mb-2">
                <div class="card-header"><h3>Viernes</h3></div>
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
                            <textarea class="form-control" id="viernes-notas" rows="2" placeholder="Escribe notas extras aquí..."></textarea>
                    </div>
                </div>
            </div>
            </div>

            <!--Sábado-->
            <div class="card mb-2">
                <div class="card-header"><h3>Sábado</h3></div>
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
                            <textarea class="form-control" id="sábado-notas" rows="2" placeholder="Escribe notas extras aquí..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!--Domingo-->
            <div class="card mb-2">
                <div class="card-header"><h3>Domingo</h3></div>
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
                            <textarea class="form-control" id="domingo-notas" rows="2" placeholder="Escribe notas extras aquí..."></textarea>
                        </div>

                    </div>
                </div>
            </div>

        <div class="d-grid gap-3 mt-5">
            <button class="btn btn-primary btn-lg">Asignar a Atleta</button>
            <button class="btn btn-primary btn-lg">Guardar</button>
            <button class="btn btn-primary btn-lg copy-to-clipboard">Copiar Semana a Portapapeles</button>
            <button class="btn btn-danger">Eliminar Semana de entrenamiento</button>
        </div>
    </div>

    <script>
        function toggleTrainingOptions(timeOfDay, option) {
    let optionsContainer = document.getElementById(timeOfDay + '-options');
    optionsContainer.innerHTML = ''; // Limpia las opciones previas

    if (option === 'Fondo') {
        optionsContainer.innerHTML = `
            <input type="number" placeholder="Distancia (Kilometros)" />
            <select>
                <option value="">Zona</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        `;
    } else if (option === 'Repeticion') {
        const repetitionContainer = document.createElement('div');
        repetitionContainer.classList.add('repetition-container');
        repetitionContainer.innerHTML = `
            <input type="number" placeholder="Cantidad de Sets" min="1" max="30" />
            <input type="number" placeholder="Distancia (metros)" />
            <input type="text" placeholder="Tiempo Esperado (mm:ss)" />
            <input type="text" placeholder="Recuperación (mm:ss)" />
            <button type="button" class="btn btn-success add-repetition">+</button>
        `;
        optionsContainer.appendChild(repetitionContainer);
    } else if (option === 'Descanso') {
        optionsContainer.innerHTML = 'Descanso';
    }
}

function addRepetition(button) {
    const repetitionContainer = button.parentElement;
    const newRepetitionBlock = repetitionContainer.cloneNode(true);
    newRepetitionBlock.querySelector('.add-repetition').remove();
    newRepetitionBlock.innerHTML += '<button type="button" class="btn btn-danger remove-repetition">-</button>';
    repetitionContainer.parentNode.insertBefore(newRepetitionBlock, repetitionContainer.nextSibling);
}

function removeRepetition(button) {
    button.parentElement.remove();
}

document.addEventListener('click', function(event) {
    if (event.target.classList.contains('add-repetition')) {
        addRepetition(event.target);
    } else if (event.target.classList.contains('remove-repetition')) {
        removeRepetition(event.target);
    }
});

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

        function resetNotes(notesId) {
            document.getElementById(notesId).value = '';
        };


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







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
