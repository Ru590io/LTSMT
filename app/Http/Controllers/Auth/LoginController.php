<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    // Maximum number of attempts to allow
    protected $maxAttempts = 5; // Default is 5

    // Number of minutes to lock the user out for
    protected $decayMinutes = 5; // Default is 1
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectPath()
    {
    return redirect()->route('home')->with('Exito', 'Inicio de sesion hecha.');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
