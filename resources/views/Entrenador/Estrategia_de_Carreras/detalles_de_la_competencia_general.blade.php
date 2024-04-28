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
        <h2 class="text-center mt-5" id="competitionName"></h2>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="../estrategia_de_carreras_general" class="btn btn-primary">Regresar</a>
            <a href="editar_detalles_de_la_competencia" class="btn btn-primary">Editar Detalles de Competencia</a>
        </div>
        <div class="card mb-5">
            <div class="card-header"><h3 class="centered-text">Información de la Competencia</h3></div>
            <div class="card-body">
                <p id="competitionDateTime"></p>
                <p id="competitionLocation"></p>
            </div>
        </div>

        <div class="d-grid gap-3">
            <a href="/lista_de_competidores" class="btn btn-primary btn-lg">Ver Competidores</a>
            <a href="/ver_split_table_general" class="btn btn-primary btn-lg">Ver Split Tables</a>
        </div>

        <div class="d-grid gap-3 mt-3">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeCompetitionModal">Remover Competencia</button>
        </div>
    </div>

    <div class="modal fade" id="removeCompetitionModal" tabindex="-1" aria-labelledby="removeCompetitionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeCompetitionModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas remover esta competencia?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger">Remover</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('competition_details.json')
            .then(response => response.json())
            .then(data => {
                const details = data.competitionDetails;
                document.getElementById('competitionName').textContent = details.name;
                document.getElementById('competitionDateTime').textContent = "Fecha y hora: " + details.dateTime;
                document.getElementById('competitionLocation').textContent = "Lugar: " + details.location;
            });
        });
    </script>
</body>
</html>