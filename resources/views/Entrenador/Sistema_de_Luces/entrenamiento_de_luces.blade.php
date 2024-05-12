<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalle de Entrenamiento de Luces</title>
    <link href="{{asset('Css/styles.css')}}" rel="stylesheet">
    <a href="/home" style="text-decoration: none;">
        <div class="logo-container">
            <div class="logo-text">LTSMT</div>
        </div>
    </a>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

        <nav class="navbar custom-navbar">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">Menú Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/lista">Lista de Atletas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/schedule">Registro de Entrenamientos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/competition">Lista de Competencias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/light">Sistema de Luces</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1 class="text-center">Detalle de Entrenamiento de Luces - Entrenamiento 1</h1>
        <div class="text-left mt-4">
            <a href="/light/list" class="btn btn-primary">Regresar</a>
        </div>
        <h2 class="text-center mt-4">Distancia {{ $lighttraining->tdistance }} metros - Tiempo {{ sprintf('%02d:%02d', floor($lighttraining->ttime / 60), $lighttraining->ttime % 60) }}</h2>
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Distancia (metros)</th>
                        <th>Tiempo Esperado (mm:ss)</th>
                    </tr>
                </thead>
                <tbody id="trainingDetails"></tbody>
            </table>
            <div class="text-center mt-4">
                <!-- Button to trigger modal -->
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Eliminar Entrenamiento</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de querer eliminar este entrenamiento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form class= "form" action="{{ route('light.delete', ['lighttraining' => $lighttraining->id]) }}" method="post" id="eliminarTrainingForm">
                        @csrf
                        @method('delete')
                    <button class="btn btn-danger" type="submit" id="eliminarTraining">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function deleteTraining() {
            // Aquí iría la lógica para eliminar el entrenamiento
            console.log("Entrenamiento eliminado");
            // Cerrar el modal una vez eliminado
            var modalElement = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmationModal'));
            modalElement.hide();
        }

        function secondsToMMSS(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        function mmssToSeconds(mmss) {
            const [minutes, seconds] = mmss.split(':').map(Number);
            return (minutes * 60) + seconds;
        }

        function calculateSegmentTimes(totalDistance, totalTime) {
            const totalSeconds = totalTime;
            const secondsPerSegment = totalSeconds / (totalDistance / 100);

            let tableContent = '';
            for (let distance = 100; distance <= totalDistance; distance += 100) {
                const timeForDistance = secondsToMMSS(secondsPerSegment * (distance / 100));
                tableContent += `<tr><td>${distance}</td><td>${timeForDistance}</td></tr>`;
            }

            document.getElementById('trainingDetails').innerHTML = tableContent;
        }

        // Asigna los valores del entrenamiento específico aquí
        var tDistance = {{ json_encode($lighttraining->tdistance) }};
        var tTime = {{ json_encode($lighttraining->ttime) }}; // Make sure tTime is in seconds if needed
        calculateSegmentTimes(tDistance, tTime);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const removeCompetitionForm = document.getElementById('eliminarTrainingForm');
            const removeCompetitionButton = document.getElementById('eliminarTraining');
            removeCompetitionForm.addEventListener('submit', function() {
                removeCompetitionButton.disabled = true;
            });
        });
    </script>
</body>
</html>
