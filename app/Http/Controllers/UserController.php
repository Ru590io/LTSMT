<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function indexs()
    {
        $users = User::all();
        return view('auth.Register.registro', compact('users'));
    }

    public function create()
    {
        return view('auth.Register.registro');
    }

    // Store a newly created user in storage.
    public function stores(Request $request)
    {
        $message = [
            'upassword.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'ufirst_name.regex' => 'El nombre no puede tener numeros',
            'ulast_name.regex' => 'El segundo nombre no puede tener numeros',
        ];
        $validatedData = $request->validate([
            'ufirst_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'ulast_name' => 'required|string|max:35|regex:/^[\pL\s]*$/u',
            'uemail' => 'required|string|email|max:50|unique:users,uemail|ends_with:@upr.edu',
            'uphone_number' => 'required|string|digits:10|numeric|unique:users,uphone_number',
            'upassword' => 'required|string|min:6|max:12|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ], $message);

        $validatedData['urole'] = 'Atleta'; // Example function to determine role
        $validatedData['uis_active'] = true; // Always true as specified
        $validatedData['remember_token'] = Str::random(10); // Random remember token, length adjusted to 10 for better security
        $validatedData['upassword'] = bcrypt($validatedData['upassword']); // Encrypt the password
        $validatedData['uphone_number'] = bcrypt($validatedData['uphone_number']);


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
            'upassword.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
        ];
        $validatedData = $request->validate([
            'ufirst_name' => 'required|string|max:25|alpha',
            'ulast_name' => 'required|string|max:25|alpha',
            'uemail' => 'required|string|email|max:20|ends_with:@upr.edu,'.$user->id,
            'uphone_number' => 'required|string|digits:10|numeric|unique:users,uphone_number,'.$user->id,
            'upassword' => 'required|string|min:6|max:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ], $messages);

        $user->update($validatedData);

        if (!empty($validatedData['upassword'])) {
            $user->upassword = bcrypt($validatedData['upassword']);
            $user->save();
         }

         if (!empty($validatedData['uphone_number'])) {
            $user->upassword = bcrypt($validatedData['uphone_number']);
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
            'upassword.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
        ];

        $validator = Validator::make($request->all(), [
            'urole' => 'required|string',
            'ufirst_name' => 'required|string',
            'ulast_name' => 'required|string',
            'uemail' => 'required|string|email|unique:users,uemail|ends_with:@upr.edu',
            'uphone_number' => 'required|string|digits:10|numeric|unique:users,uphone_number',
            'upassword' => 'required|string|min:6|max:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'uis_active' => 'required|boolean',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array
    $user = new User([
        'urole' => $validated['urole'],
        'ufirst_name' => $validated['ufirst_name'],
        'ulast_name' => $validated['ulast_name'],
        'uemail' => $validated['uemail'],
        'uphone_number' => $validated['uphone_number'],
        'upassword' => bcrypt($validated['upassword']),
        'uis_active' => $validated['uis_active'],
    ]);

    $user->remember_token = Str::random(6);
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
            'upassword.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];

         $validator = Validator::make($request->all(), [
            'ufirst_name' => 'required|string',
            'ulast_name' => 'required|string',
            'uemail' => 'required|string|email|max:20|ends_with:@upr.edu,'.$user->id,
            'uphone_number' => 'required|string|digits:10|numeric|unique:users,uphone_number,'.$user->id,
            'upassword' => 'required|string|min:6|max:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'uis_active' => 'required|boolean',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $user->update([
        'ufirst_name' => $validated['ufirst_name'],
        'ulast_name' => $validated['ulast_name'],
        'uemail' => $validated['uemail'],
        'uphone_number' => $validated['uphone_number'],
        'uis_active' => $validated['uis_active'],
    ]);

         //$user->update($validated);
         if (!empty($validated['upassword'])) {
            $user->upassword = $validated['upassword'];
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
}
