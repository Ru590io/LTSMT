<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Compartir Aplicación Web</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Compartir Aplicación Web</h1>
        <div class="text-left mt-4">
            <a href="lista_de_atletas" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <div class="d-flex flex-column align-items-center mt-5">
            <!-- Section to display webapp link -->
            <div class="mb-3">
                <span id="webAppLink">http://127.0.0.1:5500/login.html</span>
            </div>
            <!-- Hidden section for access code -->
            <input type="hidden" id="accessCode" value="ACCESS-CODE-1234">
            <!-- Button to copy both link and access code -->
            <button class="btn btn-primary mb-3" type="button" onclick="copyAllToClipboard()">Copiar Link y Codigo de Acceso</button>
            <div class="mb-0">
                <span id="webAppLink">Codigo de Acceso puede ser usado solo por una persona.</span>
            </div>
            <div class="mb-3">
                <span id="webAppLink">Tendran 1 hora para usarlo antes de que el codigo de acceso sea invalido.</span>
            </div>
            <button class="btn btn-outline-primary" onclick="generateAccessCode()">Generar Código de Acceso</button>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("Copiado al portapapeles");
            }, (err) => {
                console.error('Error al copiar texto: ', err);
            });
        }

        function copyAllToClipboard() {
            const webAppLink = document.getElementById('webAppLink').textContent;
            const accessCode = document.getElementById('accessCode').value;
            copyToClipboard(`Web App Link: ${webAppLink}\nAccess Code: ${accessCode}`);
        }

        function generateAccessCode() {
            // You would call your server here to get a new access code
            fetch('/generate-access-code', { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                document.getElementById('accessCode').value = data.accessCode;
                alert('Nuevo código de acceso generado y copiado al portapapeles');
                copyToClipboard(data.accessCode);
            })
            .catch(error => console.error('Error al generar el código de acceso:', error));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
