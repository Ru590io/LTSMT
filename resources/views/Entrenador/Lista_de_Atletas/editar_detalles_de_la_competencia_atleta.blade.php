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
        <h1 class="text-center">Editar Competencia</h1>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="detalles_de_la_competencia_atleta" class="btn btn-primary">Regresar</a>
        </div>

        <div class="card">
            <div class="card-header">Detalles de la Competencia</div>
            <div class="card-body">
                <form id="newCompetitionForm">
                    <div class="mb-3">
                        <label for="competitionName" class="form-label">Nombre de la Competencia</label>
                        <!-- Validación para nombre: solo letras, números y espacios, hasta 100 caracteres -->
                        <input type="text" class="form-control" id="competitionName" value="Competencia 1" pattern="[A-Za-z0-9\sáéíóúñ]{1,100}" title="Solo letras, números y espacios, hasta 100 caracteres." required>
                    </div>
                    <div class="mb-3">
                        <label for="competitionDate" class="form-label">Fecha y Hora</label>
                        <!-- Fecha y hora ya se valida mediante el tipo datetime-local -->
                        <input type="datetime-local" class="form-control" id="competitionDate" value="2024-10-22T16:30" required>
                    </div>
                    <div class="mb-3">
                        <label for="competitionLocation" class="form-label">Lugar</label>
                        <!-- Validación para lugar: letras, números, espacios y algunos caracteres especiales, hasta 255 caracteres -->
                        <input type="text" class="form-control" id="competitionLocation" value="Villalba, Puerto Rico" pattern="[A-Za-z0-9\s,.-áéíóúñ]{1,255}" title="Puede incluir letras, números, espacios, los caracteres ',.-' y un máximo de 255 caracteres." required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
