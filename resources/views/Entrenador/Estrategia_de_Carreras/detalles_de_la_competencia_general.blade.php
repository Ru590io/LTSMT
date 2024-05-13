<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de la Competencia</title>
    <link href="{{asset('Css/styles.css')}}" rel="stylesheet">
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
        <h1 class="text-center mb-5">Detalles de la Competencia</h1>
        <h2 class="text-center mt-5"> {{$competition->cname}} <h2>
        <h2 class="text-center mt-5" id="competitionName"></h2>
        @if(session()->has('Exito'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('Exito')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
            @endif
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="/competition" class="btn btn-primary">Regresar</a>
        {{--@foreach ($competitions as $competition)--}}
            <a href="{{route('competition.edit', ['competition' => $competition->id])}}" class="btn btn-primary">Editar Detalles de Competencia</a>
        </div>
        <div class="card mb-4">

            <div class="card-header"><h3 class="centered-text">Información de la Competencia</h3></div>
            <div class="card-body">
                <p id="competitionDateTime"> Fecha y Hora: {{$competition->cdate}}, {{$competition->ctime}}</p>
                <p id="competitionLocation"> Lugar: {{$competition->cplace}}</p>
            </div>
        </div>
        {{--@endforeach--}}

        <div class="d-grid gap-3">
            {{--@if($competitors->isNotEmpty())
            @foreach ($competitors as $competitor)--}}
            <a href="{{route('competition.listatleta', $competition->id)}}" class="btn btn-primary btn-lg">Ver Competidores</a>
            {{--@endforeach
            @else
            <p>No competitors have been added to this competition yet.</p>
            @endif--}}

            <a href="{{route('table.general', $competition->id)}}" class="btn btn-primary btn-lg">Ver Split Tables</a>
        </div>
        <div class="d-grid gap-3 mt-3">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeCompetitionModal">Remover Competencia</button>
        </div>
    </div>

    <div class="modal fade" id="removeCompetitionModal" tabindex="-1" aria-labelledby="removeCompetitionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeCompetitionModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas remover esta competencia?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form class= "form" action="{{ route('competition.delete', ['competition' => $competition->id]) }}" method="post" id="removeCompetitionForm" >
                        @csrf
                        @method('delete')
                    <button type="submit" class="btn btn-danger" id="removeCompetitionButton">Remover</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('competition_details.json')
            .then(response => response.json())
            .then(data => {
                const details = data.competitionDetails;
                document.getElementById('competitionName').textContent = details.name;
                document.getElementById('competitionDateTime').textContent = "Fecha y hora: " + details.dateTime;
                document.getElementById('competitionLocation').textContent = "Lugar: " + details.location;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const removeCompetitionForm = document.getElementById('removeCompetitionForm');
            const removeCompetitionButton = document.getElementById('removeCompetitionButton');
            removeCompetitionForm.addEventListener('submit', function() {
                removeCompetitionButton.disabled = true;
            });
        });
    </script>

</body>
</html>
