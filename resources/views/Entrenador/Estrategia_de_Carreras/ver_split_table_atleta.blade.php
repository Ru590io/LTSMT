<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Split Tables Atletas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
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
        <h1 class="text-center">Split Tables para Atleta</h1>
        <h2 class="text-center mt-5">{{ $competitor->users->first_name }} {{ $competitor->users->last_name }}</h2>
        <div class="text-left mt-4">
            <a href="{{ route('competitors.listing', $competitor->id) }}" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <div id="splitsContainer" class="mt-5">
            <!-- Las tablas de splits y la información del atleta se generarán aquí -->
        </div>
    </div>


    <script>
        // Function to convert seconds to mm:ss format
        /*function secondsToMMSS(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        // Function to convert mm:ss to seconds
        function mmssToSeconds(mmss) {
            const [minutes, seconds] = mmss.split(':').map(Number);
            return (minutes * 60) + seconds;
        }

        function generateSplitTable(eventDistance, eventTimeInSeconds, athleteName) {
            const splitsContainer = document.getElementById('splitsContainer');
            const athleteSection = document.createElement('div');
            athleteSection.classList.add('athlete-section');

            // Create the athlete information
            const athleteInfo = document.createElement('h3');
            athleteInfo.textContent = `${eventDistance}m (${secondsToMMSS(eventTimeInSeconds)})`;
            athleteSection.appendChild(athleteInfo);

            // Create the responsive table container
            const responsiveTableContainer = document.createElement('div');
            responsiveTableContainer.classList.add('table-responsive');

            // Create the split table
            const table = document.createElement('table');
            table.classList.add('table', 'table-striped');
            const thead = document.createElement('thead');
            const tbody = document.createElement('tbody');

            // Header row for distances
            const headerRow = document.createElement('tr');
            headerRow.innerHTML = `<th>Distancia</th>`;
            for (let distance = 100; distance <= eventDistance; distance += 100) {
                let className = distance % 400 === 0 ? 'highlight-column' : '';
                headerRow.innerHTML += `<th class="${className}">${distance}m</th>`;
            }
            thead.appendChild(headerRow);

            // Row for times
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

        // Example usage
        function getNumber(eventString) {
                const result = eventString.match(/\d+/); // This regex matches any sequence of digits in the string
                return result ? parseInt(result[0], 10) : null; // Convert the found string to a number, or return null if nothing is found
            }
        var tDistance = {{ json_encode($competitor->events) }};
        var tTime = {{ json_encode($competitor->events) }};
        var name = {{json_encode($competitor->users->first_name)}}
        generateSplitTable(getNumber("1500m"), 170, 'Axel Rosado'); // For 800m in 120 seconds
       generateSplitTable(getNumber("1500m"), 170, 'Axel Rosado'); // For 1500m in 240 seconds
        generateSplitTable(getNumber("3000m obstáculos"), 630, 'Axel Rosado'); // For 3000m in 630 seconds*/
        document.addEventListener('DOMContentLoaded', function() {
        const events = JSON.parse('{!! $events !!}');

        events.forEach(event => {
            generateSplitTable(event.distance, event.time, '{{ $competitor->users->first_name }} {{ $competitor->users->last_name }}');
        });
    });

function secondsToMMSS(seconds) {
    const minutes = Math.floor(seconds / 60); // Find whole minutes
    const secs = Math.round(seconds % 60); // Find remaining seconds, rounded to nearest whole number
    return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

function generateSplitTable(eventDistance, eventTimeInSeconds, athleteName) {
    const splitsContainer = document.getElementById('splitsContainer');
    const athleteSection = document.createElement('div');
    athleteSection.classList.add('athlete-section');

    // Create the athlete information
    const athleteInfo = document.createElement('h3');
    athleteInfo.textContent = `${eventDistance}m (${secondsToMMSS(eventTimeInSeconds)})`;
    athleteSection.appendChild(athleteInfo);

    // Create the responsive table container with horizontal scrolling
    const responsiveTableContainer = document.createElement('div');
    responsiveTableContainer.classList.add('table-responsive');
    responsiveTableContainer.style.overflowX = 'auto';  // Ensures horizontal scrolling

    // Create the split table
    const table = document.createElement('table');
    table.classList.add('table', 'table-striped');
    const thead = document.createElement('thead');
    const tbody = document.createElement('tbody');

    // Header row for distances
    const headerRow = document.createElement('tr');
    headerRow.innerHTML = `<th>Distancia</th>`;
    for (let distance = 100; distance <= eventDistance; distance += 100) {
        let className = distance % 400 === 0 ? 'highlight-column' : '';
        headerRow.innerHTML += `<th class="${className}">${distance}m</th>`;
    }
    thead.appendChild(headerRow);

    // Row for times
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

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
