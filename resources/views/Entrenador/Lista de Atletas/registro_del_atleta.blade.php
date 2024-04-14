<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registro del Atleta</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Axel Rosado</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <!-- Athlete Info Button -->
                <div class="d-flex justify-content-between mb-3">
                    <button onclick="location.href='/roster.html'" class="btn btn-primary">Regresar</button>
                    <button id="athleteInfoButton" class="btn btn-primary">Información del Atleta</button>
                </div>

                <!-- Today's Training Box -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Entrenamiento de Hoy</h5>
                        <p class="card-text">
                            pm: cal. 15' + driles + 5 x 60m rectas +
                            1 x km (3:05) rec. 2'
                            5 x 200m (29") rec. 2' + enf. 10' + flex.
                        </p>
                    </div>
                </div>
                <!-- Additional Buttons -->
                <div class="d-grid gap-3">
                    <button id="trainingLogsButton" class="btn btn-primary btn-lg">Registro de Entrenamientos</button>
                    <button id="raceStrategyButton" class="btn btn-primary btn-lg">Estrategia de Carrera</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Add event listeners for each button
        document.getElementById('athleteInfoButton').addEventListener('click', function() {
            // Implement your logic for the Athlete Info button
            alert('Athlete Info button clicked');
        });

        document.getElementById('trainingLogsButton').addEventListener('click', function() {
            // Implement your logic for the Training Logs button
            alert('Training Logs button clicked');
        });

        document.getElementById('raceStrategyButton').addEventListener('click', function() {
            // Implement your logic for the Race Strategy button
            alert('Race Strategy button clicked');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
