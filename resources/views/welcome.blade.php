<h1>Home</h1>
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
        <h1 class="text-center mt-5">404 - Página No Encontrada</h1>
        <p class="text-center">Lo sentimos, la página que buscas no existe en este sitio web.</p>
        <div class="row justify-content-center mt-3">
            <div class="col-md-6 text-center">
                <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
            </div>
        </div>
    </div>
</body>
</html>

