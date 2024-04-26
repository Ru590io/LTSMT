<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Estrategia de Carreras</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Estrategia de Carreras</h1>
        <div class="d-flex justify-content-between mb-4">
            <a href="../menu_principal_entrenador" class="btn btn-primary">Regresar</a>
            <a href="crear_nueva_competencia_estrategia_de_carreras" class="btn btn-primary">Crear Competencia</a>
        </div>
        <div class="d-grid gap-3" id="competitionList">
            <!-- Dynamically generated competition buttons will go here -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
</body>
</html>
