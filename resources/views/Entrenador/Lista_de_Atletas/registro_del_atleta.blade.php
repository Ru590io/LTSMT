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
                    <button onclick="location.href='/lista' "class="btn btn-primary">Regresar</button>
                    <button onclick="location.href='informacion_del_atleta'" id="athleteInfoButton" class="btn btn-primary">Información del Atleta</button>
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
                    <button onclick="location.href='entrenamiento_del_atleta'" id="trainingLogsButton" class="btn btn-primary btn-lg">Registro de Entrenamientos</button>
                    <button onclick="location.href='estrategia_de_carrera_atleta'" id="raceStrategyButton" class="btn btn-primary btn-lg">Estrategia de Carrera</button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
