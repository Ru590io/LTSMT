<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Atletas con Cuentas Invalidadas</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container text-center my-4">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Atletas con Cuentas Invalidadas</h1>
        <a href="menu_principal_entrenador.html" class="btn btn-primary mb-4">Regresar</a>
        <div class="list-group">
            <!-- List of athletes with invalid accounts -->
            <div class="list-group-item d-flex justify-content-between align-items-center">
                Javier Espinoza
                <button onclick="rehabilitarCuenta('ID_DEL_ATLETA')" class="btn btn-success">Rehabilitar Cuenta</button>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                Martín Colón
                <button onclick="rehabilitarCuenta('ID_DEL_ATLETA')" class="btn btn-success">Rehabilitar Cuenta</button>
            </div>
            <!-- Add more athletes as needed -->
        </div>
    </div>

    <script>
        function rehabilitarCuenta(athleteId) {
            // Aquí debes agregar la lógica para rehabilitar la cuenta del atleta
            console.log("Rehabilitando cuenta para el atleta con ID:", athleteId);
            // Por ejemplo, podrías enviar una solicitud a tu servidor aquí
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
