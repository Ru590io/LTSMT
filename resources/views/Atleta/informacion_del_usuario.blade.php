<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Información del Usuario</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Infromación del Usuario</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="text-left mt-4">
                        <a href="menu_principal_entrenador.html" class="btn btn-primary mb-3">Regresar</a>
                    </div>
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" value="User Name" disabled>
                    <a href="/change_name.html" class="btn btn-primary mt-2">Cambiar Nombre de Usuario</a>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electronico</label>
                    <input type="email" class="form-control" id="email" value="xxxxxxxxxx@upr.edu" disabled>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Número de Telefono</label>
                    <input type="text" class="form-control" id="phone" value="(xxx) xxx - xxxx" disabled>
                    <a href="/change_phone.html" class="btn btn-primary mt-2">Cambiar Número de Telefono</a>
                </div>
                <div class="mb-4"> <!-- Added more margin for separation -->
                    <a href="/change_password.html" class="btn btn-primary">Cambiar Contraseña</a>
                </div>
                <div class="mb-3" >
                    <a heref="logout" class ="btn btn-danger">Terminar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<style>
    body {
        background-color: #0A7302; /* Light blue background */
    }

    .container {
        background-color: #F2FFF6; /* White container background */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        padding: 30px;
        margin-top: 10px; /* Add some space from the top */
        margin-bottom: 50px; /* Add some space from the bottom */
        border: 5px solid #0fb00c; /* Optional: border color matching the logo */
    }


    h1 {
        color: #0A7302; /* Blue title color */
    }

    .btn-danger {
        font-weight: bold; /* Bold text */
    }

    .btn-primary {
        background-color: #0A7302; /* Blue button background color */
        border-color: #0A7302; /* Blue button border color */
        font-weight: bold; /* Bold text */
    }

    .btn-primary:hover {
        background-color: #0c5700; /* Darker blue on hover */
        border-color: #0c5700; /* Darker blue border on hover */
    }

    .btn-primary:active{
        background-color: #094200 !important; /* Darker blue on hover */
        border-color: #094200 !important; /* Darker blue border on hover */
    }

    .btn-link {
        color: #007bff; /* Blue link color */
    }

    .btn-link:hover {
        text-decoration: none; /* Remove underline on hover */
        color: #0056b3; /* Darker blue on hover */
    }

    .alert {
        margin-top: 20px; /* Add space between alerts and form */
    }

    .logo-container {
        background-color: #F2FFF6; /* White container background */
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        height: 20vh; /* Adjust height as needed */
        width: fit-content; /* Adjust width to fit content */
        margin: 20px auto; /* Centering in the viewport with some margin */
        padding: 20px; /* Padding around the logo */
        border-radius: 15px; /* Rounded corners for the container */
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.15); /* Subtle shadow for depth */
        border: 5px solid #0fb00c; /* Optional: border color matching the logo */
    }

    .logo-text {
        font-family: 'Arial', sans-serif; /* Or any other preferred font */
        font-size: 50px; /* Size of the logo text */
        font-weight: bold; /* Make it bold */
        color: #072600; /* Base blue color */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Shadow effect */
        letter-spacing: 2px; /* Space between letters */
    }

    table .highlight-column {
        background-color: #7cff9a;
    }
    .athlete-section:not(:last-child) {
        margin-bottom: 2rem;
    }
            /* Estilo adicional para negrita en el encabezado 'Tiempo' */
    .bold-header {
        font-weight: bold;
    }

    colors{

        /* Primary: Lush Plains */
        --primary-100: #F2FFF6;
        --primary-200: #BEFECC;
        --primary-300: #87F799;
        --primary-400: #4EE45E;
        --primary-500: #1BBF23;
        --primary-600: #0A9909;
        --primary-700: #0A7302;
        --primary-800: #0A4D00;
        --primary-900: #072600;

        /* Accent: Blue Ruin */
        --accent-100: #F2F5FF;
        --accent-200: #B8CCFE;
        --accent-300: #7DA7FB;
        --accent-400: #4287F1;
        --accent-500: #0B6ADE;
        --accent-600: #045BB0;
        --accent-700: #014A82;
        --accent-800: #003554;
        --accent-900: #001A26;

        /* Neutral */
        --neutral-100: #FAFCFB;
        --neutral-200: #E7EDE9;
        --neutral-300: #D5DDD6;
        --neutral-400: #C3CDC4;
        --neutral-500: #B1BDB2;
        --neutral-600: #8D978D;
        --neutral-700: #697168;
        --neutral-800: #464C45;
        --neutral-900: #232622;
}
</style>
