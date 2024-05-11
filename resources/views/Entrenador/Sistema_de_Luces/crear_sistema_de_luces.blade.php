<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Entrenamiento con Luces</title>
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
        <h1 class="text-center">Crear Entrenamiento con Luces</h1>
        <div class="text-left mt-4">
            <a href="/light" class="btn btn-primary mb-3">Regresar</a>
        </div>

        <form id="workoutForm" class= "form" action="{{route('light.add')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="tname" class="form-label">Nombre del Entrenamiento</label>
                <input type="text" class="form-control" id="tname" name="tname" placeholder="Ingrese el nombre del entrenamiento" maxlength="50" pattern="[a-zA-Z\sáéíóúñ0-9]{1,50}" title="Solo letras y espacios, hasta 50 caracteres." required>
                @error('tname')

                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tdistance" class="form-label">Distancia (metros)</label>
                <input type="number" class="form-control" id="tdistance" name="tdistance" placeholder="Ingrese distancia en metros" min="100" max="10000" step="100" maxlength="5" title="Escriba un valor de 100 a 10000, de 100 en 100." required>
                @error('tdistance')

                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">

                <label for="ttime" class="form-label">Tiempo (mm:ss)</label>
                <input type="text" class="form-control" id="ttime" name="ttime" placeholder="Ingrese tiempo (mm:ss)" pattern="[0-9]{1,2}:[0-5][0-9]" title= "Porfavor, siga el formato (MM:SS)." required>
                @error('ttime')

                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                @enderror

            </div>

                @if ($lightTrainingCount >= 5)
                <button type="submit" disabled class="btn btn-primary" id="crearLightstrip" >Guardar Entrenamiento</button>
                @else
                <button type="submit" class="btn btn-primary" id="crearLightstrip" >Guardar Entrenamiento</button>
                @endif

        </form>
    </div>

    <script>
        document.getElementById('workoutForm').addEventListener('submit', function(event) {
            //event.preventDefault();

            const workoutName = document.getElementById('tname').value;
            const distance = document.getElementById('tdistance').value;
            const time = document.getElementById('ttime').value;

            console.log('Entrenamiento:', { workoutName, distance, time });
            // Aquí iría el código para guardar los datos en la base de datos o enviarlos a un servidor.
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const removeCompetitionForm = document.getElementById('workoutForm');
        const removeCompetitionButton = document.getElementById('crearLightstrip');
        removeCompetitionForm.addEventListener('submit', function() {
            removeCompetitionButton.disabled = true;
        });
    });
</script>
</body>
</html>
