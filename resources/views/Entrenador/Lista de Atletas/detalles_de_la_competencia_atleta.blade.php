<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de la Competencia</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Detalles de la Competencia</h1>
        <h2 class="text-center mt-5">Competencia 1 - Axel Rosado</h2>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="coach_main_menu.html" class="btn btn-primary">Regresar</a>
            <a href="add_event.html" class="btn btn-primary">Editar Detalles de Competencia</a>
        </div>
        <div class="card mb-3">
            <div class="card-header">Información de la Competencia</div>
            <div class="card-body">
                <p>Fecha y hora: 24 marzo 2024, 4:30 pm</p>
                <p>Lugar: Villalba, Puerto Rico</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Eventos del Atleta</div>
            <div class="card-body">
                <p>800m</p>
                <p>500m</p>
                <!-- Más eventos pueden ser agregados aquí -->
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
