<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registro del Atleta</title>
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
        <h1 class="text-center">{{ $user->first_name }} {{ $user->last_name }}</h1>

        <div class="row justify-content-center mt-5">

                <!-- Athlete Info Button -->
                <div class="d-flex justify-content-between mb-3">
                    <button onclick="location.href='/lista'" class="btn btn-primary">Regresar</button>
                    <button onclick="location.href='{{ route('athlete.info', ['user' => $user->id]) }}'" id="athleteInfoButton" class="btn btn-primary">Información del Atleta</button>
                    {{-- {{ url('athlete/athleteinfo/' . $user->id) }} --}}

                </div>

                <!-- Today's Training Box -->
            <!--Entrenamiento de Hoy-->
            <div id="schedule">
                <div class="card mb-3">
                    <div class="card-header"><h3 class="centered-text">Todo: Entrenamiento de Hoy</h3></div>
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
                <!-- Additional Buttons -->
                <div class="d-grid gap-3 mt-3">
                    {{-- <button onclick="location.href='{{ url('athlete/athletetraining/' . $user->id) }}'" id="trainingLogsButton" class="btn btn-primary btn-lg">Entrenamiento del Atleta</button> --}}
                    <button onclick="location.href='{{ url('athlete/athletetraininglist/' . $user->id) }}'" id="trainingLogsButton" class="btn btn-primary btn-lg">Semanas Asignadas del Atleta</button>
                    <button onclick="location.href='{{ url('athlete/athletecompetitions/' . $user->id) }}'" id="raceStrategyButton" class="btn btn-primary btn-lg">Competencias del Atleta</button>

                </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
