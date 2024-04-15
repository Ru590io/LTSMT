<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio de Sesión</title>
    <link href= "{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>

    <div class="container">
        <h1 class="text-center">Inicio de Sesión</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <!-- Alert for incorrect email or password -->
                <div id="loginAlert" class="alert alert-danger d-none" role="alert">
                    Contraseñá incorrecta. Por favor, trate nuevamente.
                </div>
                <!-- Alert for missing email or password -->
                <div id="missingFieldAlert" class="alert alert-warning d-none" role="alert">
                    Complete ambos campos de correo electrónico y contraseña.
                </div>
                <!-- Alert for invalid email format -->
                <div id="invalidEmailAlert" class="alert alert-warning d-none" role="alert">
                    El correo electrónico debe terminar en "@upr.edu".
                </div>
                <!-- Login form -->
                <form class= "form mt-5" action="{{route('login')}}" method="post">
                    @csrf
                <form>
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" placeholder="Escriba su correo electrónico">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Escriba su contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    <a href="/signup.html" class="btn btn-primary">Registrarse</a>
                    <a href="/forgot_password.html" class="btn btn-link">Olvidó su Contraseña?</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Check if email or password is empty
            if (email.trim() === '' || password.trim() === '') {
                // Show missing field alert if either email or password is empty
                document.getElementById('missingFieldAlert').classList.remove('d-none');
                document.getElementById('loginAlert').classList.add('d-none');
                document.getElementById('invalidEmailAlert').classList.add('d-none');
            } else if (!email.endsWith('@upr.edu')) {
                // Show invalid email format alert if email does not end with '@upr.edu'
                document.getElementById('invalidEmailAlert').classList.remove('d-none');
                document.getElementById('loginAlert').classList.add('d-none');
                document.getElementById('missingFieldAlert').classList.add('d-none');
            } else {
                // Hide any previous alert messages
                document.getElementById('missingFieldAlert').classList.add('d-none');
                document.getElementById('invalidEmailAlert').classList.add('d-none');

                // Check if email and password match expected values (dummy validation)
                if (email === 'athlete@upr.edu' && password === 'apassword') {
                    // Redirect to athlete_main_menu if login is successful
                    window.location.href = '/menu_principal_atleta.html';
                } else if (email === 'coach@upr.edu' && password === 'cpassword') {
                    // Redirect to coach_main_menu if login is successful
                    window.location.href = '/menu_principal_entrenador.html';
                } else {
                    // Show error message if login fails
                    document.getElementById('loginAlert').classList.remove('d-none');
                }

            }
        });
    </script>
</body>
</html>
