<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Split Tables Atletas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
    <div class="container">
        <h1 class="text-center">Split Tables para Atleta</h1>
        <h2 class="text-center mt-5">Axel Rosado</h2>
        <div class="text-left mt-4">
            <a href="your_back_link.html" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <div id="splitsContainer" class="mt-5">
            <!-- Las tablas de splits y la información del atleta se generarán aquí -->
        </div>
    </div>

    <script>
        // Function to convert seconds to mm:ss format
        function secondsToMMSS(seconds) {
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
        generateSplitTable(800, 90, 'Axel Rosado'); // For 800m in 120 seconds
        generateSplitTable(1500, 170, 'Axel Rosado'); // For 1500m in 240 seconds
        generateSplitTable(3000, 630, 'Axel Rosado'); // For 3000m in 630 seconds
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
