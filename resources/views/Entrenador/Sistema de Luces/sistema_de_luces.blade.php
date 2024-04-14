<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sistema de Luces</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Sistema de Luces</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex text-left">
                    <button id="returnButton" class="btn btn-primary mb-3">Regresar</button>
                </div>
                <!-- Big Buttons -->
                <div class="d-grid gap-3">
                    <button id="createSetupButton" class="btn btn-primary btn-lg">Crear Entrenamiento de Luces</button>
                    <button id="RegisteredSetupsButton" class="btn btn-primary btn-lg">Entrenamiento de Luces Registrados</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Add event listeners for each button
        document.getElementById('userInfoButton').addEventListener('click', function() {
            // Implement your logic for the User Info button
            alert('User Info button clicked');
        });

        document.getElementById('rosterButton').addEventListener('click', function() {
            // Implement your logic for the Roster button
            alert('Roster button clicked');
        });

        document.getElementById('trainingLogButton').addEventListener('click', function() {
            // Implement your logic for the Training Log button
            alert('Training Log button clicked');
        });

        document.getElementById('raceStrategyButton').addEventListener('click', function() {
            // Implement your logic for the Race Strategy button
            alert('Race Strategy button clicked');
        });
    </script>
</body>
</html>
