<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Competencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h1 class="text-center">Crear Nueva Competencia</h1>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <a href="/competition" class="btn btn-primary">Regresar</a>
        </div>

        <div class="card">
            <div class="card-header">Detalles de la Competencia</div>
            <div class="card-body">
                <form id="newCompetitionForm" class= "form mt-2" action="{{route('competition.add')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="cname" class="form-label">Nombre de la Competencia</label>
                        <input type="text" class="form-control" id="cname" name="cname" pattern="[A-Za-z0-9\sáéíóúñ]{1,100}" title="Solo letras, números y espacios, hasta 100 caracteres." required>
                        @error('cname')

                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cdate" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="cdate" name="cdate" required>
                        @error('cdate')

                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ctime" class="form-label">Hora</label>
                        <input type="time" class="form-control" id="ctime" name="ctime" required>
                        @error('ctime')

                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="cplace" class="form-label">Lugar</label>
                        <input type="text" class="form-control" id="cplace" name="cplace" pattern="[A-Za-z0-9\s,.-áéíóúñ]{1,255}" maxlength="255" title="Puede incluir letras, números, espacios, un maximo de 255 caracteres y los caracteres ,.-" required>
                        @error('cplace')

                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" id="crearCompetenciaButton" class="btn btn-primary">Crear Competencia</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('newCompetitionForm');
            const submitButton = document.getElementById('crearCompetenciaButton');

            form.addEventListener('submit', function() {
                submitButton.disabled = true;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
