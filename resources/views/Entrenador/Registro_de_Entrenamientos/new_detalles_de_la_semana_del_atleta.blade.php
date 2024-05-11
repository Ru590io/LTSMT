@extends('layouts.app')

@section('content')

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


    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session()->has('Exito'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('Exito')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <h1 class="text-center">Detalles de la Semana</h1>
    <h2 class="text-center mt-3 mb-3">{{ $weeklySchedule->user->first_name }} {{ $weeklySchedule->user->last_name }}</h2>
    <h2 class="text-center mt- mb-5">
        <span class="date-span" data-date="{{ $weeklySchedule->wstart_date }}"></span> -
        <span class="date-span" data-date="{{ $weeklySchedule->wend_date }}"></span>
    </h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('week.listed', $weeklySchedule->user->id) }}" class="btn btn-primary mb-3">Regresar</a>
        <a class="btn btn-primary mb-3" href="{{ route('week.edit', $weeklySchedule->id) }}">Editar Semana</a>
    </div>
    @foreach ($weeklySchedule->days as $day)

    <div class="card mb-5">

    <h2 class="card-header text-center">{{ ucfirst($day->day) }}</h2>
    <div class="card-body">
        <div>
            <h3>AM:</h3>
            @foreach($day->ams as $am)
                @foreach($am->descansos as $descanso)
                    @include('partials._descanso', ['activity' => $descanso])
                @endforeach
                @foreach($am->fondos as $fondo)
                    @include('partials._fondo', ['activity' => $fondo])
                @endforeach
                @if(count($am->repeticiones) > 0)
                Repetición:<br>
                Cal: 15:00 + driles + rectas 60m
                @foreach($am->repeticiones as $repeticion)
                    @include('partials._repeticion', ['activity' => $repeticion])
                @endforeach
                @endif
            @endforeach
        </div>
        <hr>
        <div>
            <h3>PM:</h3>
            @foreach($day->pms as $pm)
                @foreach($pm->descansos as $descanso)
                    @include('partials._descanso', ['activity' => $descanso])
                @endforeach
                @foreach($pm->fondos as $fondo)
                    @include('partials._fondo', ['activity' => $fondo])
                @endforeach
                @if(count($pm->repeticiones) > 0)
                Repetición:<br>
                Cal: 15:00 + driles + rectas 60m
                @foreach($pm->repeticiones as $repeticion)
                    @include('partials._repeticion', ['activity' => $repeticion])
                @endforeach
                @endif
            @endforeach

            <div class="mt-4">
                <hr>
                <h4>Notas:</h4>
                <p>{{ $day->notes }}</p>
            </div>

        </div>
    </div>
</div>
@endforeach
<div class="d-grid gap-3 mt-5">

    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteWeekModal">Eliminar Semana de entrenamiento</button>

</div>

</div>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteWeekModal" tabindex="-1" aria-labelledby="deleteWeekModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteWeekModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de quiere eliminar esta semana de entrenamiento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form class="form" action="{{ route('weekly.delete', $weeklySchedule->id) }}" method="post" id="deleteAthleteForm">
                        @csrf
                        @method('delete')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDeletion() {
            // Placeholder for deletion logic
            console.log("Semana de entrenamiento eliminada");

            // Close the modal after action
            var deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteWeekModal'));
            deleteModal.hide();

            // Additional code to remove the week from the UI or refresh the page might be needed
        }
        </script>
        {{-- Prevent's Delete Spam --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Assuming your Delete button has an ID of 'deleteButton'
                const deleteButton = document.getElementById('deleteButton');

                deleteButton.addEventListener('click', function() {
                    this.disabled = true;  // Disable the button on click
                });
            });
            </script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
// Select all elements with the class 'date-span'
const dateElements = document.querySelectorAll('.date-span');

// Iterate over each element and format its date
dateElements.forEach(function(elem) {
    const rawDateStr = elem.getAttribute('data-date');
    const [year, month, day] = rawDateStr.split('-').map(Number);  // Split the date string and convert to numbers
    const rawDate = new Date(year, month-1, day );  // Create a new Date object; months are 0-indexed in JavaScript

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
@endsection
