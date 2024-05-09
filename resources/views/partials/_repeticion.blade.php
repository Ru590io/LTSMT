<div>
    Sets: {{ $activity->Rsets }} + {{ $activity->Rdistancia }} m + Tiempo: <span data-seconds="{{ $activity->Rtiempoesperado }}" class="formatted-time">{{ $activity->Rtiempoesperado }}</span> + Recuperación: <span data-seconds="{{ $activity->Rrecuperacion }}" class="formatted-time">{{ $activity->Rrecuperacion }}</span> + Enfriamiento: 10:00 + flex
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timeElements = document.querySelectorAll('.formatted-time');

        timeElements.forEach(element => {
            const totalSeconds = parseInt(element.getAttribute('data-seconds'), 10);
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            const formattedTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            element.textContent = formattedTime;
        });
    });
    </script>
