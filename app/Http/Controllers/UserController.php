<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AccessCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\UniquePhoneNumber;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Rules\UpdateUniquePhoneNumber;
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
            'first_name.regex' => 'El Nombre no puede tener numeros, caracteres especiales y debe tener Mayuscula',
            'last_name.regex' => 'El Apellido no puede tener numeros, caracteres especiales y debe tener Mayuscula',
        ];
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:25|regex:/^[\pL\s]*$/u',
            'last_name' => 'required|string|max:25|regex:/^[\pL\s]*$/u',
            'email' => 'required|string|email|max:35|unique:users,email|ends_with:@upr.edu',
            'phone_number' => 'required|string|digits:10|numeric|unique:users,phone_number',
            'password' => 'required|string|min:6|max:16|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'code' => 'required|string',
        ], $message);

        $code = AccessCode::where('code', $request->code)->where('expires_at', '>', Carbon::now())->first();

        if (!$code) {
            return redirect()->route('register')->withErrors([
                'code' => "Codigo de Acceso invalido o expirado"
            ]);
        }

        $validatedData['role'] = 'Atleta'; // Example function to determine role
        $validatedData['remember_token'] = Str::random(60); // Random remember token, length adjusted to 10 for better security
        $validatedData['password'] = bcrypt($validatedData['password']); // Encrypt the password
        $validatedData['phone_number'] = Crypt::encryptString($validatedData['phone_number']);


        User::create($validatedData);

        // Optionally invalidate the access code
        $code->delete(); // or mark as used to prevent reuse

        //auth()->login($user);

        return redirect()->route('login')->with('Exito', 'Atleta Agregado.');
    }

    public function coachstores(Request $request)
    {
        $message = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'first_name.regex' => 'El Nombre no puede tener numeros, caracteres especiales y debe tener Mayuscula',
            'last_name.regex' => 'El Apellido no puede tener numeros, caracteres especiales y debe tener Mayuscula',
        ];
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:25|regex:/^[\pL\s]*$/u|regex:/^[A-Z]/',
            'last_name' => 'required|string|max:25|regex:/^[\pL\s]*$/u|regex:/^[A-Z]/',
            'email' => 'required|string|email|max:50|unique:users,email|ends_with:@upr.edu',
            'phone_number' => 'required|string|digits:10|numeric|unique:users,phone_number',
            'password' => 'required|string|min:6|max:16|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',

        ], $message);


        $validatedData['role'] = 'Entrenador'; // Example function to determine role
        $validatedData['remember_token'] = Str::random(60); // Random remember token, length adjusted to 10 for better security
        $validatedData['password'] = bcrypt($validatedData['password']); // Encrypt the password
        $validatedData['phone_number'] = Crypt::encryptString($validatedData['phone_number']);


        User::create($validatedData);


        return redirect()->route('login')->with('Exito', 'Entrenador Agregado.');
    }

    // Display the specified user.
    public function shows(User $user, $id)
    {
        $item = User::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay ningun Atleta aqui.');
        }
        $this->authorize('view', $user);
        return view('users.shows', compact('user'));
    }

    // Show the form for editing the specified user.
    public function edits(User $user, $id)
    {
        $item = User::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para editar.');
        }

        $this->authorize('update', $user);
        return view('users.edits', compact('user'));
    }

    // Update the specified user in storage.
    public function updates(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $messages = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'first_name.regex' => 'El Nombre no puede tener numeros, caracteres especiales y debe tener Mayuscula',
            'last_name.regex' => 'El Apellido no puede tener numeros, caracteres especiales y debe tener Mayuscula',
        ];
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:25|regex:/^[\pL\s]*$/u|regex:/^[A-Z]/',
            'last_name' => 'required|string|max:25|regex:/^[\pL\s]*$/u|regex:/^[A-Z]/',
            'email' => 'required|string|email|max:20|ends_with:@upr.edu,'.$user->id,
            'phone_number' => 'required|string|digits:10|numeric|unique:users,phone_number,'.$user->id,
            'password' => 'required|string|min:6|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ], $messages);

        $user->update($validatedData);

        if (!empty($validatedData['password'])) {
            $user->upassword = bcrypt($validatedData['password']);
            $user->save();
         }

         if (!empty($validatedData['phone_number'])) {
            $user->upassword = Crypt::encryptString($validatedData['phone_number']);
            $user->save();
         }

        return redirect('/users')->with('Exito', 'Informacion Actualizada.');
    }

    // Remove the specified user from storage.
    public function destroys(User $user)
    {
        $user->delete();
        return redirect('/users')->with('Exito', 'Atleta Eliminado.');
    }

    public function restoreUser($userId)
    {
        $user = User::withTrashed()->where('id', $userId)->first();

        if ($user) {
            $user->restore();
            return redirect()->back()->with('success', 'Atleta Restaurado.');
    }   else {
            return redirect()->back()->with('error', 'Atleta no se encontro.');
        }
    }

    //API///////////////////////////////////////////////////////////////////////////////////////////////////
     // GET /users
     public function index()
    {
    // Order users alphabetically by their first name
    //return User::orderBy('first_name', 'asc')->get();
    return User::all();
    }

     // POST /users
     public function athletestore(Request $request)
     {

        $messages = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'first_name.regex' => 'El Nombre no puede tener numeros, caracteres especiales y debe tener Mayuscula',
            'last_name.regex' => 'El Apellido no puede tener numeros, caracteres especiales y debe tener Mayuscula',
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:25|regex:/^[\pL\s]*$/u|regex:/^[A-Z]/',
            'last_name' => 'required|string|max:25|regex:/^[\pL\s]*$/u|regex:/^[A-Z]/',
            'email' => 'required|string|email|max:35|unique:users,email|ends_with:@upr.edu',
            'phone_number' => ['required', 'string', 'digits:10', 'numeric', new UniquePhoneNumber()],
            'password' => 'required|string|min:6|max:16|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'code' => 'required|string',
        ], $messages);

        $code = AccessCode::where('code', $request->code)->where('expires_at', '>', Carbon::now())->first();

        if (!$code) {
        return response()->json(['access_code' => 'Codigo de Acceso invalido o expirado.'], 422);
        }


        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array
        $encryptedPhoneNumber = Crypt::encryptString($validated['phone_number']);
    $user = new User([

        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
        'phone_number' => $encryptedPhoneNumber,
        'password' => bcrypt($validated['password']),
    ]);
        $user->role = 'Atleta';
        $user->remember_token = Str::random(60);
        $user->save();

        $code->delete();

         //return response()->json("Added", 201);
         return response()->json([
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
     }
     public function storecoachapi(Request $request)
     {

        $messages = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'first_name.regex' => 'El Nombre no puede tener numeros, caracteres especiales y debe tener Mayuscula',
            'last_name.regex' => 'El Apellido no puede tener numeros, caracteres especiales y debe tener Mayuscula',
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:25|regex:/^[\pL\s]*$/u|regex:/^[A-Z]/',
            'last_name' => 'required|string|max:25|regex:/^[\pL\s]*$/u|regex:/^[A-Z]/',
            'email' => 'required|string|email|max:35|unique:users,email|ends_with:@upr.edu',
            'phone_number' => ['required', 'string', 'digits:10', 'numeric', new UniquePhoneNumber()],
            'password' => 'required|string|min:6|max:16|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array
        $encryptedPhoneNumber = Crypt::encryptString($validated['phone_number']);
    $user = new User([

        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
        'phone_number' => $encryptedPhoneNumber,
        'password' => bcrypt($validated['password']),
    ]);
        $user->role = 'Entrenador';
        $user->remember_token = Str::random(60);
        $user->save();

         //return response()->json("Added", 201);
         return response()->json([
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
     }

     // GET /users/{id}
     public function show($id)
     {
         $user = User::find($id);
         if (!$user) {
             return response()->json(['message' => 'Usuario no se encontro'], 404);
         }

         return response()->json($user);
     }


     // PUT /users/{id}
     /*public function update(Request $request, $id)
     {
         $user = User::find($id);
         if (!$user) {
             return response()->json(['message' => 'User not found'], 404);
         }

         $messages = [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'first_name.regex' => 'El Nombre no puede tener numeros',
            'last_name.regex' => 'El Apellido no puede tener numeros',
        ];

         $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|string|max:35|regex:/^[\pL\s]*$/u',
            'last_name' => 'sometimes|string|max:35|regex:/^[\pL\s]*$/u',
            'email' => 'sometimes|string|email|max:20|ends_with:@upr.edu,'.$user->id,
            //'phone_number' => 'required|string|digits:10|numeric|unique:users,phone_number,'.$user->id,
            'phone_number' => ['sometimes', 'string', 'digits:10', 'numeric', new UpdateUniquePhoneNumber($user->id)],
            'password' => 'sometimes|string|min:6|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',

        ], $messages);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $user->update([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'email' => $validated['email'],
    ]);

         //$user->update($validated);
         if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
            $user->save();
         }
         if (!empty($validated['phone_number'])) {
            $user->phone_number = Crypt::encryptString($validated['phone_number']);
            $user->save();
        }
         return response()->json(['message' => 'User updated successfully', 'data' => $user]);
     }*/

     public function update(Request $request, $id)
    {

    $user = User::find($id);
    $this->authorize('update', $user);
    if (!$user) {
        return response()->json(['message' => 'Usario no se encontro'], 404);
    }

    $rules = [
        'first_name' => 'string|max:35|regex:/^[\pL\s]*$/u|regex:/^[A-Z]/',
        'last_name' => 'string|max:35|regex:/^[\pL\s]*$/u|regex:/^[A-Z]/',
        'email' => 'string|email|max:20|ends_with:@upr.edu|unique:users,email,' . $user->id,
        'phone_number' => ['string', 'digits:10', 'numeric', new UpdateUniquePhoneNumber($user->id)],
        'password' => 'string|min:6|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
    ];

    $messages = [
        'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
        'first_name.regex' => 'El Nombre no puede tener numeros, caracteres especiales y debe tener Mayuscula',
        'last_name.regex' => 'El Apellido no puede tener numeros, caracteres especiales y debe tener Mayuscula',
    ];

    // Apply validation only to the fields that are actually filled in the request
    $validator = Validator::make($request->only(array_keys($rules)), array_intersect_key($rules, $request->all()), $messages);

    if ($validator->fails()) {
        return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
    }

    $validated = $validator->validated();

    // Update only fields that are filled and different
    foreach ($validated as $key => $value) {
        if ($key == 'password' && $request->filled($key) && $user->$key != bcrypt($value)) {
            $user->$key = bcrypt($value);
        } else if ($key == 'phone_number' && $request->filled($key)) {
            // Decrypt current phone number and compare with the new one before updating
            $currentPhoneNumber = Crypt::decryptString($user->phone_number);
            if ($currentPhoneNumber !== $value) {
                $user->phone_number = Crypt::encryptString($value);
            }
        } else if ($request->filled($key) && $user->$key != $value) {
            $user->$key = $value;
        }
    }


    $user->save();

    return response()->json(['message' => 'Usuario Actualizado', 'data' => $user]);
    }

     // DELETE /users/{id}
     public function destroy($id)
     {
         $user = User::find($id);
         if (!$user) {
             return response()->json(['message' => 'Atleta no se encontro'], 404);
         }

         $user->delete();

         return response()->json(['message' => 'Atleta eliminado']);
     }

     public function restore($id)
    {
    $user = User::onlyTrashed()->find($id);

    if (!$user) {
        return response()->json(['message' => 'Atleta no se encontro o no esta eliminado.'], 404);
    }

    $user->restore();
    return response()->json(['message' => 'Atleta restaurado.'], 200);
    }
}
