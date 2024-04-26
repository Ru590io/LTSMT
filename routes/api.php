<?php

use App\Models\Amfondo;
use App\Models\Pmfondo;
use App\Models\AccessCode;
use App\Models\Amdescanso;
use App\Models\Pmdescanso;
use Illuminate\Http\Request;
use App\Models\Pmrepeticiones;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmController;
use App\Http\Controllers\PmController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FondoController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\AmfondoController;
use App\Http\Controllers\PmfondoController;
use App\Http\Controllers\DescansoController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AccessCodeController;
use App\Http\Controllers\AmdescansoController;
use App\Http\Controllers\PmdescansoController;
use App\Http\Controllers\RepeticionController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\CompetitorsController;
use App\Http\Controllers\LighttrainingController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\WeeklysheduleController;
use App\Http\Controllers\AmrepeticionesController;
use App\Http\Controllers\PmrepeticionesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//AM//
/*Route::get('add-am', [AmController::class, 'see']);

Route::post('add-am', [AmController::class, 'added']);

Route::get('add-am/{id}', [AmController::class, 'specificam']);

Route::put('am/{id}', [AmController::class, 'amupdate']);

Route::delete('ams/{id}', [AmController::class, 'amerase']);

//LightTraining//
Route::get('light', [LighttrainingController::class, 'seetraining']);

Route::post('light', [LighttrainingController::class, 'lighttrainingadded']);

Route::get('light/{id}', [LighttrainingController::class, 'specificlighttraining']);

Route::put('updatinglight/{id}', [LighttrainingController::class, 'updatelighttraining']);

Route::delete('deletelight/{id}', [LighttrainingController::class, 'erase']);*/

//Users//
//Route::apiResource('users', UserController::class);
Route::post('coachuser', [UserController::class, 'storecoachapi'])->middleware('guest');
Route::post('athleteuser', [UserController::class, 'athletestore'])->middleware('guest');
//Route::post('/users/{id}/restore', [UserController::class, 'restore']);

//Route::post('/generate_code', [AccessCodeController::class, 'generateAccessCodeAPI']);

//Auth//
Route::post('password/email', [PasswordResetController::class, 'apisendResetLinkEmail']);
Route::post('password/reset', [PasswordResetController::class, 'apireset']);

Route::post('/login', [AuthController::class, 'apiLogin'])->middleware('guest');


Route::middleware('auth:sanctum', 'role:Entrenador')->group(function () {

//AM//
Route::apiResource('users', UserController::class);

Route::get('add-am', [AmController::class, 'see']);

Route::post('add-am', [AmController::class, 'added']);

Route::get('add-am/{id}', [AmController::class, 'specificam']);

Route::put('am/{id}', [AmController::class, 'amupdate']);

Route::delete('ams/{id}', [AmController::class, 'amerase']);

//LightTraining//
Route::get('light', [LighttrainingController::class, 'seetraining']);

Route::post('light', [LighttrainingController::class, 'lighttrainingadded']);

Route::get('light/{id}', [LighttrainingController::class, 'specificlighttraining']);

Route::put('updatinglight/{id}', [LighttrainingController::class, 'updatelighttraining']);

Route::delete('deletelight/{id}', [LighttrainingController::class, 'erase']);

//Auth//
Route::post('/coachlogout', [AuthController::class, 'apilogout']);

//Access Code//
Route::post('/generate_code', [AccessCodeController::class, 'generateAccessCodeAPI']);

//Restore//
Route::post('/users/{id}/restore', [UserController::class, 'restore']);

//PM//
Route::apiResource('pm', PmController::class);

//Descanso//
Route::apiResource('descanso', DescansoController::class);

//Fondo//
Route::apiResource('fondo', FondoController::class);

//Repeticiones//
Route::apiResource('repeticiones', RepeticionController::class);

//Amdescanso//
Route::apiResource('amdescanso', AmdescansoController::class);

//Pmdescanso//
Route::apiResource('pmdescanso', PmdescansoController::class);

//Amfondo//
Route::apiResource('amfondo', AmfondoController::class);

//Pmfondo//
Route::apiResource('pmfondo', PmfondoController::class);

//Amrepeticiones//
Route::apiResource('amrepeticiones', AmrepeticionesController::class);

//Pmrepeticiones//
Route::apiResource('pmrepeticiones', PmrepeticionesController::class);

//Days//
Route::apiResource('day', DaysController::class);

//Weeklyshedule//
Route::apiResource('weeklyshedule', WeeklysheduleController::class);

//Competition//
Route::apiResource('competition', CompetitionController::class);

//Competitors//
Route::apiResource('competitors', CompetitorsController::class);

//Sessions//
Route::apiResource('sessions', SessionsController::class);

//Event//
Route::apiResource('events', EventsController::class);

});

Route::middleware('auth:api', 'role:Atleta')->group(function () {
    Route::post('/athletelogout', [AuthController::class, 'apilogout']);
    Route::apiResource('users', UserController::class);
});
/*
//PM//
Route::apiResource('pm', PmController::class);

//Descanso//
Route::apiResource('descanso', DescansoController::class);

//Fondo//
Route::apiResource('fondo', FondoController::class);

//Repeticiones//
Route::apiResource('repeticiones', RepeticionController::class);

//Amdescanso//
Route::apiResource('amdescanso', AmdescansoController::class);

//Pmdescanso//
Route::apiResource('pmdescanso', PmdescansoController::class);

//Amfondo//
Route::apiResource('amfondo', AmfondoController::class);

//Pmfondo//
Route::apiResource('pmfondo', PmfondoController::class);

//Amrepeticiones//
Route::apiResource('amrepeticiones', AmrepeticionesController::class);

//Pmrepeticiones//
Route::apiResource('pmrepeticiones', PmrepeticionesController::class);

//Days//
Route::apiResource('day', DaysController::class);

//Weeklyshedule//
Route::apiResource('weeklyshedule', WeeklysheduleController::class);

//Competition//
Route::apiResource('competition', CompetitionController::class);

//Competitors//
Route::apiResource('competitors', CompetitorsController::class);

//Sessions//
Route::apiResource('sessions', SessionsController::class);

//Event//
Route::apiResource('events', EventsController::class);*/



