<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Competencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Crear Nueva Competencia</h1>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="coach_main_menu.html" class="btn btn-primary">Regresar</a>
        </div>

        <div class="card">
            <div class="card-header">Detalles de la Competencia</div>
            <div class="card-body">
                <form id="newCompetitionForm">
                    <div class="mb-3">
                        <label for="competitionName" class="form-label">Nombre de la Competencia</label>
                        <input type="text" class="form-control" id="competitionName" required>
                    </div>
                    <div class="mb-3">
                        <label for="competitionDate" class="form-label">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="competitionDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="competitionLocation" class="form-label">Lugar</label>
                        <input type="text" class="form-control" id="competitionLocation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Competencia</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
