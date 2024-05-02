<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Información del Atleta</title>
    <div class="logo-container text-center my-4">
        <div class="logo-text">LTSMT</div>
    </div>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Información del Atleta</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <a href="/atlhome" class="btn btn-primary mb-3">Regresar</a>
                    <a href="{{route('atleta.edit', ['user' => $user])}}" class="btn btn-primary mb-3">Editar Información</a>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre:</label> <span class="form-label" id="nombre"> {{ $user->first_name }} {{ $user->last_name }}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico:</label> <span class="form-label" id="correo"> {{$user->email}} </span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Número de Teléfono:</label> <span class="form-label" id="telefono"> {{$user->phone_number}} </span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="/atletainfo/athlete/password" class="btn btn-primary">Cambiar Contraseña</a>
                    <form class= "form" action="{{route('atlogout')}}" method="post">
                        @csrf
                        <button class="btn btn-danger " type="submit">Terminar Sesión </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        /*fetch('atleta_info.json')
            .then(response => response.json())
            .then(data => {
                document.getElementById('nombre').textContent = data.nombre;
                document.getElementById('correo').textContent = data.correo;
                document.getElementById('telefono').textContent = data.telefono;
            })
            .catch(error => console.error('Error loading athlete information:', error));*/
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
