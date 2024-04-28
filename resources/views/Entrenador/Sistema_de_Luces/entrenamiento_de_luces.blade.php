<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalle de Entrenamiento de Luces</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
    <div class="container">
        <h1 class="text-center">Detalle de Entrenamiento de Luces - Entrenamiento 1</h1>
        <div class="text-left mt-4">
            <button onclick="location.href='sistema_de_luces'" class="btn btn-primary">Regresar</button>
        </div>
        <h2 class="text-center mt-4">Distancia: 800m - Tiempo: 2:00</h2>
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
                    <button type="button" class="btn btn-danger" onclick="deleteTraining()">Eliminar</button>
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
        calculateSegmentTimes(800, 120);
    </script>
</body>
</html>
