<?php

use App\Http\Controllers\AccessCodeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\CompetitorsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LighttrainingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\WeeklysheduleController;

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

//Route::get('/lista_de_atletas', [UserController::class, 'indexs_lista_de_atletas'])->name('lista_de_atletas');

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
    //Informacion de Entrenador
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/entrenadorinfo/{user}', [UserController::class, 'entrenadorindexs'])->name('coach.index');
    Route::get('/entrenadorinfo/coach/{user}/edit', [UserController::class, 'entrenadoredits'])->name('entrenador.edit');
    Route::put('/entrenadorinfo/coach/{user}/update', [UserController::class, 'coachupdates'])->name('entrenador.update');
    Route::get('/entrenadorinfo/coach/password', [PasswordResetController::class, 'editpassword'])->name('password.edit');
    Route::post('/entrenadorinfo/coach/password', [PasswordResetController::class, 'entrenadorreset'])->name('password.updates');

    //Home de Entrenador
    Route::get('/home', [UserController::class, 'homepage'])->name('home');

    //Compartir pagina, Ccodigo de Acceso y Restaurar Atletas
    Route::get('/lista', [UserController::class, 'athleteindexs'])->name('users.index');
    Route::get('lista/{user}', [UserController::class, 'showathlete'])->name('user.lista');
    Route::get('/generate_code', [AccessCodeController::class, 'shareweb'])->name('generate_code');
    Route::post('/generate_code', [AccessCodeController::class, 'generateAccessCode'])->name('generate_code');
    Route::get('/lista/restore/delete', [UserController::class, 'showdeleted'])->name('users.deleted');
    Route::put('/lista/restore/{user}/restore', [UserController::class, 'restoreUser'])->name('users.restore');

    //Sistema de Luces
    Route::get('/light', [LighttrainingController::class, 'create'])->name('light.index');
    Route::get('/light/add', [LighttrainingController::class, 'index'])->name('light.add');
    Route::post('/light/add', [LighttrainingController::class, 'store'])->name('light.add');
    Route::get('/light/list', [LighttrainingController::class, 'lighttraininglist'])->name('light.list');
    Route::delete('/light/list/{lighttraining}/destroy', [LighttrainingController::class, 'destroy'])->name('light.delete');
    Route::get('/light/list/{lighttraining}',[LighttrainingController::class, 'show'])->name('light.show');

    //Competitions
    Route::get('/competition', [CompetitionController::class, 'competitionlist'])->name('competition.list');
    Route::get('/competition/list/{competition}',[CompetitionController::class, 'shows'])->name('competition.show');
    Route::get('/competition/add', [CompetitionController::class, 'addindex'])->name('competition.add');
    Route::post('/competition/add', [CompetitionController::class, 'stores'])->name('competition.add');
    Route::get('/competition/list/updates/{competition}/edit', [CompetitionController::class, 'edits'])->name('competition.edit');
    Route::put('/competition/list/updates/{competition}/update', [CompetitionController::class, 'updates'])->name('competition.update');
    Route::delete('/competition/list/{competition}/destroy', [CompetitionController::class, 'destroys'])->name('competition.delete');
    Route::post('/competition/list/asignar/atleta', [CompetitionController::class, 'assignarAtleta'])->name('competition.atleta');
    Route::get('/competition/list/{id}/asignar/atleta', [CompetitionController::class, 'competitionshows'])->name('competition.listatleta');

    //Lista de Atletas
    Route::get('/athlete/{user}', [UserController::class, 'showAthleteDetails'])->name('athlete.details');
    Route::get('/athlete/athleteinfo/{user}', [UserController::class, 'viewAthleteInfo'])->name('athlete.info');
    Route::get('/athlete/athletetraining/{user}', [UserController::class, 'trainingLogs'])->name('athlete.training');
    //Route::get('/athlete/athletecompetitions/{user}', [UserController::class, 'raceStrategy'])->name('athlete.strategy');
    Route::delete('/athlete/athleteinfo/{user}/distroyAthlete', [UserController::class, 'destroyAthlete'])->name('athlete.delete');


    Route::post('/competition/list/asignar/atleta', [CompetitionController::class, 'assignarAtleta'])->name('competition.atleta');
    //Route::get('/competition/list/{id}/asignar/atleta', [CompetitionController::class, 'competitionshows'])->name('competition.listatleta');

    Route::get('/athlete/athletecompetitions/{user}', [UserController::class, 'athleteCompetitions'])->name('athlete.strategy');
    Route::get('/athlete/athletecompetitions/{user}/detalles/{competition}', [UserController::class, 'competitionDetails'])->name('competition.details');
    Route::post('/athlete/{user}/competitions/{competition}/events', [EventsController::class, 'storeEvents'])->name('event.add');
    Route::delete('/athlete/{user}/competitions/{competition}/events/{event}', [EventsController::class, 'destroys'])->name('event.delete');

    //Lista de Atletas (new)
    Route::get('/athlete/athletetraininglist/{user}', [UserController::class, 'trainingLogsList'])->name('athlete.traininglist');
    Route::get('/athlete/athletetraininglist/{id}/weekdetails', [UserController::class, 'trainingLogsWeekDetails'])->name('athlete.trainingweekdetails');
    Route::get('/athlete/athletetraininglist/{user}/weekdetails/edit', [UserController::class, 'trainingLogsWeekEdit'])->name('athlete.trainingweekedit');
    Route::put('/athlete/athletetraininglist/{user}/weekdetails/edit', [UserController::class, 'trainingLogsWeekEditUpdate'])->name('athlete.trainingweekeditupdate');


    //Eventos
    Route::get('/competition/list/asignar/atleta/done/{id}', [EventsController::class, 'compshows'])->name('competitors.listing');
    Route::post('/competition/list/asignar/atleta/done/{id}', [EventsController::class, 'storeEvents'])->name('event.add');
    Route::delete('/competition/list/asignar/atleta/done/{event}/destroy', [EventsController::class, 'destroys'])->name('event.delete');
    Route::delete('/competition/list/asignar/atleta/done/comp/{competitor}/destroy', [EventsController::class, 'atheltedestroy'])->name('competitor.delete');


    //Split_Tables
    Route::get('/competition/list/asignar/atleta/{id}/tabla', [EventsController::class, 'splittableatleta'])->name('table.atleta');
    Route::get('/competition/list/tabla/general/{id}/atletas', [EventsController::class, 'splittablegeneral'])->name('table.general');


    //Weeklyshedule
    Route::get('/schedule', [WeeklysheduleController::class, 'optionsweek'])->name('schedule');
    Route::get('/schedule/add', [WeeklysheduleController::class, 'createweek'])->name('schedule.add');
    Route::post('/schedule/add', [WeeklysheduleController::class, 'createweekschedules'])->name('schedule.add');
    Route::get('/schedule/add/show/{id}', [WeeklysheduleController::class, 'showweekly'])->name('week.show');
    Route::put('/schedule/add/show/{id}', [WeeklysheduleController::class, 'updateweekly'])->name('week.assign');
    Route::get('/schedule/add/show/week/athletes', [WeeklysheduleController::class, 'listofweekatheletes'])->name('week.athletes');
    Route::get('/schedule/add/show/week/athletes/{id}', [WeeklysheduleController::class, 'listofweeks'])->name('week.listed');
    Route::get('/schedule/add/show/week/athletes/view/{id}', [WeeklysheduleController::class, 'viewweek'])->name('week.view');
    Route::get('/schedule/add/show/week/athletes/view/edit/{id}', [WeeklysheduleController::class, 'editweek'])->name('week.edit');
    Route::put('/schedule/add/show/week/athletes/view/edit/{id}', [WeeklysheduleController::class, 'updateweek'])->name('week.update');

});

Route::middleware(['auth', 'role:Atleta'])->group(function () {
    //Informacion del Atleta
    Route::post('/logouts', [AuthController::class, 'athletelogout'])->name('atlogout');
    Route::get('/atlhome', [UserController::class, 'athletehome'])->name('home.atleta');
    Route::get('/atletainfo/{user}', [UserController::class, 'atletaindex'])->name('atleta.index');
    Route::get('/atletainfo/athlete/{user}/edit', [UserController::class, 'athletedits'])->name('atleta.edit');
    Route::put('/atletainfo/athlete/{user}/update', [UserController::class, 'coachupdates'])->name('atleta.update');
    Route::get('/atletainfo/athlete/password', [PasswordResetController::class, 'atletaeditpassword'])->name('password.edits');
    Route::post('/atletainfo/athlete/password', [PasswordResetController::class, 'entrenadorreset'])->name('password.updated');
    Route::get('/atletaweeks/list/{id}', [UserController::class, 'athleteweeks'])->name('atleta.weeks');
    Route::get('/atletaweeks/list/weekdetails/{id}', [UserController::class, 'athleteweeksdetails'])->name('atleta.weeksdetails');
});

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
    return view('Entrenador.Estrategia_de_Carreras.crear_nueva_competencia_estrategia_de_carreras');
});
Route::get('/detalles_de_la_competencia_general', function () {
    return view('Entrenador.Estrategia_de_Carreras.detalles_de_la_competencia_general');
});
Route::get('/estrategia_de_carreras_general', function () {
    return view('Entrenador.Estrategia_de_Carreras.estrategia_de_carreras_general');
});
Route::get('/eventos_del_atleta', function () {
    return view('Entrenador.Estrategia_de_Carreras.eventos_del_atleta');
});
Route::get('/lista_de_competidores', function () {
    return view('Entrenador.Estrategia_de_Carreras.lista_de_competidores');
});
Route::get('/ver_split_table_atleta', function () {
    return view('Entrenador.Estrategia_de_Carreras.ver_split_table_atleta');
});
Route::get('/ver_split_table_general', function () {
    return view('Entrenador.Estrategia_de_Carreras.ver_split_table_general');
});
Route::get('/editar_detalles_de_la_competencia', function () {
    return view('Entrenador.Estrategia_de_Carreras.editar_detalles_de_la_competencia');
});


// Entrenador -> Registro de Entrenamientos (NEW VERSION)

Route::get('/new_asignar_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro_de_Entrenamientos.new_asignar_semana_de_entrenamiento');
});

Route::get('/new_atletas_con_semanas_asignadas', function () {
    return view('Entrenador.Registro_de_Entrenamientos.new_atletas_con_semanas_asignadas');
});

Route::get('/new_crear_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro_de_Entrenamientos.new_crear_semana_de_entrenamiento');
});

Route::get('/new_detalles_de_la_semana_del_atleta', function () {
    return view('Entrenador.Registro_de_Entrenamientos.new_detalles_de_la_semana_del_atleta');
});

Route::get('/new_editar_semana_del_atleta', function () {
    return view('Entrenador.Registro_de_Entrenamientos.new_editar_semana_del_atleta');
});

Route::get('/new_registro_de_entrenamientos', function () {
    return view('Entrenador.Registro_de_Entrenamientos.new_registro_de_entrenamientos');
});

Route::get('/new_semanas_del_atleta', function () {
    return view('Entrenador.Registro_de_Entrenamientos.new_semanas_del_atleta');
});



//Entrenador-> Lista de Atletas
Route::get('/compartir_aplicacion_web', function () {
    return view('Entrenador.Lista_de_Atletas.compartir_aplicacion_web');
});
Route::get('/crear_nueva_competencia_lista_de_atletas', function () {
    return view('Entrenador.Lista_de_Atletas.crear_nueva_competencia_lista_de_atletas');
});
Route::get('/detalles_de_la_competencia_atleta', function () {
    return view('Entrenador.Lista_de_Atletas.detalles_de_la_competencia_atleta');
});
Route::get('/editar_semana_de_entrenamiento_atleta', function () {
    return view('Entrenador.Lista_de_Atletas.editar_semana_de_entrenamiento_atleta');
});
Route::get('/entrenamiento_del_atleta', function () {
    return view('Entrenador.Lista_de_Atletas.entrenamiento_del_atleta');
});
Route::get('/estrategia_de_carrera_atleta', function () {
    return view('Entrenador.Lista_de_Atletas.estrategia_de_carrera_atleta');
});
Route::get('/informacion_del_atleta', function () {
    return view('Entrenador.Lista_de_Atletas.informacion_del_atleta');
});
Route::get('/lista_de_atletas', function () {
    return view('Entrenador.Lista_de_Atletas.lista_de_atletas');
});

Route::get('/registro_del_atleta', function () {
    return view('Entrenador.Lista_de_Atletas.registro_del_atleta');
});
Route::get('/rehabilitar_cuentas', function () {
    return view('Entrenador.Lista_de_Atletas.rehabilitar_cuentas');
});
Route::get('/editar_detalles_de_la_competencia_atleta', function () {
    return view('Entrenador.Lista_de_Atletas.editar_detalles_de_la_competencia_atleta');
});



//Entrenador-> Registro de Entrenamientos
Route::get('/asignar_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro_de_Entrenamientos.asignar_semana_de_entrenamiento');
});
Route::get('/crear_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro_de_Entrenamientos.crear_semana_de_entrenamiento');
});
Route::get('/detalles_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro_de_Entrenamientos.detalles_semana_de_entrenamiento');
});
Route::get('/editar_semana_de_entrenamiento', function () {
    return view('Entrenador.Registro_de_Entrenamientos.editar_semana_de_entrenamiento');
});
Route::get('/lista_de_entrenamientos', function () {
    return view('Entrenador.Registro_de_Entrenamientos.lista_de_entrenamientos');
});
Route::get('/registro_de_entrenamientos', function () {
    return view('Entrenador.Registro_de_Entrenamientos.registro_de_entrenamientos');
});
Route::get('/calendario_de_atletas', function () {
    return view('Entrenador.Registro_de_Entrenamientos.calendario_de_atletas');
});
Route::get('/editar_semana_del_atleta', function () {
    return view('Entrenador.Registro_de_Entrenamientos.editar_semana_del_atleta');
});


//Entrenador-> Sistema de Luces
Route::get('/crear_sistema_de_luces', function () {
    return view('Entrenador.Sistema_de_Luces.crear_sistema_de_luces');
});
Route::get('/entrenamiento_de_luces', function () {
    return view('Entrenador.Sistema_de_Luces.entrenamiento_de_luces');
});
Route::get('/lista_de_sistema_de_luces', function () {
    return view('Entrenador.Sistema_de_Luces.lista_de_sistema_de_luces');
});
Route::get('/sistema_de_luces', function () {
    return view('Entrenador.Sistema_de_Luces.sistema_de_luces');
});




