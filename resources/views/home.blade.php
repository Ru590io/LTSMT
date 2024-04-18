@extends('layouts.app')

@section('content')
<h1 class="text-center">Menú Principal</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="d-flex justify-content-end">
            <button id="userInfoButton" class="btn btn-primary mb-3">Información del Usuario</button>
        </div>
        <!-- Big Buttons -->
        <div class="d-grid gap-3">
            <button id="rosterButton" class="btn btn-primary btn-lg">Lista de Atletas</button>
            <button id="trainingLogButton" class="btn btn-primary btn-lg">Registro de Entrenamientos</button>
            <button id="raceStrategyButton" class="btn btn-primary btn-lg">Estrategia de Carreras</button>
            <button id="raceStrategyButton" class="btn btn-primary btn-lg">Sistema de Luces</button>
            <form class= "form mt-5" action="{{route('logout')}}" method="post">
                @csrf
                <button class="btn btn-danger btn-sm" type="submit">Terminar Sesión </button>
            <form>
        </div>
    </div>
</div>
@endsection
