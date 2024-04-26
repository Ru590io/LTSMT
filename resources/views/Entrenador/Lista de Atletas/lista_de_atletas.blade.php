<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Atletas</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Lista de Atletas</h1>
        <div class="d-flex justify-content-between mb-4">
            <a href="menu_principal_entrenador" class="btn btn-primary">Regresar</a>
            <a href="compartir_aplicacion_web" class="btn btn-primary">Compartir Aplicación Web</a>
        </div>
        <div class="d-grid gap-3" id="athletes-list">
            <!-- Los atletas se cargarán aquí dinámicamente -->
                        {{-- <!-- List of students as buttons -->
                        <a href="registro_del_atleta" class="btn btn-primary btn-lg">Axel Rosado</a>
                        <a href="registro_del_atleta" class="btn btn-primary btn-lg">Guillermo Colón</a>
                        <a href="registro_del_atleta" class="btn btn-primary btn-lg">Enrique Chompré</a>
                        <a href="registro_del_atleta" class="btn btn-primary btn-lg">Rubén Marrero</a>
                        <a href="registro_del_atleta" class="btn btn-primary btn-lg">Gilberto Torrez</a> --}}
        </div>
        <div class="d-flex justify-content-end">
            <a href="rehabilitar_cuentas" class="btn btn-primary mt-4">Rehabilitar Cuentas</a>
        </div>
    </div>

    <script>
        fetch('atletas.json')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(athletes => {
                console.log(athletes);  // Verifica qué datos estás recibiendo exactamente
                const container = document.getElementById('athletes-list');
                athletes.forEach(athlete => {
                    const anchor = document.createElement('a');
                    anchor.href = 'registro_del_atleta';
                    anchor.className = 'btn btn-primary btn-lg';
                    anchor.textContent = athlete.name;
                    container.appendChild(anchor);
                });
            })
            .catch(error => console.error('Error loading the athletes:', error));

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
