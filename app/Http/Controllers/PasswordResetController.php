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
        $request->validate(['email' => 'required|string|email|max:60|ends_with:@upr.edu',]);

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
            'email' => 'required|email|string|max:60|ends_with:@upr.edu',
            'password' => 'required|string|min:8|max:16|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
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

    public function editpassword(User $user){
        $this->authorize('view', $user);
        $user = auth()->user();
        return view('auth.Register.reestablecer_contraseña', compact('user'));
    }

    public function atletaeditpassword(User $user){
        $this->authorize('view', $user);
        $user = auth()->user();
        return view('auth.Register.reestablecer_contraseña_atleta', compact('user'));
    }

    public function entrenadorreset(Request $request, User $user)
    {
        $user = auth()->user();  // Get the authenticated user
        $message = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
        ];

        $request->validate([
            'password' => 'required|string|min:8|max:16|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            //'password.not_same' => 'La nueva contraseña debe ser diferente de la contraseña anterior.',
        ], $message);

        $user->forceFill([
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ])->save();

            event(new PasswordReset($user));

            if (auth()->user()->role === 'Entrenador') {
                return redirect()->route('coach.index', ['user' => $user->id])->with('status', 'contranseña actualizada.');
            } elseif (auth()->user()->role === 'Atleta') {
                return redirect()->route('atleta.index', ['user' => $user->id])->with('status', 'contranseña actualizada.');
            }
           // return redirect()->route('coach.index')->with('status', 'contranseña actualizada.');
    }
    //API////////////////////////////////////////////////////////////////////////////
    // Send the password reset link
    public function apisendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|string|email|max:60|ends_with:@upr.edu']);

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
            'email' => 'required|email|string|max:60|ends_with:@upr.edu',
            'password' => 'required|string|min:8|max:16|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
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
