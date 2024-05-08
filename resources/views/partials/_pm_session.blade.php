<div>
    <h3>PM Session</h3>
    @if ($pmSession->descansos)
        @include('partials._descanso', ['activity' => $pmSession->descansos])
    @endif
    @if ($pmSession->fondos)
        @include('partials._fondo', ['activity' => $pmSession->fondos])
    @endif
    @if ($pmSession->repeticiones)
        @include('partials._repeticion', ['activity' => $pmSession->repeticiones])
    @endif
</div>
