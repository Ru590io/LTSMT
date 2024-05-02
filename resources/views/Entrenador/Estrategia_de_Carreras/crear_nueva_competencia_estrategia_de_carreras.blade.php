<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Competencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
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
                        <input type="text" class="form-control" id="cplace" name="cplace" pattern="[A-Za-z0-9\s,.-áéíóúñ]{1,255}" title="Puede incluir letras, números, espacios, y los caracteres ,.-" required>
                        @error('cplace')

                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Competencia</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
