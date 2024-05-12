<div>
    <label for="fondo_distance_{{ $fondos->id }}">Distancia:</label>
    <input type="number" class="small-input" id="fondo_distance_{{ $fondos->id }}" name="Fdistancia_{{ $fondos->id }}" value="{{ $fondos->Fdistancia }}"
           min="1" max="30" placeholder="1-30"
           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2); this.setCustomValidity('');"
           oninvalid="this.setCustomValidity('Por favor, ingrese un número entre 1 y 30.')"
           title="Kilometros entre 1 a 30." required /> Km

    <label for="fondo_zone_{{ $fondos->id }}">, Zona:</label>
    <select id="fondo_zone_{{ $fondos->id }}" name="Fzona_{{ $fondos->id }}" required>
        <option value="" disabled selected>Select Zone</option>
        <option value="2" {{ $fondos->Fzona == 2 ? 'selected' : '' }}>2</option>
        <option value="3" {{ $fondos->Fzona == 3 ? 'selected' : '' }}>3</option>
        <option value="4" {{ $fondos->Fzona == 4 ? 'selected' : '' }}>4</option>
        <option value="5" {{ $fondos->Fzona == 5 ? 'selected' : '' }}>5</option>
    </select>
</div>
