<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos del Atleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Eventos del Atleta</h1>
        <h2 class="text-center mt-2">Competencia 1 - Axel Rosado</h2>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="coach_main_menu.html" class="btn btn-primary">Regresar</a>
            <a href="edit_events.html" class="btn btn-primary">Editar Eventos</a>
        </div>

        <div class="card mb-5">
            <div class="card-header"><h3 class="centered-text">Eventos</h3></div>
            <div class="card-body">
                <p>Evento 1: 800m - Tiempo: 1:30</p>
                <hr>
                <p>Evento 2: 1500m - Tiempo: 2:50</p>
            </div>
        </div>

        <div class="d-grid gap-3">
            <button class="btn btn-primary btn-lg">Ver Split Tables</button>
        </div>

        <div class="d-grid gap-3 mt-3">
            <button class="btn btn-danger">Remover Atleta de la Competencia</button>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
