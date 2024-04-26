<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectPath()
    {
    return redirect()->route('login')->with('Exito', 'Inicio de sesion hecha.');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $message = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'first_name.regex' => 'El Nombre no puede tener numeros',
            'last_name.regex' => 'El Apellido no puede tener numeros',
        ];
        return Validator::make($data, [
            'first_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'last_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'email' => 'required|string|email|max:50|unique:users,email|ends_with:@upr.edu',
            'phone_number' => 'required|string|digits:10|numeric|unique:users,phone_number',
            'password' => 'required|string|min:6|max:12|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ], $message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),  // Correctly using Hash::make for password encryption
            'phone_number' => bcrypt($data['phone_number']),
            'role' => 'Athlete',  // Default role
            'remember_token' => Str::random(10)  // Generating remember token
        ]);
        return redirect()->route('login')->with('Exito', 'Usuario Agregado.');
    }
}
