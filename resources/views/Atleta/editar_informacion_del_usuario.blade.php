<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Información del Atleta</title>
    <link href="{{asset('Css/styles.css')}}" rel="stylesheet">
    <a href="/atlhome" style="text-decoration: none;">
        <div class="logo-container">
            <div class="logo-text">LTSMT</div>
        </div>
    </a>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Editar Información del Atleta</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form id="userInfoForm" class= "form" action="{{route('atleta.update', ['user'=> $user])}}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <a href="{{ route('atleta.index', ['user' => $user->id]) }}" class="btn btn-primary">Regresar</a>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Nombre</label>
                        <!-- Solo letras y espacios, máximo 50 caracteres -->
                        <input type="text" class="form-control" id="first_name" name="first_name" value= "{{ $user->first_name }}" pattern="[a-zA-Z\sáéíóúñ]{1,25}" maxlength="25" title="Solo letras y espacios, hasta 25 caracteres." required>
                        @error('first_name')

                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" pattern="[a-zA-Z\sáéíóúñ]{1,25}" maxlength="25" title="Solo letras y espacios, hasta 25 caracteres." required>
                    </div>
                        @error('last_name')

                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <!-- Debe terminar en @upr.edu -->
                        <input type="email" class="form-control" id="email" name="email" value= "{{$user->email }}" pattern="[a-zA-Z0-9._%+-@]+upr\.edu$" maxlength="60" title="Debe ser un correo electrónico de la UPR, sin acentos." required>
                    </div>
                        @error('email')

                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Número de Teléfono</label>
                        <!-- Solo números, 10 dígitos -->
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" value= "{{$user->phone_number }}" pattern="\d{10}" maxlength="10" title="Debe ser un número de 10 dígitos." required>
                    </div>
                        @error('phone_number')

                        <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                        @enderror
                    <div class="d-flex justify-content-between">
                        <button id="updateButton" disabled button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
         document.addEventListener('DOMContentLoaded', function() {
     const form = document.getElementById('userInfoForm');
     const updateButton = document.getElementById('updateButton');
     const inputs = form.querySelectorAll('input, select, textarea');

     // Store initial data
     const initialValues = {};
     inputs.forEach(input => {
         initialValues[input.name] = input.value;
     });

     // Function to check form changes
     function checkChanges() {
         let formChanged = false;
         inputs.forEach(input => {
             if (initialValues[input.name] !== input.value) {
                 formChanged = true;
             }
         });
         updateButton.disabled = !formChanged;
     }

     // Event listeners for form changes
     inputs.forEach(input => {
         input.addEventListener('change', checkChanges);
         input.addEventListener('input', checkChanges);
     });
 });
     </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
