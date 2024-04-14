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
            <a href="athlete_main_menu.html" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <div class="d-flex flex-column align-items-center mt-5">
            <!-- Section to copy webapp link -->
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="http://127.0.0.1:5500/login.html" id="webAppLink" readonly>
            </div>
            <!-- Section to change and copy access code -->
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="ACCESS-CODE-1234" id="accessCode">
                <button class="btn btn-outline-secondary" type="button" onclick="saveAccessCode()">Actualizar Codigo de Acceso</button>
            </div>
            <!-- Button to copy both link and access code -->
            <button class="btn btn-primary mb-3" type="button" onclick="copyAllToClipboard()">Copiar Todo</button>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("Copied to clipboard");
            }, (err) => {
                console.error('Could not copy text: ', err);
            });
        }

        function copyAllToClipboard() {
            const webAppLink = document.getElementById('webAppLink').value;
            const accessCode = document.getElementById('accessCode').value;
            copyToClipboard(`Web App Link: ${webAppLink}\nAccess Code: ${accessCode}`);
        }

        function saveAccessCode() {
            const newAccessCode = document.getElementById('accessCode').value;
            // Here you would send newAccessCode to the server to save it
            // For demonstration, we'll just log it to the console
            console.log('New access code saved:', newAccessCode);
            alert('Access code saved successfully.');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
