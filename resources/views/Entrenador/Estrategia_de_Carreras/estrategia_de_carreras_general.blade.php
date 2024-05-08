<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Competencias</title>
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
        <h1 class="text-center">Lista de Competencias</h1>
        <div class="d-flex justify-content-between mb-4">
            <a href="/home" class="btn btn-primary">Regresar</a>
            <a href="/competition/add" class="btn btn-primary">Crear Competencia</a>
        </div>
        <div class="d-grid gap-3" id="competitionList">
            @foreach ($competitions as $competition)
            <a href="{{ route('competition.show', ['competition' => $competition->id]) }}" class="btn btn-primary btn-lg"> {{ $competition->cname }}</a>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $competitions->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
       /* document.addEventListener('DOMContentLoaded', function() {
            fetch('competitions.json') // Ensure the path to your JSON file is correct
                .then(response => response.json())
                .then(data => {
                    const competitionList = document.getElementById('competitionList');
                    data.competitions.forEach(competition => {
                        const button = document.createElement('a');
                        button.href = 'detalles_de_la_competencia_general'; // Modify if each competition has a unique link
                        button.className = 'btn btn-primary btn-lg';
                        button.textContent = competition;
                        competitionList.appendChild(button);
                    });
                });
        });*/
    </script>
</body>
</html>
