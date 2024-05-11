@extends('layouts.app')

@section('content')

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <h1 class="text-center">Detalles de la Semana</h1>
    <h2 class="text-center mt-3 mb-3">{{ $weeklySchedule->user->first_name }} {{ $weeklySchedule->user->last_name }}</h2>
    <h2 class="text-center mt- mb-5">
        <span class="date-span" data-date="{{ $weeklySchedule->wstart_date }}"></span> -
        <span class="date-span" data-date="{{ $weeklySchedule->wend_date }}"></span>
    </h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ url('/atletaweeks/list/' .  $weeklySchedule->user->id) }}" class="btn btn-primary btn-lg">Regresar</a>
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
                <h4>Notes:</h4>
                <p>{{ $day->notes }}</p>
            </div>
        </div>
    </div>
</div>
@endforeach
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
@endsection
