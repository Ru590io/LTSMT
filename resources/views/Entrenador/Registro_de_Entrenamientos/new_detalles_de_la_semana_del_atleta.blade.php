@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1>{{ $weeklySchedule->user->first_name }} {{ $weeklySchedule->user->last_name }}</h1>
    <span class="date-span" data-date="{{ $weeklySchedule->wstart_date }}"></span> -
    <span class="date-span" data-date="{{ $weeklySchedule->wend_date }}"></span>
    @foreach ($weeklySchedule->days as $day)
    <div class="card">
        <div class="card-header">{{ ucfirst($day->day) }}</div>
        <div class="card-body">
            <div>
                <h3>AM</h3>
                @foreach($day->am as $am)
                    @foreach($am->descansos as $descanso)
                        @include('partials._descanso', ['activity' => $descanso])
                    @endforeach
                    @foreach($am->fondos as $fondo)
                        @include('partials._fondo', ['activity' => $fondo])
                    @endforeach
                    @foreach($am->repeticiones as $repeticion)
                        @include('partials._repeticion', ['activity' => $repeticion])
                    @endforeach
                @endforeach
            </div>
            <div>
                <h3>PM</h3>
                @foreach($day->pm as $pm)
                    @foreach($pm->descansos as $descanso)
                        @include('partials._descanso', ['activity' => $descanso])
                    @endforeach
                    @foreach($pm->fondos as $fondo)
                        @include('partials._fondo', ['activity' => $fondo])
                    @endforeach
                    @foreach($pm->repeticiones as $repeticion)
                        @include('partials._repeticion', ['activity' => $repeticion])
                    @endforeach
                @endforeach
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
