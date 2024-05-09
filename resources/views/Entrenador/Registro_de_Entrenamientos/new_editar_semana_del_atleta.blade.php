@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('week.update', $weeklySchedule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h1>Edit Schedule for {{ $weeklySchedule->user->first_name }} {{ $weeklySchedule->user->last_name }}</h1>

        @foreach ($weeklySchedule->days as $day)
        <div class="card">
            <div class="card-header">{{ ucfirst($day->day) }}</div>
            <div class="card-body">
                @foreach(['ams' => 'AM', 'pms' => 'PM'] as $part => $label)
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
                    <h4>Notes</h4>
                    <textarea name="notes_{{ $day->day }}" class="form-control">{{ $day->notes }}</textarea>
                </div>
            </div>
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
    </form>
</div>
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
@endsection
