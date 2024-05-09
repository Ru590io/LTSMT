<div>
    <label for="repeticion_sets_{{ $repeticiones->id }}">Sets:</label>
    <input type="number" id="repeticion_sets_{{ $repeticiones->id }}" name="Rsets_{{ $repeticiones->id }}" value="{{ $repeticiones->Rsets }}" min="1">
    <label for="repeticion_distance_{{ $repeticiones->id }}">Distance:</label>
    <input type="number" id="repeticion_distance_{{ $repeticiones->id }}" name="Rdistancia_{{ $repeticiones->id }}" value="{{ $repeticiones->Rdistancia }}" min="100">
    <label for="repeticion_expected_time_{{ $repeticiones->id }}">Expected Time:</label>
    <input type="number" id="repeticion_expected_time_{{ $repeticiones->id }}" name="Rtiempoesperado_{{ $repeticiones->id }}" value="{{ $repeticiones->Rtiempoesperado }}">
    <label for="repeticion_recovery_time_{{ $repeticiones->id }}">Recovery Time:</label>
    <input type="number" id="repeticion_recovery_time_{{ $repeticiones->id }}" name="Rrecuperacion_{{ $repeticiones->id }}" value="{{ $repeticiones->Rrecuperacion }}">
</div>
