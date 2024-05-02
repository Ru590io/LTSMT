<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Split Tables General</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Split Tables General</h1>
        <div class="text-left mt-4">
            <a href="detalles_de_la_competencia_general" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <div class="text-center mb-3">
            <a href="#" class="btn" onclick="navigateEventDistance(-1)">&lt;</a>
            <select class="form-select d-inline-block w-auto" id="eventDistanceDropdown" onchange="updateEventDistance()">
                <option value="all">Todos los Eventos</option>
                <option value="800">800m</option>
                <option value="1500">1500m</option>
                <option value="3000">3000m obs</option>
                <option value="5000">5000m</option>
                <option value="10000">10000m</option>
            </select>
            <a href="#" class="btn" onclick="navigateEventDistance(1)">&gt;</a>
        </div>
        <div id="splitsContainer">
            <!-- Las tablas de splits para los atletas se generarán aquí -->
        </div>
    </div>

    <script>
            function getNumber(eventString) {
                const result = eventString.match(/\d+/); // This regex matches any sequence of digits in the string
                return result ? parseInt(result[0], 10) : null; // Convert the found string to a number, or return null if nothing is found
            }
        // Datos de ejemplo de atletas getnubers()
        const athletesData = [
            { name: 'Axel Rosado', event: getNumber("800m"), time: 300 },
            { name: 'Enrique Chompré', event: getNumber("10000m"), time: 120 },
            { name: 'Guillermo Colón', event: getNumber("1500m"), time: 180 },
            { name: 'Rubén Marrero', event: getNumber("800m"), time: 120 },
            { name: 'Rubén Marrero', event: getNumber("3000m"), time: 420 },
            { name: 'Rubén Marrero', event: getNumber("5000m"), time: 800 },

            // Agrega más atletas aquí

        ];

        function secondsToMMSS(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        function generateSplitTable(eventDistance, eventTimeInSeconds, athleteName, container) {
            const athleteSection = document.createElement('div');
            athleteSection.classList.add('athlete-section');

            // Create the athlete information
            const athleteInfo = document.createElement('h3');
            athleteInfo.textContent = `${eventDistance}m (${secondsToMMSS(eventTimeInSeconds)})`;
            athleteSection.appendChild(athleteInfo);

            const responsiveTableContainer = document.createElement('div');
            responsiveTableContainer.classList.add('table-responsive');

            const table = document.createElement('table');
            table.classList.add('table', 'table-striped');
            const thead = document.createElement('thead');
            const tbody = document.createElement('tbody');

            const headerRow = document.createElement('tr');
            headerRow.innerHTML = `<th>Atleta</th><th>Distancia</th>`;
            for (let distance = 100; distance <= eventDistance; distance += 100) {
                let className = distance % 400 === 0 ? 'highlight-column' : '';
                headerRow.innerHTML += `<th class="${className}">${distance}m</th>`;
            }
            thead.appendChild(headerRow);

            const timeRow = document.createElement('tr');
            timeRow.innerHTML = `<td>${athleteName}</td><td>Tiempo</td>`;
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
            container.appendChild(athleteSection);
        }

        function updateEventDistance(newDistance) {
            const splitsContainer = document.getElementById("splitsContainer");
            splitsContainer.innerHTML = ''; // Limpiar tablas anteriores

            const selectedDistance = newDistance || document.getElementById("eventDistanceDropdown").value;
            let athletes;
            if (selectedDistance === "all") {
                athletes = athletesData;
            } else {
                athletes = athletesData.filter(athlete => athlete.event === parseInt(selectedDistance));
            }

            athletes.forEach(athlete => {
                generateSplitTable(parseInt(athlete.event), athlete.time, athlete.name, splitsContainer);
            });
        }

        function navigateEventDistance(direction) {
            const dropdown = document.getElementById('eventDistanceDropdown');
            const currentIndex = dropdown.selectedIndex;
            const maxIndex = dropdown.options.length - 1;

            if (direction === -1 && currentIndex > 0) {
                // Ir al evento anterior
                dropdown.selectedIndex = currentIndex - 1;
            } else if (direction === 1 && currentIndex < maxIndex) {
                // Ir al próximo evento
                dropdown.selectedIndex = currentIndex + 1;
            }
            updateEventDistance(dropdown.value);
        }

        // Carga inicial de las tablas para el primer evento
        document.addEventListener('DOMContentLoaded', function() {
            updateEventDistance(); // Cargar automáticamente el primer conjunto de tablas
        });

    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
