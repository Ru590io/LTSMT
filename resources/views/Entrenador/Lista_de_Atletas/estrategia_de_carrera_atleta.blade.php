<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Estrategia de Carrera</title>
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Estrategia de Carrera</h1>
        <h2 class="text-center mt-5">Axel Rosado</h2>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="registro_del_atleta" class="btn btn-primary">Regresar</a>
            <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompetitionModal">Agregar Competencia</button>
        </div>
        <div class="d-grid gap-3">
            <!-- List of events -->
            <a href="detalles_de_la_competencia_atleta" class="btn btn-primary btn-lg">Competencia 1</a>
            <a href="detalles_de_la_competencia_atleta" class="btn btn-primary btn-lg">Competencia 2</a>
            <!-- More events can be added here -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCompetitionModal" tabindex="-1" aria-labelledby="addCompetitionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompetitionModalLabel">Agregar Competencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="competitionSelect" class="form-label">Selecciona una Competencia</label>
                            <select class="form-select" id="competitionSelect">
                                <option selected>Elige una competencia</option>
                                <option value="Competencia 3">Competencia 3</option>
                                <option value="Competencia 4">Competencia 4</option>
                                <option value="Competencia 5">Competencia 5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
