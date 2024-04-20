<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

//Entrenador
Route::get('/informacion_del_usuario_entrenador', function () {
    return view('Entrenador.informacion_del_usuario_entrenador');
});
Route::get('/menu_principal_entrenador', function () {
    return view('Entrenador.menu_principal_entrenador');
});

//Entrenador-> Estrategia de Carreras
Route::get('/crear_nueva_competencia', function () {
    return view('Entrenador.Estrategia de Carreras.crear_nueva_competencia');
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

//Entrenador-> Lista de Atletas
Route::get('/compartir_aplicacion_web', function () {
    return view('Entrenador.Lista de Atletas.compartir_aplicacion_web');
});
Route::get('/crear_nueva_competencia', function () {
    return view('Entrenador.Lista de Atletas.crear_nueva_competencia');
});
Route::get('/detalles_de_la_competencia_atleta', function () {
    return view('Entrenador.Lista de Atletas.detalles_de_la_competencia_atleta');
});
Route::get('/editar_semana_de_entrenamiento', function () {
    return view('Entrenador.Lista de Atletas.editar_semana_de_entrenamiento');
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

//Entrenador-> Registro de Entrenamientos
Route::get('/asignar_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro de Entrenamientos.asignar_semana_de_entrenamiento');
});
Route::get('/crear_semana_de_entrenameitno', function () {
    return view('Entrenador.Registro de Entrenamientos.crear_semana_de_entrenameitno');
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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/done', [UserController::class, 'index'])->name('welcom');

Route::get('/register', [UserController::class, 'create'])->name('register');

Route::post('/register', [UserController::class, 'stores'])->name('register');

//Route::get('/login', [UserController::class, 'indexs'])->name('login');
