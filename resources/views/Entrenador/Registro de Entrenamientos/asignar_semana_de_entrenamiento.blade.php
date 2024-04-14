<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Asignar Semana de Entrenamiento</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Asignar Semana de Entrenamiento</h1>
        <div class="text-left mt-4">
            <a href="athlete_main_menu.html" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <!-- Selector de Semana en Estilo Calendario -->
        <div class="text-center mb-3">
            <label for="weekDropdown" class="form-label">Selecciona la Semana:</label>
            <select class="form-select d-inline-block w-auto" id="weekDropdown">
                <option value="week1">6 Marzo 24 - 12 Marzo 24</option>
                <option value="week2">13 Marzo 24 - 19 Marzo 24</option>
                <!-- Más semanas aquí -->
            </select>
        </div>

        <!-- Lista de Atletas con Casillas de Verificación -->
        <div class="d-flex flex-column align-items-center">
            <h2>Atletas</h2>
            <div id="athleteList">
                <!-- Casillas para cada atleta -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Axel Rosado" id="athlete1">
                    <label class="form-check-label" for="athlete1">Axel Rosado</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Guillermo Colón" id="athlete2">
                    <label class="form-check-label" for="athlete2">Guillermo Colón</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Rubén Marrero" id="athlete3">
                    <label class="form-check-label" for="athlete3">Ruben Marrero</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Enrique Chompré" id="athlete4">
                    <label class="form-check-label" for="athlete4">Enrique Chompré</label>
                </div>
            </div>

            <!-- Botón para Asignar Semana a Atletas Seleccionados -->
            <button class="btn btn-primary btn-lg mt-3" onclick="assignWeekToAthletes()">Asignar Semana</button>
        </div>
    </div>

    <script>
        function assignWeekToAthletes() {
            const selectedWeek = document.getElementById('weekDropdown').value;
            const checkboxes = document.querySelectorAll('#athleteList .form-check-input:checked');
            const selectedAthletes = Array.from(checkboxes).map(cb => cb.value);

            console.log('Semana seleccionada:', selectedWeek);
            console.log('Atletas seleccionados:', selectedAthletes);

            // Aquí va la lógica para procesar y enviar esta información a tu servidor
        }
    </script>
</body>
</html>
