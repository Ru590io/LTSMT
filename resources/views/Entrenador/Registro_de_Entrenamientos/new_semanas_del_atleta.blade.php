<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Atletas</title>
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
        <h1 class="text-center">Semanas Asignadas del Atleta</h1>
        @if(session()->has('Exito'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('Exito')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
        @endif
        <h2 class="text-center mt-4 mb-3"> {{$user->first_name}} {{$user->last_name}} </h2>
        <div class="d-flex justify-content-between mb-4">
            <a href="/schedule/add/show/week/athletes" class="btn btn-primary">Regresar</a>
        </div>
        {{--@foreach ($user->weeklyshedules as $weeklyshedule)
        <div class="d-grid gap-3" id="athletes-list">
            <a href="{{ route('week.listed', ['user' => $user->id]) }}" class="btn btn-primary btn-lg">{{$weeklyshedule->wstart_date}}-{{$weeklyshedule->wend_date}}</a>
        </div>
        @endforeach--}}
    {{-- PREVIOUS WEEK INFO BEFORE PAGINATION --}}
        {{-- @foreach ($user->weeklyshedules as $weeklyshedule)
    <div class="d-grid gap-3" id="athletes-list">
        <a href="{{route('week.view', $weeklyshedule->id)}}" class="btn btn-primary btn-lg mb-3">
            <span class="date-span" data-date="{{ $weeklyshedule->wstart_date }}"></span> -
            <span class="date-span" data-date="{{ $weeklyshedule->wend_date }}"></span>
        </a>
    </div>
    @endforeach --}}
    @if($weeklySchedules->isEmpty())
    <h5 class="text-center">No hay semanas registradas para este atleta.</h5>
    @else
    @foreach ($weeklySchedules as $weeklyshedule)
        <div class="d-grid gap-3" id="athletes-list">
            <a href="{{ route('week.view', $weeklyshedule->id) }}" class="btn btn-primary btn-lg mb-3">
                <span class="date-span" data-date="{{ $weeklyshedule->wstart_date }}"></span> -
                <span class="date-span" data-date="{{ $weeklyshedule->wend_date }}"></span>
            </a>
        </div>
    @endforeach
    @endif

    <div class="d-flex justify-content-center mt-3">
        {{ $weeklySchedules->links('pagination::bootstrap-4') }}
    </div>



    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
