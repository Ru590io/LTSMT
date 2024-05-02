<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Setups</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Lista de Entrenamiento de Luces</h1>
        <div class="text-left mt-4">
            <a href="/light" class="btn btn-primary">Regresar</a>
        </div>
        <div class="d-grid gap-3 mt-4" id="trainingList">
            @foreach ($lighttrainings as $lighttraining)
            <a href="{{ route('light.show', ['lighttraining' => $lighttraining->id]) }}" class="btn btn-primary btn-lg"> {{ $lighttraining->tname }}:  {{ $lighttraining->tdistance }} metros  {{sprintf('%02d:%02d', floor($lighttraining->ttime / 60), $lighttraining->ttime % 60)}}</a>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('light_training_sessions.json') // Ensure the path to your JSON file is correct
                .then(response => response.json())
                .then(data => {
                    const trainingList = document.getElementById('trainingList');
                    data.trainings.forEach(training => {
                        const button = document.createElement('a');
                        button.href = 'entrenamiento_de_luces'; // Modify if each training has a unique link
                        button.className = 'btn btn-primary btn-lg';
                        button.textContent = training;
                        trainingList.appendChild(button);
                    });
                });
        });
    </script>
</body>
</html>
