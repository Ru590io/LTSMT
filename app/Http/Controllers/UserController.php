<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AccessCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    //Registro//
    public function create()
    {
        return view('auth.Register.registro');
    }

    public function creates()
    {
        return view('auth.Register.entrenadorregistro');
    }

    //Ver todos usarios//
    public function indexs()
    {
        $users = User::all();
        return view('auth.Register.registro', compact('users'));
    }

    // Crear el usuario y registrarlo
    public function stores(Request $request)
    {
        $message = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'first_name.regex' => 'El Nombre no puede tener numeros',
            'last_name.regex' => 'El Apellido no puede tener numeros',
        ];
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'last_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'email' => 'required|string|email|max:50|unique:users,email|ends_with:@upr.edu',
            'phone_number' => 'required|string|digits:10|numeric|unique:users,phone_number',
            'password' => 'required|string|min:6|max:12|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'code' => 'required',
        ], $message);

        $code = AccessCode::where('code', $request->access_code)->where('expires_at', '>', Carbon::now())->first();

        if (!$code) {
        return back()->withErrors(['access_code' => 'Invalid or expired access code.'])->withInput();
        }

        $validatedData['role'] = 'Atleta'; // Example function to determine role
        //$validatedData['is_active'] = true; // Always true as specified
        $validatedData['remember_token'] = Str::random(10); // Random remember token, length adjusted to 10 for better security
        $validatedData['password'] = bcrypt($validatedData['password']); // Encrypt the password
        $validatedData['phone_number'] = bcrypt($validatedData['phone_number']);


        $user = User::create($validatedData);

        // Optionally invalidate the access code
        $code->delete(); // or mark as used to prevent reuse

        auth()->login($user);

        return redirect()->route('login')->with('Exito', 'Usuario Agregado.');
    }

    public function coachstores(Request $request)
    {
        $message = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'first_name.regex' => 'El Nombre no puede tener numeros',
            'last_name.regex' => 'El Apellido no puede tener numeros',
        ];
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'last_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'email' => 'required|string|email|max:50|unique:users,email|ends_with:@upr.edu',
            'phone_number' => 'required|string|digits:10|numeric|unique:users,phone_number',
            'password' => 'required|string|min:6|max:12|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',

        ], $message);

        $validatedData['role'] = 'Entrenador'; // Example function to determine role
        //$validatedData['is_active'] = true; // Always true as specified
        $validatedData['remember_token'] = Str::random(10); // Random remember token, length adjusted to 10 for better security
        $validatedData['password'] = bcrypt($validatedData['password']); // Encrypt the password
        $validatedData['phone_number'] = bcrypt($validatedData['phone_number']);


        User::create($validatedData);


        return redirect()->route('login')->with('Exito', 'Usuario Agregado.');
    }

   /* private function determineRole($request)
    {
    // Example condition to determine the role
    return $request->has('special_condition') ? 'Coach' : 'Athlete';
    }*/

    // Display the specified user.
    public function shows(User $user)
    {
        return view('users.shows', compact('user'));
    }

    // Show the form for editing the specified user.
    public function edits(User $user)
    {
        return view('users.edits', compact('user'));
    }

    // Update the specified user in storage.
    public function updates(Request $request, User $user)
    {
        $messages = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'first_name.regex' => 'El Nombre no puede tener numeros',
            'last_name.regex' => 'El Apellido no puede tener numeros',
        ];
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'last_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'email' => 'required|string|email|max:20|ends_with:@upr.edu,'.$user->id,
            'phone_number' => 'required|string|digits:10|numeric|unique:users,phone_number,'.$user->id,
            'password' => 'required|string|min:6|max:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ], $messages);

        $user->update($validatedData);

        if (!empty($validatedData['password'])) {
            $user->upassword = bcrypt($validatedData['password']);
            $user->save();
         }

         if (!empty($validatedData['phone_number'])) {
            $user->upassword = bcrypt($validatedData['phone_number']);
            $user->save();
         }

        return redirect('/users')->with('Exito', 'Usario Actualizado.');
    }

    // Remove the specified user from storage.
    public function destroys(User $user)
    {
        $user->delete();
        return redirect('/users')->with('Exito', 'Usario Borrado.');
    }

    public function restoreUser($userId)
    {
        $user = User::withTrashed()->where('id', $userId)->first();

        if ($user) {
            $user->restore();
            return redirect()->back()->with('success', 'User has been restored successfully.');
    }   else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    //API///////////////////////////////////////////////////////////////////////////////////////////////////
     // GET /users
     public function index()
     {
         return User::all();
     }

     // POST /users
     public function store(Request $request)
     {

        $messages = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'first_name.regex' => 'El Nombre no puede tener numeros',
            'last_name.regex' => 'El Apellido no puede tener numeros',
        ];

        $validator = Validator::make($request->all(), [
            //'role' => 'required|string|in:Atleta,Entrenador',
            'first_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'last_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'email' => 'required|string|email|unique:users,email|ends_with:@upr.edu',
            'phone_number' => 'required|string|digits:10|numeric|unique:users,phone_number',
            'password' => 'required|string|min:6|max:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            //'is_active' => 'required|boolean',
        ], $messages);

        $validatedData['role'] = 'Entrenador'; // Example function to determine role
        //$validatedData['is_active'] = true; // Always true as specified

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array
    $user = new User([
        //'role' => $validated['role'],
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
        'phone_number' => bcrypt($validated['phone_number']),
        'password' => bcrypt($validated['password']),
        //'is_active' => $validated['is_active'],
    ]);

    $user->remember_token = Str::random(10);
    $user->save();

         return response()->json("Added", 201);
     }

     // GET /users/{id}
     public function show($id)
     {
         $user = User::find($id);
         if (!$user) {
             return response()->json(['message' => 'User not found'], 404);
         }

         return response()->json($user);
     }

     // PUT /users/{id}
     public function update(Request $request, $id)
     {
         $user = User::find($id);
         if (!$user) {
             return response()->json(['message' => 'User not found'], 404);
         }

         $messages = [
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'first_name.regex' => 'El Nombre no puede tener numeros',
            'last_name.regex' => 'El Apellido no puede tener numeros',
        ];

         $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'last_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'email' => 'required|string|email|max:20|ends_with:@upr.edu,'.$user->id,
            'phone_number' => 'required|string|digits:10|numeric|unique:users,phone_number,'.$user->id,
            'password' => 'required|string|min:6|max:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            //'is_active' => 'required|boolean',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $user->update([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
        'phone_number' => $validated['phone_number'],
        //'is_active' => $validated['is_active'],
    ]);

         //$user->update($validated);
         if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
            $user->save();
         }
         if (!empty($validated['phone_number'])) {
            $user->password = bcrypt($validated['phone_number']);
            $user->save();
         }
         return response()->json(['message' => 'User updated successfully', 'data' => $user]);
     }

     // DELETE /users/{id}
     public function destroy($id)
     {
         $user = User::find($id);
         if (!$user) {
             return response()->json(['message' => 'User not found'], 404);
         }

         $user->delete();

         return response()->json(['message' => 'User deleted successfully']);
     }

     public function restore($id)
    {
    $user = User::onlyTrashed()->find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found or not deleted.'], 404);
    }

    $user->restore();
    return response()->json(['message' => 'User restored successfully.'], 200);
    }
}
