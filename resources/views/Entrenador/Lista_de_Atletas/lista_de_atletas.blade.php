<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Atletas</title>
    <link href="{{url('Css/styles.css')}}" rel="stylesheet">
    <div class="logo-container">
        <div class="logo-text">LTSMT</div>
    </div>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Lista de Atletas</h1>
        <div class="d-flex justify-content-between mb-4">
            <a href="/home" class="btn btn-primary">Regresar</a>
            <a href="/generate_code" class="btn btn-primary">Compartir Aplicación Web</a>
        </div>
        <div class="d-grid gap-3" id="athletes-list">
            @foreach($users as $user)
                    <a href="{{ route('user.lista', ['user' => $user->id]) }}" class="btn btn-primary btn-lg">{{ $user->first_name }} {{ $user->last_name }}</a>
            @endforeach
        </div>
        <div class="d-flex justify-content-end">
            <a href="/lista/deleted" class="btn btn-primary mt-4">Rehabilitar Cuentas</a>
        </div>
    </div>

    <script>
        // fetch('atletas.json')
        //     .then(response => {
        //         if (!response.ok) {
        //             throw new Error('Network response was not ok');
        //         }
        //         return response.json();
        //     })
        //     .then(athletes => {
        //         console.log(athletes);  // Verifica qué datos estás recibiendo exactamente
        //         const container = document.getElementById('athletes-list');
        //         athletes.forEach(athlete => {
        //             const anchor = document.createElement('a');
        //             anchor.href = 'registro_del_atleta';
        //             anchor.className = 'btn btn-primary btn-lg';
        //             anchor.textContent = athlete.name;
        //             container.appendChild(anchor);
        //         });
        //     })
        //     .catch(error => console.error('Error loading the athletes:', error));

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
