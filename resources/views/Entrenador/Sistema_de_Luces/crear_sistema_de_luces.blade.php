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
            <a href="/light" class="btn btn-primary mb-3">Regresar</a>
        </div>

        <form id="workoutForm" class= "form mt-5" action="{{route('light.add')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="tname" class="form-label">Nombre del Entrenamiento</label>
                <input type="text" class="form-control" id="tname" name="tname" placeholder="Ingrese el nombre del entrenamiento" pattern="[a-zA-Z\sáéíóúñ]{1,50}" title="Solo letras y espacios, hasta 50 caracteres." required>
                @error('tname')

                <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tdistance" class="form-label">Distancia (metros)</label>
                <input type="number" class="form-control" id="tdistance" name="tdistance" placeholder="Ingrese distancia en metros" min="100" max="10000" title="Escriba un valor de 100 a 10000." required>
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
            <button type="submit" class="btn btn-primary">Guardar Entrenamiento</button>
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
</body>
</html>
