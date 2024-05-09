<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de la Semana</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
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
        {{-- Título del entrenamiento: --}}
        <h1 class="text-center">Detalles de la Semana</h1>
        <h2 class="text-center mt-3 mb-3">Nombre del Atleta</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="lista_de_entrenamientos" class="btn btn-primary mb-3">Regresar</a>
            <a class="btn btn-primary mb-3" href="editar_semana_de_entrenamiento">Editar Semana</a>
        </div>
        <div id="schedule">
            <!-- Cards for each day -->

            <!--Lunes-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Lunes</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Martes-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Martes</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Miercoles-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Miércoles</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Jueves-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Jueves</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Viernes-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Viernes</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Sabado-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Sábado</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>

            <!--Domingo-->
            <div class="card mb-5">
                <div class="card-header"><h3 class="centered-text">Domingo</h3></div>
                <div class="card-body">
                    <h3>AM:</h3>
                        <div>rec. 2' 5 x 200m (29") </div>
                        <div>rec. 2' + enf. 10' + flex.</div>
                    <hr>
                    <h3>PM:</h3>
                    Descanso
                    <hr>
                    <div class="notes-section">
                        <label for="lunes-notas"><h4>Notas:</h4></label>
                        Baño de agua fria.
                    </div>
                </div>
            </div>
        </div>
        <div class="d-grid gap-3 mt-5">

            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteWeekModal">Eliminar Semana de entrenamiento</button>

        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteWeekModal" tabindex="-1" aria-labelledby="deleteWeekModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteWeekModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de querer eliminar esta semana de entrenamiento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDeletion()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.copy-to-clipboard').addEventListener('click', function() {
            let scheduleText = '';
            document.querySelectorAll('.card').forEach(card => {
                let dayName = card.querySelector('.card-header h3').textContent;
                let amDetails = card.querySelector('h3 + div').textContent.trim();
                let pmDetails = card.querySelector('hr + h3').nextElementSibling.textContent.trim();
                let notes = card.querySelector('.notes-section label').nextSibling.textContent.trim();

                scheduleText += `${dayName}\nAM: ${amDetails}\nPM: ${pmDetails}\nNotas: ${notes}\n\n`;
            });

            navigator.clipboard.writeText(scheduleText).then(function() {
                alert('Información copiada al portapapeles');
            }, function(err) {
                console.error('Error al copiar información: ', err);
            });
        });
        </script>
        <script>
            function confirmDeletion() {
                // Placeholder for deletion logic
                console.log("Semana de entrenamiento eliminada");

                // Close the modal after action
                var deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteWeekModal'));
                deleteModal.hide();

                // Additional code to remove the week from the UI or refresh the page might be needed
            }
            </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
