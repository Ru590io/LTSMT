<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Menú Principal</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Entrenamiento de Hoy</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <a href="informacion_del_usuario_atleta" class="btn btn-primary mb-3">Información del Usuario</a>
                </div>
                <div class="card mb-5">
                    <div class="card-header"><h3 class="centered-text">Entrenamiento de Hoy:</h3></div>
                    <div class="card-body">
                        <h3>AM:</h3>
                        <div id="training-am"></div>
                        <hr>
                        <h3>PM:</h3>
                        <div id="training-pm"></div>
                        <hr>
                        <div class="notes-section">
                            <label for="notas-hoy"><h4>Notas:</h4></label>
                            <div id="notes-today"></div>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-3">
                    <a href="calendario_del_atleta" class="btn btn-primary btn-lg">Calendario</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        fetch('/hoy_entrenamiento.json')
            .then(response => response.json())
            .then(data => {
                document.getElementById('training-am').textContent = data.am;
                const pmContainer = document.getElementById('training-pm');
                data.pm.forEach(item => {
                    const div = document.createElement('div');
                    div.textContent = item;
                    pmContainer.appendChild(div);
                });
                document.getElementById('notes-today').textContent = data.notas;
            })
            .catch(error => console.error('Error loading today\'s training:', error));
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
