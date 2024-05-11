@extends('layouts.app')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('week.update', $weeklySchedule->id) }}" method="POST">
        @csrf
        @method('PUT')

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

        <h1 class="text-center">Editar la Semana</h1>
        <h2 class="text-center mt-3 mb-3">{{ $weeklySchedule->user->first_name }} {{ $weeklySchedule->user->last_name }}</h2>
        <h2 class="text-center mt- mb-5">
            <span class="date-span" data-date="{{ $weeklySchedule->wstart_date }}"></span> -
            <span class="date-span" data-date="{{ $weeklySchedule->wend_date }}"></span>
        </h2>

        <a href="{{ route('week.view', $weeklySchedule->id) }}" class="btn btn-primary mb-3">Regresar</a>

        @foreach ($weeklySchedule->days as $day)
        <div class="card mb-5">
            <h2 class="text-center"><div class="card-header">{{ ucfirst($day->day) }}</div></h2>
            <div class="card-body">
                @foreach(['ams' => 'AM', 'pms' => 'PM'] as $part => $label)
                <hr>
                <div>
                    <h3>{{ $label }}</h3>
                    @foreach(['descansos' => 'Descansos', 'fondos' => 'Fondos', 'repeticiones' => 'Repeticiones'] as $activityType => $activityLabel)
                    <div>
                        <strong>{{ $activityLabel }}</strong>
                        <div id="{{ $day->day }}_{{ $part }}_{{ $activityType }}_container">
                            @if($day->$part->pluck($activityType)->collapse()->isNotEmpty())
                                @foreach($day->$part as $session)
                                    @foreach($session->$activityType as $activity)
                                        @include("partials.edit_{$activityType}", [$activityType => $activity])
                                    @endforeach
                                @endforeach
                            @endif
                            {{--@if($activityType !== 'repeticiones' && $day->$part->pluck($activityType)->collapse()->isNotEmpty())
                                <button type="button" onclick="toggleActivityType('{{ $day->day }}', '{{ $part }}', '{{ $activityType }}')">Add {{ $activityLabel }}</button>
                            @elseif($activityType === 'repeticiones')
                                <button type="button" onclick="toggleActivityType('{{ $day->day }}', '{{ $part }}', 'repeticiones')">Add Repeticion</button>
                            @endif--}}
                        </div>
                    </div>

                    @endforeach
                </div>
                @endforeach

                <div class="mt-4">
                    <hr>
                    <div class="notes-section">
                        <label for="notes_{{ $day->day }}">Notes:</label>
                        <textarea name="notes_{{ $day->day }}" id="notes_{{ $day->day }}" class="form-control" rows="2" placeholder="Escribe notas extras aquí..." maxlength="500" title="No más de 500 caracteres">{{ $day->notes }}</textarea>
                    </div>


                </div>
            </div>
        </div>
        @endforeach
        <div class="d-grid gap-3 mt-3">
            <button id="guardarCambios" disabled type="submit" class="btn btn-primary btn-lg">Guardar Cambios</button>
        </div>
    </form>

<script>
    function toggleActivityType(day, sessionType, selectedActivityType) {
    const activityTypes = ['descansos', 'fondos', 'repeticiones'];  // Define all activity types
    const containerPrefix = `${day}_${sessionType}_`;

    activityTypes.forEach(activityType => {
        const container = document.getElementById(containerPrefix + activityType + '_container');
        if (activityType === selectedActivityType) {
            //container.style.display = 'block';  // Show the container
            if (activityType === 'repeticiones' && container.children.length === 0) {  // Special handling for repeticiones
                container.innerHTML += getActivityForm(day, sessionType, activityType);  // Append, not replace
            } /*else if (container.innerHTML === '') {
                container.innerHTML = getActivityForm(day, sessionType, activityType);  // Populate only if empty
            }*/
        } else {
            //container.style.display = 'none';  // Hide the container
            if (activityType !== 'repeticiones' || activityType !== 'fondos' || activityType !== 'descansos') {  // Preserve repeticiones data
                container.innerHTML = '';  // Clear the content for others
            }
        }
    });
}

function getActivityForm(day, sessionType, activityType) {
    switch (activityType) {
        case 'descansos':
            return `<label>Name:</label><input type="text" name="${day}_${sessionType}_${activityType}_Descanso[]" placeholder="Enter name">`;
        case 'fondos':
            return `
                <label>Distance (km):</label><input type="number" name="${day}_${sessionType}_${activityType}_Fdistancia[]" placeholder="Enter distance" min="1">
                <label>Zone:</label><input type="number" name="${day}_${sessionType}_${activityType}_Fzona[]" placeholder="Enter zone" min="1" max="5">
            `;
        case 'repeticiones':
            return `
                <label>Sets:</label><input type="number" name="${day}_${sessionType}_${activityType}_Rsets[]" placeholder="Enter sets" min="1">
                <label>Distance (m):</label><input type="number" name="${day}_${sessionType}_${activityType}_Rdistancia[]" placeholder="Enter distance" min="100">
                <label>Expected Time:</label><input type="text" name="${day}_${sessionType}_${activityType}_Rtiempoesperado[]" placeholder="Enter expected time">
                <label>Recovery Time:</label><input type="text" name="${day}_${sessionType}_${activityType}_Rrecuperacion[]" placeholder="Enter recovery time">
            `;
    }
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
// Select all elements with the class 'date-span'
const dateElements = document.querySelectorAll('.date-span');

// Iterate over each element and format its date
dateElements.forEach(function(elem) {
    const rawDateStr = elem.getAttribute('data-date');
    const [year, month, day] = rawDateStr.split('-').map(Number);  // Split the date string and convert to numbers
    const rawDate = new Date(year, month - 1, day);  // Create a new Date object; months are 0-indexed in JavaScript

    elem.textContent = formatDate(rawDate);
});
});

function formatDate(date) {
return date.toLocaleDateString('es-ES', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
});
}
</script>

{{-- Disables guardar button until changes are detected --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const saveButton = document.getElementById('guardarCambios');
        const initialFormData = new FormData(form);

        function checkFormChanges() {
            let isChanged = false;
            const currentFormData = new FormData(form);

            // Compare each entry in the initial form data with the current form data
            for (let [key, value] of initialFormData) {
                if (value !== currentFormData.get(key)) {
                    isChanged = true;
                    break;
                }
            }

            // Enable or disable the save button based on whether there are changes
            saveButton.disabled = !isChanged;
        }

        // Add input event listeners to each input and textarea within the form
        form.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', checkFormChanges); // Using 'input' for real-time checking
        });
    });
    </script>


@endsection
