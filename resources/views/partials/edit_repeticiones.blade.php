<div>
    <hr class="short-hr">
    <label for="repeticion_sets_{{ $repeticiones->id }}">Sets:</label>
    <input type="number" class="small-input" id="repeticion_sets_{{ $repeticiones->id }}" name="Rsets_{{ $repeticiones->id }}" value="{{ $repeticiones->Rsets }}" min="1" max="30" placeholder="1-30"
           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2); this.setCustomValidity('');"
           oninvalid="this.setCustomValidity('Por favor, ingrese un número entre 1 y 30.')"
           title="Sets entre 1 a 30." required />

    <label for="repeticion_distance_{{ $repeticiones->id }}">, Distancia:</label>
    <input type="number" class="small-input" id="repeticion_distance_{{ $repeticiones->id }}" name="Rdistancia_{{ $repeticiones->id }}" value="{{ $repeticiones->Rdistancia }}" min="100" max="10000" step="100" placeholder="100+"
           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 5); this.setCustomValidity('');"
           title="Distancia entre 100 y 10000" required />

    m<label for="repeticion_expected_time_{{ $repeticiones->id }}">, Tiempo Esperado:</label>
    <input type="text" class="small-input time-input" id="repeticion_expected_time_{{ $repeticiones->id }}" name="Rtiempoesperado_{{ $repeticiones->id }}" value="{{sprintf('%02d:%02d', floor($repeticiones->Rtiempoesperado / 60), $repeticiones->Rtiempoesperado % 60)}}"
           placeholder="mm:ss"
           pattern="[0-9]{1,2}:[0-5][0-9]" maxlength="5"
           oninput="if (/[^0-9:]/.test(this.value)) this.value = this.value.replace(/[^0-9:]/g, ''); this.setCustomValidity('');"
           title="Por favor, siga el formato (MM:SS) para el tiempo esperado." required />

    <label for="repeticion_recovery_time_{{ $repeticiones->id }}">, Recuperación:</label>
    <input type="text" class="small-input time-input" id="repeticion_recovery_time_{{ $repeticiones->id }}" name="Rrecuperacion_{{ $repeticiones->id }}" value="{{sprintf('%02d:%02d', floor($repeticiones->Rrecuperacion / 60), $repeticiones->Rrecuperacion % 60)}}"
           placeholder="mm:ss"
           pattern="[0-9]{1,2}:[0-5][0-9]" maxlength="5"
           oninput="if (/[^0-9:]/.test(this.value)) this.value = this.value.replace(/[^0-9:]/g, ''); this.setCustomValidity('');"
           title="Por favor, siga el formato (MM:SS) para la recuperación." required />

</div>
