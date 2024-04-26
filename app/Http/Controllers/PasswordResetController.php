<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    // Show form to request a password reset link
    public function showResetRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Send the password reset link
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|string|email|max:50|ends_with:@upr.edu',]);

        // Send the password reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    // Show form to reset the password
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    // Reset the password
    public function reset(Request $request)
    {
        $message = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
        ];

        $request->validate([
            'token' => 'required',
            'email' => 'required|email|string|max:50|ends_with:@upr.edu',
            'password' => 'required|string|min:6|max:12|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'password.not_same' => 'La nueva contraseña debe ser diferente de la contraseña anterior.',
        ], $message);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {

                if (Hash::check($password, $user->password)) {
                    throw ValidationException::withMessages(['password' => 'La nueva contraseña debe ser diferente de la contraseña anterior.']);
                }

                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
    //API////////////////////////////////////////////////////////////////////////////
    // Send the password reset link
    public function apisendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|string|email|max:50|ends_with:@upr.edu']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['status' => __($status)], 200)
            : response()->json(['error' => __($status)], 400);
    }

    // Reset the password
    public function apireset(Request $request)
    {
        $message = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'password.not_same' => 'La nueva contraseña debe ser diferente de la contraseña anterior.',
        ];

        $request->validate([
            'token' => 'required',
            'email' => 'required|email|string|max:50|ends_with:@upr.edu',
            'password' => 'required|string|min:6|max:12|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ], $message);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {

                if (Hash::check($password, $user->password)) {
                    throw ValidationException::withMessages(['password' => 'La nueva contraseña debe ser diferente de la contraseña anterior.']);
                }

                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Reinicio de Contraseña exitoso'], 200)
            : response()->json(['errors' => ['email' => [__($status)]]], 400);
    }
}
