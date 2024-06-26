<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Split Tables General</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        <h1 class="text-center">Split Tables General para {{$competition->cname}}</h1>
        <div class="text-left mt-4">
            <a href="{{ route('competition.show', ['competition' => $competition->id]) }}" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <div class="text-center mb-3">
            <a href="javascript:void(0);" class="btn" onclick="navigateEventDistance(-1)">&lt;</a>
            <select class="form-select d-inline-block w-auto" id="eventDistanceDropdown" onchange="updateEventDistance()">
                <option value="all">Todos los Eventos</option>
                <option value="800">800m</option>
                <option value="1500">1500m</option>
                <option value="3000">3000m obs</option>
                <option value="5000">5000m</option>
                <option value="10000">10000m</option>
            </select>

            <a href="javascript:void(0);" class="btn" onclick="navigateEventDistance(1)">&gt;</a>

        </div>
        @if($eventsAreEmpty)
        <h5 class="text-center">No hay eventos asignados.</h5>
        @endif

        <div id="splitsContainer">
            <!-- Las tablas de splits para los atletas se generarán aquí -->


        </div>
    </div>

    <script>

        let events = []; // Global scope for events

document.addEventListener('DOMContentLoaded', function() {
    // Initialize events from server-side JSON
    events = JSON.parse('{!! $eventsJson !!}');
    updateEventDistance(); // Initialize tables at load

    // Add event listeners to navigation buttons
    document.getElementById('eventDistanceDropdown').addEventListener('change', () => updateEventDistance());
    document.querySelectorAll('.navigate-event').forEach(button => {
        button.addEventListener('click', function() {
            navigateEventDistance(parseInt(this.getAttribute('data-direction')));
        });
    });
});

// Convert seconds to MM:SS format
function secondsToMMSS(seconds) {
    const minutes = Math.floor(seconds / 60);
    const secs = Math.round(seconds % 60);
    return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

// Generate a split table for displaying athlete's performance over distances
function generateSplitTable(eventDistance, eventTimeInSeconds, athleteName) {
    const splitsContainer = document.getElementById('splitsContainer');
    const athleteSection = document.createElement('div');
    athleteSection.classList.add('athlete-section');

    // Create heading for athlete information
    const athleteInfo = document.createElement('h3');
    athleteInfo.textContent = `${eventDistance}m (${secondsToMMSS(eventTimeInSeconds)}) - ${athleteName}`;
    athleteSection.appendChild(athleteInfo);

    // Create responsive table for splits
    const responsiveTableContainer = document.createElement('div');
    responsiveTableContainer.classList.add('table-responsive');

    const table = document.createElement('table');
    table.classList.add('table', 'table-striped');
    const thead = document.createElement('thead');
    const tbody = document.createElement('tbody');

    // Constructing header row for table
    const headerRow = document.createElement('tr');
    headerRow.innerHTML = `<th>Distancia (m)</th>`;
    for (let distance = 100; distance <= eventDistance; distance += 100) {
        let className = distance % 400 === 0 ? 'highlight-column' : '';
        headerRow.innerHTML += `<th class="${className}">${distance}m</th>`;
    }
    thead.appendChild(headerRow);

    // Creating row for times at each split
    const timeRow = document.createElement('tr');
    timeRow.innerHTML = `<td>Tiempo</td>`;
    for (let distance = 100; distance <= eventDistance; distance += 100) {
        const timeInSeconds = (distance / eventDistance) * eventTimeInSeconds;
        let className = distance % 400 === 0 ? 'highlight-column' : '';
        timeRow.innerHTML += `<td class="${className}">${secondsToMMSS(timeInSeconds)}</td>`;
    }
    tbody.appendChild(timeRow);

    table.appendChild(thead);
    table.appendChild(tbody);
    responsiveTableContainer.appendChild(table);
    athleteSection.appendChild(responsiveTableContainer);
    splitsContainer.appendChild(athleteSection);
}

// Update tables based on selected event distance
function updateEventDistance() {
    const splitsContainer = document.getElementById("splitsContainer");
    splitsContainer.innerHTML = ''; // Clear previous content

    const selectedDistance = document.getElementById("eventDistanceDropdown").value;
    let filteredEvents = (selectedDistance === "all") ? events : events.filter(event => parseInt(event.distance) === parseInt(selectedDistance));

    if (filteredEvents.length === 0) {
        // Display a message if no events are available for the selected category
        const noEventsMessage = document.createElement('h5');
        noEventsMessage.className = 'text-center';
        if(selectedDistance != 'all' ){
            noEventsMessage.textContent = 'No hay eventos asignados para ' + selectedDistance + 'm.';
            splitsContainer.appendChild(noEventsMessage);
        }
    } else {
        // If events are available, generate the split tables
        filteredEvents.forEach(event => {
            generateSplitTable(event.distance, event.time, event.name);
        });
    }
}


// Navigate between event distances
function navigateEventDistance(direction) {
    const dropdown = document.getElementById('eventDistanceDropdown');
    const currentIndex = dropdown.selectedIndex;
    const maxIndex = dropdown.options.length - 1;

    if (direction === -1 && currentIndex > 0) {
        dropdown.selectedIndex = currentIndex - 1;
    } else if (direction === 1 && currentIndex < maxIndex) {
        dropdown.selectedIndex = currentIndex + 1;
    }
    updateEventDistance(); // Update tables based on new selection
}
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
