<div>
    <h3>AM Session</h3>
    @if ($amSession->descansos)
        @include('partials._descanso', ['activity' => $amSession->descansos])
    @endif
    @if ($amSession->fondos)
        @include('partials._fondo', ['activity' => $amSession->fondos])
    @endif
    @if ($amSession->repeticiones)
        @include('partials._repeticion', ['activity' => $amSession->repeticiones])
    @endif
</div>
