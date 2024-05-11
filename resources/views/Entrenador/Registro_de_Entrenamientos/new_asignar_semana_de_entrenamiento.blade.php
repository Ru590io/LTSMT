<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <title>Asignar Semana</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <a href="/home" style="text-decoration: none;">
        <div class="logo-container">
            <div class="logo-text">LTSMT</div>
        </div>
    </a>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-5">Asignar Semana</h1>
        @if(session()->has('Exito'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('Exito')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        {{-- method (post?) can be added down here? (method="post") --}}
    <form id="trainingForm" method="POST" action="{{ route('week.assign', $weeklySchedule->id) }}">
        @csrf
        @method('put')
        <!-- Campo para el nombre de la semana -->
        {{-- <div class="mb-3">
            <label for="weekName" class="form-label">Nombre de la Semana:</label>
            <input type="text" class="form-control" id="weekName" placeholder="Ej: Semana del 1 al 7 de Marzo">
        </div> --}}

        <!-- Selector de atletas con búsqueda -->
        {{-- <div class="mb-3">
            <label for="athleteSelector" class="form-label">Asignar a Atleta:</label>
            <select class="form-control" id="athleteSelector">
                <!-- Las opciones se pueden cargar dinámicamente desde una base de datos -->
                <option></option> <!-- Opción vacía para la búsqueda -->
                <option value="1">Axel Rosado</option>
                <option value="2">Guillermo Colón</option>
                <option value="3">Rubén Marrero</option>
                <!-- más atletas -->
            </select>
        </div> --}}
        <div class="mb-3">
            <label for="athleteSelector" class="form-label">Asignar a Atleta:</label>
            <select class="form-control" id="athleteSelector" name="users_id" required>
                <option value="">Seleccione un atleta</option> <!-- Opción vacía para la selección inicial -->
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="weekSelector" class="form-label">Seleccionar Semana:</label>
            <select class="form-control" id="weekSelector" name="selectedWeek" required>
                <!-- Las opciones se pueden cargar dinámicamente desde una base de datos -->
                <option></option> <!-- Opción vacía para la búsqueda -->
            </select>
        </div>
        <div class="d-grid gap-3 mt-5">
            <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#athleteSelector').select2({
                placeholder: "Selecciona un atleta",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#weekSelector').select2({
                placeholder: "Selecciona una semana",
                allowClear: true
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function getMondayOfCurrentWeek(date) {
                var monday = new Date(date);
                monday.setDate(date.getDate() - (date.getDay() - 1));
                return monday;
            }

            function formatDate(date) {
                return date.toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            }

            function generateWeekOptions() {
                var today = new Date();
                var weekSelector = document.getElementById('weekSelector');

                // Empezamos desde el lunes de la semana actual
                var currentMonday = getMondayOfCurrentWeek(today);

                for (let i = 0; i < 5; i++) {
                    var startOfWeek = new Date(currentMonday);
                    startOfWeek.setDate(currentMonday.getDate() + (7 * i));
                    var endOfWeek = new Date(startOfWeek);
                    endOfWeek.setDate(startOfWeek.getDate() + 6);

                    var option = document.createElement('option');
                    option.value = `${startOfWeek.toISOString()}/${endOfWeek.toISOString()}`; // Formato para uso con timestamps
                    option.textContent = `${formatDate(startOfWeek)} - ${formatDate(endOfWeek)}`;
                    weekSelector.appendChild(option);
                }
            }

            generateWeekOptions();

            $('#weekSelector').select2({
                placeholder: "Selecciona una semana",
                allowClear: true
            });
        });


    </script>
        <script>
           /* document.addEventListener('DOMContentLoaded', function() {
                $('#athleteSelector, #weekSelector').select2({
                    placeholder: "Seleccione",
                    allowClear: true,
                    minimumResultsForSearch: Infinity // Disables the search box
                });

                const form = document.getElementById('trainingForm');
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the form from submitting

                    // Validate that an athlete and a week are selected
                    const athleteSelector = document.getElementById('athleteSelector');
                    const weekSelector = document.getElementById('weekSelector');

                    if (!athleteSelector.value || !weekSelector.value) {
                        alert('Por favor, seleccione un atleta y una semana.');
                        return false; // Stop the form from submitting
                    }
                });

            });*/
        </script>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
