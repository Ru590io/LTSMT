<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Menú Principal</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Entrenamiento de Hoy</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <!-- Botón de Información del Usuario -->
                <div class="d-flex justify-content-end">
                    <button id="userInfoButton" class="btn btn-primary mb-3">Información del Usuario</button>
                </div>

                <!-- Tarjeta de Entrenamiento de Hoy -->
                <div class="card mb-5">
                    <div class="card-header"><h3>Entrenamiento de Hoy:</h3></div>
                    <div class="card-body">
                        <h3>AM:</h3>
                        <div>Cal. 15:00 + driles + 5 x 60m rectas</div>
                        <hr>
                        <h3>PM:</h3>
                        <div>1 x 1km (3:05) rec. 2:00</div>
                        <div>5 x 200m (0:30) rec. 2:00 + enf. 10:00 + flex.</div>
                        <hr>
                        <div class="notes-section">
                            <label for="notas-hoy"><h4>Notas:</h4></label>
                            Baño de agua fría.
                        </div>
                    </div>
                </div>
                <!-- Botón de Calendario -->
                <div class="d-grid gap-3">
                    <button id="calendarButton" class="btn btn-primary btn-lg">Calendario</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('userInfoButton').addEventListener('click', function() {
            alert('Información del Usuario');
        });

        document.getElementById('calendarButton').addEventListener('click', function() {
            alert('Calendario');
        });
    </script>
</body>
</html>


