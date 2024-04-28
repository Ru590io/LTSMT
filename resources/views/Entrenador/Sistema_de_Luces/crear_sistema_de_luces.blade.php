<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Entrenamiento con Luces</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Crear Entrenamiento con Luces</h1>
        <div class="text-left mt-4">
            <a href="sistema_de_luces" class="btn btn-primary mb-3">Regresar</a>
        </div>

        <form id="workoutForm">
            <div class="mb-3">
                <label for="workoutName" class="form-label">Nombre del Entrenamiento</label>
                <input type="text" class="form-control" id="workoutName" placeholder="Ingrese el nombre del entrenamiento" pattern="[a-zA-Z\sáéíóúñ]{1,50}" title="Solo letras y espacios, hasta 50 caracteres." required>
            </div>

            <div class="mb-3">
                <label for="distanceInput" class="form-label">Distancia (metros)</label>
                <input type="number" class="form-control" id="distanceInput" placeholder="Ingrese distancia en metros" min="100" max="10000" title="Escriba un valor de 100 a 10000." required>
            </div>

            <div class="mb-3">
                <label for="timeInput" class="form-label">Tiempo (mm:ss)</label>
                <input type="text" class="form-control" id="timeInput" placeholder="Ingrese tiempo (mm:ss)" pattern="[0-9]{1,2}:[0-9]{1,2}" required>
                <!--For email: <input type="email" class="form-control" id="emailInput" placeholder="Ingrese su correo electrónico" pattern=".+@upr\.edu" maxlength="40" required>-->
            </div>
            <button type="submit" class="btn btn-primary">Guardar Entrenamiento</button>
        </form>
    </div>

    <script>
        document.getElementById('workoutForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const workoutName = document.getElementById('workoutName').value;
            const distance = document.getElementById('distanceInput').value;
            const time = document.getElementById('timeInput').value;

            console.log('Entrenamiento:', { workoutName, distance, time });
            // Aquí iría el código para guardar los datos en la base de datos o enviarlos a un servidor.
        });
    </script>
</body>
</html>
