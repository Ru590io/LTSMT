<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Compartir Aplicación Web</title>
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
        <h1 class="text-center">Compartir Aplicación Web</h1>
        <div class="text-left mt-4">
            <a href="/lista" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <div class="d-flex flex-column align-items-center mt-5">
            <!-- Section to display webapp link -->
            <div class="mb-3">
                <span id="accessCodeUrl" style="user-select: all;">{{ $url }}</span>
            </div>

            <!-- Hidden section for access code -->
            <input type="hidden" id="accessCode" value="{{ $code->code }}">
            <!-- Button to copy both link and access code -->
            <button class="btn btn-primary mb-3" type="button" onclick="copyToClipboard()">Copiar Enlace y Código de Acceso</button>
            <div class="mb-0">
                <span id="webAppLink">Enlace puede ser usado solo por una persona.</span>
            </div>
            <div class="mb-3">
                <span id="webAppLink"> El enlace expira en: {{ $formattedDisplayTime }}. Luego de ese tiempo el enlace será invalido.</span>
            </div>
            <form action="{{ route('generate_code') }}" method="POST" id="generateCodeForm">
                @csrf
                <button type="submit" class="btn btn-primary" id="generateCodeButton">Generar Código de Acceso</button>
            </form>
        </div>
    </div>

    <script>
       function copyToClipboard() {
    const textToCopy = document.getElementById('accessCodeUrl').innerText; // Get text from span
    navigator.clipboard.writeText(textToCopy).then(function() {
        alert('Enlace copiado al portapapeles.');
    }, function(err) {
        console.error('Error al copiar el texto: ', err);
    });
}
    </script>

    {{-- Anti-spam delay --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('generateCodeButton');
            button.disabled = true; // Disable the button initially

            setTimeout(() => {
                button.disabled = false; // Enable the button after 5 seconds
            }, 5000);
        });
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
