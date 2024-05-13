<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Atletas</title>
    <link href="{{asset('Css/styles.css')}}" rel="stylesheet">
    <a href="/home" style="text-decoration: none;">
        <div class="logo-container">
            <div class="logo-text">LTSMT</div>
        </div>
    </a>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

        <nav class="navbar custom-navbar">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">Menú Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/lista">Lista de Atletas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/schedule">Registro de Entrenamientos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/competition">Lista de Competencias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/light">Sistema de Luces</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1 class="text-center">Lista de Atletas</h1>
        @if(session()->has('Exito'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('Exito')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
            @endif
        <div class="d-flex justify-content-between mb-4">
            <a href="/home" class="btn btn-primary">Regresar</a>
            <a href="/generate_code" class="btn btn-primary">Compartir Aplicación Web</a>
        </div>
        <div class="d-grid gap-3" id="athletes-list">

            @if($users->isEmpty())
            <h5 class="text-center">No hay atletas registrados.</h5>
            @else
                <input type="text" id="searchInput" onkeyup="filterList()" placeholder="Buscar nombres..." class="form-control mb-3">

                <div class="d-grid gap-3" id="athletes-list">
                    @foreach($users as $user)
                        <a href="{{ route('athlete.details', ['user'=> $user->id]) }}" class="btn btn-primary btn-lg" style="display: block;">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </a>
                    @endforeach
                </div>

            @endif
        </div>
{{--
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links('pagination::bootstrap-4') }}
        </div> --}}

        <div class="d-flex justify-content-end">
            <a href="/lista/restore/delete" class="btn btn-primary mt-4">Activar Cuentas</a>
        </div>
    </div>

    <script>
        function filterList() {
            let input = document.getElementById('searchInput');
            let filter = input.value.toUpperCase();
            let list = document.getElementById('athletes-list');
            let a = list.getElementsByTagName('a');

            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
        </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
