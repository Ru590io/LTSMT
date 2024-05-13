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
    return redirect('/login')->middleware('https');
});

Route::get('/', function () {
    return redirect('/login');
})->middleware('guest');

Auth::routes();

/**
 * @author Rubén Marrero
 * Rutas de Entrenador
 */
Route::middleware(['auth', 'role:Entrenador', 'https'])->group(function () {

    //Informacion de Entrenador
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/entrenadorinfo/{user}', [UserController::class, 'entrenadorindexs'])->name('coach.index');
    Route::get('/entrenadorinfo/coach/{user}/edit', [UserController::class, 'entrenadoredits'])->name('entrenador.edit');
    Route::put('/entrenadorinfo/coach/{user}/update', [UserController::class, 'coachupdates'])->name('entrenador.update');
    Route::get('/entrenadorinfo/coach/password', [PasswordResetController::class, 'editpassword'])->name('password.edit');
    Route::post('/entrenadorinfo/coach/password', [PasswordResetController::class, 'entrenadorreset'])->name('password.updates');

    //Home de Entrenador
    Route::get('/home', [UserController::class, 'homepage'])->name('home');

    //Compartir pagina
    Route::get('/lista', [UserController::class, 'athleteindexs'])->name('users.index');
    Route::get('lista/{user}', [UserController::class, 'showathlete'])->name('user.lista');
    //Codigo de Acceso
    Route::get('/generate_code', [AccessCodeController::class, 'shareweb'])->name('generate_code');
    Route::post('/generate_code', [AccessCodeController::class, 'generateAccessCode'])->name('generate_code');
    //Restaurar Atletas
    Route::get('/lista/restore/delete', [UserController::class, 'showdeleted'])->name('users.deleted');
    Route::put('/lista/restore/{user}/restore', [UserController::class, 'restoreUser'])->name('users.restore');

    //Sistema de Luces
    Route::get('/light', [LighttrainingController::class, 'create'])->name('light.index');
    Route::get('/light/add', [LighttrainingController::class, 'index'])->name('light.add');
    Route::post('/light/add', [LighttrainingController::class, 'store'])->name('light.add');
    Route::get('/light/list', [LighttrainingController::class, 'lighttraininglist'])->name('light.list');
    Route::delete('/light/list/{lighttraining}/destroy', [LighttrainingController::class, 'destroy'])->name('light.delete');
    Route::get('/light/list/{lighttraining}',[LighttrainingController::class, 'show'])->name('light.show');
    //Route::get('/training-data', [LighttrainingController::class, 'sendlighttrainingdata']);

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
    Route::delete('/athlete/athletetraininglist/{user}/weekdetails/delete', [UserController::class, 'deleteWeeklyScheduleOnAthleteMenu'])->name('athletemenuweekly.delete');

    /**
     * @author Rubén Marrero
     * Eventos
     */
    //Eventos
    Route::get('/competition/list/asignar/atleta/done/{id}', [EventsController::class, 'compshows'])->name('competitors.listing');
    Route::post('/competition/list/asignar/atleta/done/{id}', [EventsController::class, 'storeEvents'])->name('event.add');
    Route::delete('/competition/list/asignar/atleta/done/{event}/destroy', [EventsController::class, 'destroys'])->name('event.delete');
    Route::delete('/competition/list/asignar/atleta/done/comp/{competitor}/destroy', [EventsController::class, 'atheltedestroy'])->name('competitor.delete');

    /**
     * @author Rubén Marrero
     * Split Tables
     */
    //Split_Tables
    Route::get('/competition/list/asignar/atleta/{id}/tabla', [EventsController::class, 'splittableatleta'])->name('table.atleta');
    Route::get('/competition/list/tabla/general/{id}/atletas', [EventsController::class, 'splittablegeneral'])->name('table.general');

    /**
     * @author Rubén Marrero
     * Horario Semanal
     */
    //Weekly schedule
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
    Route::delete('/schedule/add/show/week/athletes/view/{id}/destroy', [WeeklysheduleController::class, 'deleteWeeklySchedule'])->name('weekly.delete');
});

/**
 * @author Rubén Marrero
 * Rutas de Atletas
 */
Route::middleware(['auth', 'role:Atleta', 'https'])->group(function () {
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

/**
 * @author Rubén Marrero
 * Registro de Atletas
  **/
Route::get('/register', [UserController::class, 'create'])->name('register')->middleware('guest');

Route::post('/register', [UserController::class, 'stores'])->name('register')->middleware('guest');

/**
 * @author Rubén Marrero
 * Registro de Entrenador
 *
 */
Route::get('/registers', [UserController::class, 'creates'])->name('registers')->middleware('guest', 'https');

Route::post('/registers', [UserController::class, 'coachstores'])->name('registers')->middleware('guest', 'https');

/**
 * @author Rubén Marrero
 * Inicio de Sesion
 */

Route::get('/login', [AuthController::class, 'viewlogin'])->name('login')->middleware('guest', 'https');

Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest', 'https');

/**
 * @author Rubén Marrero
 * Reiniciar Contraseña
 */
Route::get('password/reset', [PasswordResetController::class, 'showResetRequestForm'])->name('password.request');

Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');

Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

/**
 * @author Rubén Marrero
 * Envia si la ruta no existe en la applicacion
 */

Route::fallback(function(){
        return view('welcome');
});




