<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Entrenamientos</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Lista de Entrenamientos</h1>
        <div class="text-left mt-4">
            <button onclick="location.href='registro_de_entrenamientos'" class="btn btn-primary">Regresar</button>
        </div>
        <div class="d-grid gap-3 mt-4">
            <a href="detalles_semana_de_entrenamiento" id="createTrainingWeekButton" class="btn btn-primary btn-lg">Entrenamiento 1</a>
            <a href="detalles_semana_de_entrenamiento" id="viewSavedTrainingsButton" class="btn btn-primary btn-lg">Entrenamiento 2</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
