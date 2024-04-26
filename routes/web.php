<?php

use App\Http\Controllers\AccessCodeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LighttrainingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/lista_de_atletas', [UserController::class, 'indexs_lista_de_atletas'])->name('lista_de_atletas');

Route::get('/', function () {
    return redirect('/login');
})->middleware('guest');

Auth::routes();

// For Coach specific pages
/*Route::middleware(['auth', 'role:Entrenador'])->group(function () {
    Route::get('/coach/dashboard', [CoachController::class, 'index'])->name('coach.dashboard');
});

// For Athlete specific pages
Route::middleware(['auth', 'role:Atleta'])->group(function () {
    Route::get('/athlete/dashboard', [AthleteController::class, 'index'])->name('athlete.dashboard');
});*/

Route::middleware(['auth', 'role:Entrenador'])->group(function () {
    Route::get('/home', [AuthController::class, 'homepage'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:Atleta'])->group(function () {
    Route::get('/home', [AuthController::class, 'homepage'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::post('/users/{userId}/restore', [UserController::class, 'restoreUser'])->name('users.restore');
Route::get('/generate_code', [AccessCodeController::class, 'generateAccessCode'])->name('generate_code');
Route::post('/send-training-data', [LighttrainingController::class, 'sendTrainingData']);

Route::get('/register', [UserController::class, 'create'])->name('register')->middleware('guest');

Route::post('/register', [UserController::class, 'stores'])->name('register')->middleware('guest');

Route::get('/registers', [UserController::class, 'creates'])->name('registers')->middleware('guest');

Route::post('/registers', [UserController::class, 'coachstores'])->name('registers')->middleware('guest');

Route::get('/login', [AuthController::class, 'viewlogin'])->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');


Route::get('password/reset', [PasswordResetController::class, 'showResetRequestForm'])->name('password.request');

Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');

Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

Route::fallback(function(){
        return view('welcom');
});

//Atleta (Menú)
Route::get('/calendario_del_atleta', function () {
    return view('Atleta.calendario_del_atleta');
});
Route::get('/informacion_del_usuario_atleta', function () {
    return view('Atleta.informacion_del_usuario_atleta');
});
Route::get('/menu_principal_atleta', function () {
    return view('Atleta.menu_principal_atleta');
});
Route::get('/editar_informacion_del_usuario', function () {
    return view('Atleta.editar_informacion_del_usuario');
});


//Registro
Route::get('/inicio_de_sesion', function () {
    return view('auth.Register.inicio_de_sesion');
});
Route::get('/olvido_su_contrasena', function () {
    return view('auth.Register.olvido_su_contrasena');
});
Route::get('/registro', function () {
    return view('auth.Register.registro');
});
Route::get('/reestablecer_contraseña', function () {
    return view('auth.Register.reestablecer_contraseña');
});
// Route::get('/entrenadorregistro', function () {
//     return view('auth.Register.entrenadorregistro');
// });

//Entrenador
Route::get('/informacion_del_usuario_entrenador', function () {
    return view('Entrenador.informacion_del_usuario_entrenador');
});
Route::get('/menu_principal_entrenador', function () {
    return view('Entrenador.menu_principal_entrenador');
});
Route::get('/editar_informacion_del_usuario_entrenador', function () {
    return view('Entrenador.editar_informacion_del_usuario_entrenador');
});


//Entrenador-> Estrategia de Carreras
Route::get('/crear_nueva_competencia_estrategia_de_carreras', function () {
    return view('Entrenador.Estrategia de Carreras.crear_nueva_competencia_estrategia_de_carreras');
});
Route::get('/detalles_de_la_competencia_general', function () {
    return view('Entrenador.Estrategia de Carreras.detalles_de_la_competencia_general');
});
Route::get('/estrategia_de_carreras_general', function () {
    return view('Entrenador.Estrategia de Carreras.estrategia_de_carreras_general');
});
Route::get('/eventos_del_atleta', function () {
    return view('Entrenador.Estrategia de Carreras.eventos_del_atleta');
});
Route::get('/lista_de_competidores', function () {
    return view('Entrenador.Estrategia de Carreras.lista_de_competidores');
});
Route::get('/ver_split_table_atleta', function () {
    return view('Entrenador.Estrategia de Carreras.ver_split_table_atleta');
});
Route::get('/ver_split_table_general', function () {
    return view('Entrenador.Estrategia de Carreras.ver_split_table_general');
});
Route::get('/editar_detalles_de_la_competencia', function () {
    return view('Entrenador.Estrategia de Carreras.editar_detalles_de_la_competencia');
});

//Entrenador-> Lista de Atletas
Route::get('/compartir_aplicacion_web', function () {
    return view('Entrenador.Lista de Atletas.compartir_aplicacion_web');
});
Route::get('/crear_nueva_competencia_lista_de_atletas', function () {
    return view('Entrenador.Lista de Atletas.crear_nueva_competencia_lista_de_atletas');
});
Route::get('/detalles_de_la_competencia_atleta', function () {
    return view('Entrenador.Lista de Atletas.detalles_de_la_competencia_atleta');
});
Route::get('/editar_semana_de_entrenamiento_atleta', function () {
    return view('Entrenador.Lista de Atletas.editar_semana_de_entrenamiento_atleta');
});
Route::get('/entrenamiento_del_atleta', function () {
    return view('Entrenador.Lista de Atletas.entrenamiento_del_atleta');
});
Route::get('/estrategia_de_carrera_atleta', function () {
    return view('Entrenador.Lista de Atletas.estrategia_de_carrera_atleta');
});
Route::get('/informacion_del_atleta', function () {
    return view('Entrenador.Lista de Atletas.informacion_del_atleta');
});
Route::get('/lista_de_atletas', function () {
    return view('Entrenador.Lista de Atletas.lista_de_atletas');
});

Route::get('/registro_del_atleta', function () {
    return view('Entrenador.Lista de Atletas.registro_del_atleta');
});
Route::get('/rehabilitar_cuentas', function () {
    return view('Entrenador.Lista de Atletas.rehabilitar_cuentas');
});
Route::get('/editar_detalles_de_la_competencia_atleta', function () {
    return view('Entrenador.Lista de Atletas.editar_detalles_de_la_competencia_atleta');
});



//Entrenador-> Registro de Entrenamientos
Route::get('/asignar_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro de Entrenamientos.asignar_semana_de_entrenamiento');
});
Route::get('/crear_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro de Entrenamientos.crear_semana_de_entrenamiento');
});
Route::get('/detalles_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro de Entrenamientos.detalles_semana_de_entrenamiento');
});
Route::get('/editar_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro de Entrenamientos.editar_semana_de_entrenamiento');
});
Route::get('/lista_de_entrenamientos', function () {
    return view('Entrenador.Registro de Entrenamientos.lista_de_entrenamientos');
});
Route::get('/registro_de_entrenamientos', function () {
    return view('Entrenador.Registro de Entrenamientos.registro_de_entrenamientos');
});

//Entrenador-> Sistema de Luces
Route::get('/crear_sistema_de_luces', function () {
    return view('Entrenador.Sistema de Luces.crear_sistema_de_luces');
});
Route::get('/entrenamiento_de_luces', function () {
    return view('Entrenador.Sistema de Luces.entrenamiento_de_luces');
});
Route::get('/lista_de_sistema_de_luces', function () {
    return view('Entrenador.Sistema de Luces.lista_de_sistema_de_luces');
});
Route::get('/sistema_de_luces', function () {
    return view('Entrenador.Sistema de Luces.sistema_de_luces');
});




