<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Calendario del Atleta</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Calendario del Atleta</h1>
        <div class="text-left mt-4">
            <a href="menu_principal_atleta" class="btn btn-primary mb-3">Regresar</a>
        </div>
        <div class="text-center mb-3">
            <a href="#" class="btn">&lt;</a> <!-- Previous week -->
            <select class="form-select d-inline-block w-auto" id="weekDropdown">
                <option value="week1">6 Marzo 24 - 12 Marzo 24</option>
                <!-- More weeks can be added here -->
            </select>
            <a href="#" class="btn">&gt;</a> <!-- Next week -->
        </div>
        <div id="schedule">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const weekDropdown = document.getElementById('weekDropdown');

            function loadWeekData(week) {
                fetch('athlete_schedules.json')  // Make sure this path matches your JSON file location
                .then(response => response.json())
                .then(data => {
                    updateSchedule(data.weeks[week]);
                });
            }

            function updateSchedule(weekData) {
                const scheduleContainer = document.getElementById('schedule');
                scheduleContainer.innerHTML = ''; // Clear current schedule

                Object.entries(weekData.days).forEach(([day, activities]) => {
                    const dayCard = document.createElement('div');
                    dayCard.className = 'card mb-5';
                    dayCard.innerHTML = `
                        <div class="card-header"><h3 class="centered-text">${day}</h3></div>
                        <div class="card-body">
                            <h3>AM:</h3>
                            ${activities.AM.map(activity => `<div>${activity}</div>`).join('')}
                            <hr>
                            <h3>PM:</h3>
                            ${activities.PM.map(activity => `<div>${activity}</div>`).join('')}
                            <hr>
                            <div class="notes-section">
                                <label><h4>Notas:</h4></label>
                                ${activities.Notes}
                            </div>
                        </div>
                    `;
                    scheduleContainer.appendChild(dayCard);
                });
            }

            weekDropdown.addEventListener('change', function() {
                loadWeekData(this.value);
            });

            loadWeekData(weekDropdown.value);
        });
    </script>
</body>
</html>
