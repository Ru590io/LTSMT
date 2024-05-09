@foreach($day->$part as $session)
    @foreach($session->descansos as $descanso)

        @include('partials.edit_descanso', ['descanso' => $descanso])

    <!-- No descansos exist, provide form to create one -->
    <div>
        <label for="new_descanso_name">New Name:</label>
        <input type="text" id="new_descanso_name" name="Descanso" placeholder="Enter descanso name">
    </div>

    @endforeach
@endforeach

