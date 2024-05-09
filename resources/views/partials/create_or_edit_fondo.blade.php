@foreach($day->$part as $session)
    @foreach($session->fondos as $fondo)

            @include('partials.edit_fondo', ['fondo' => $fondo])

            <!-- No fondos exist, provide form to create one -->
        <label for="new_fondo_distance">Distance:</label>
        <input type="number" id="new_fondo_distance" name="Fdistancia" value="" min="1">
        <label for="new_fondo_zone">Zone:</label>
        <input type="number" id="new_fondo_zone" name="Fzona" value="" min="1" max="5">
        
    @endforeach
@endforeach
