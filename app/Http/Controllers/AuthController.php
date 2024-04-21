<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    public function viewlogin()
    {
        return view('auth.Register.inicio_de_sesion');
    }

    public function homepage(){
        return view('home');
    }

    public function login(Request $request){


        // Define a unique key based on the user's IP address and the attempted email
    $throttleKey = strtolower($request->input('email')).'|'.$request->ip();

    // Check if the user has been locked out of attempting to log in
    if (RateLimiter::tooManyAttempts($throttleKey, 4)) {
        $seconds = RateLimiter::availableIn($throttleKey);
        return redirect()->route('login')->withErrors([
            'email' => "Demasiados intentos de inicio de sesión. Por favor intente de nuevo en $seconds segundos."
        ]);
    }

    // Validate the incoming request data
    $validatedData = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    // Attempt to authenticate the user with the given credentials
    if (auth()->attempt($validatedData)) {
        // Clear the login attempts for this user
        RateLimiter::clear($throttleKey);

        // Regenerate the session to protect against session fixation
        $request->session()->regenerate();

        // Redirect the user to the intended page with success message
        return redirect()->intended('home')->with('Exito', 'Inicio de sesión exitoso.');
    }

    // If the login attempt was unsuccessful, increment the number of attempts to log in
    RateLimiter::hit($throttleKey, 314); // 300 seconds until reset

    // Redirect back to the login form with an error message
    return back()->withErrors([
        'email' => 'Correo y contraseña inválidos.'
    ])->withInput($request->only('email'));

       /* $validatedData = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($validatedData)){
            request()->session()->regenerate();
            return redirect()->route('home')->with('Exito', 'Inicio de sesion hecha.');
        }
        return redirect()->route('login')->withErrors([
            'email' => "Invalido Correo o Contraseña"
        ]);*/
    }
     //Terminar sesion
    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('Exito', 'Final de sesion hecha.');
    }

    public function apiLogin(Request $request)
{
    // Throttle key based on IP and email to prevent brute force attacks
    $throttleKey = strtolower($request->input('email')).'|'.$request->ip();

    // Maximum of 5 attempts allowed every 1 minute
    if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
        $seconds = RateLimiter::availableIn($throttleKey);
        return response()->json([
            'message' => "Too many login attempts. Please try again in $seconds seconds."
        ], 429); // 429 Too Many Requests
    }

    // Validate the request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Attempt to log the user in
    if (Auth::attempt($request->only('email', 'password'))) {
        RateLimiter::clear($throttleKey);

        // Regenerate session to avoid session fixation
        $request->session()->regenerate();

        return response()->json([
            'message' => 'Login successful.',
            'user' => Auth::user()
        ], 200);
    }

    // Increment the number of failed attempts to log in
    RateLimiter::hit($throttleKey, 60);

    // Return error if credentials are incorrect
    throw ValidationException::withMessages([
        'email' => ['The provided credentials are incorrect.'],
    ]);
}
}
