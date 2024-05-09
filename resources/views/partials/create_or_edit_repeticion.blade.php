@foreach($day->$part as $session)
    @foreach($session->repeticiones as $repeticion)

        @include('partials.edit_repeticion', ['repeticion' => $repeticion])

    <!-- No repeticiones exist, provide form to create one -->
    <div id="repeticiones_container_{{ $part }}">
    <div>
        <label for="new_repeticion_sets">New Sets:</label>
        <input type="number" id="new_repeticion_sets" name="Rsets" placeholder="Enter sets" min="1">
        <label for="new_repeticion_distance">New Distance (m):</label>
        <input type="number" id="new_repeticion_distance" name="Rdistancia" placeholder="Enter distance" min="100">
        <label for="new_repeticion_expected_time">New Expected Time:</label>
        <input type="text" id="new_repeticion_expected_time" name="Rtiempoesperado" placeholder="Enter expected time">
        <label for="new_repeticion_recovery_time">New Recovery Time:</label>
        <input type="text" id="new_repeticion_recovery_time" name="Rrecuperacion" placeholder="Enter recovery time">


    </div>
    <button type="button" onclick="addRepeticion('{{ $part }}')">Add New Repeticion</button>
    </div>
    <script>
        function addRepeticion(part) {
            const container = document.getElementById('repeticiones_container_' + part);
            const newEntry = document.createElement('div');
            newEntry.className = 'repeticion-entry';
            newEntry.innerHTML = `
                <label>Sets:</label>
                <input type="number" name="repeticiones[new][Rsets][]" min="1">
                <label>Distance (m):</label>
                <input type="number" name="repeticiones[new][Rdistancia][]" min="100">
                <label>Expected Time:</label>
                <input type="text" name="repeticiones[new][Rtiempoesperado][]">
                <label>Recovery Time:</label>
                <input type="text" name="repeticiones[new][Rrecuperacion][]">
            `;
            container.appendChild(newEntry);
        }
        </script>

    @endforeach
@endforeach
