<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Menú Principal</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Menú Principal</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                        <a href="/entrenadorinfo" class="btn btn-primary mb-3">Información del Entrenador</a>
                </div>
                <!-- Big Buttons -->
                <div class="d-grid gap-3">
                    <a href="/lista" id="rosterButton" class="btn btn-primary btn-lg">Lista de Atletas</a>
                    <a href="/schedule" id="trainingLogButton" class="btn btn-primary btn-lg">Registro de Entrenamientos</a>
                    <a href="/competition" id="raceStrategyButton" class="btn btn-primary btn-lg">Estrategia de Carreras</a>
                    <a href="/light" id="raceStrategyButton" class="btn btn-primary btn-lg">Sistema de Luces</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
