<div>
    <label for="fondo_distance_{{ $fondos->id }}">Distance:</label>
    <input type="number" id="fondo_distance_{{ $fondos->id }}" name="Fdistancia_{{ $fondos->id }}" value="{{ $fondos->Fdistancia }}" min="1">
    <label for="fondo_zone_{{ $fondos->id }}">Zone:</label>
    <input type="number" id="fondo_zone_{{ $fondos->id }}" name="Fzona_{{ $fondos->id }}" value="{{ $fondos->Fzona }}" min="1" max="5">
</div>
