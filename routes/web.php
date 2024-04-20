<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Auth::routes();

// For Coach specific pages
/*Route::middleware(['auth', 'role:Entrenador'])->group(function () {
    Route::get('/coach/dashboard', [CoachController::class, 'index'])->name('coach.dashboard');
});

// For Athlete specific pages
Route::middleware(['auth', 'role:Atleta'])->group(function () {
    Route::get('/athlete/dashboard', [AthleteController::class, 'index'])->name('athlete.dashboard');
});*/

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [AuthController::class, 'homepage'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/users/{userId}/restore', [UserController::class, 'restoreUser'])->name('users.restore');
});

Route::get('/register', [UserController::class, 'create'])->name('register')->middleware('guest');

Route::post('/register', [UserController::class, 'stores'])->name('register')->middleware('guest');

Route::get('/login', [AuthController::class, 'viewlogin'])->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

Route::get('password/reset', [PasswordResetController::class, 'showResetRequestForm'])->name('password.request');

Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');

Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

Route::fallback(function(){
        return view('welcom');
});



