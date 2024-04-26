<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AccessCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AccessCodeController extends Controller
{
    public function generateAccessCode()
{
    $code = new AccessCode();
    $code->users_id = auth()->id(); // Assuming the coach is logged in
    $code->code = Str::random(10); // Generate a random string
    $code->expires_at = Carbon::now()->addSeconds(120); // Set expiration time
    $code->save();

    return view('coach.access_code', compact('code'));
}

public function generateAccessCodeAPI(Request $request)
{
    /*$validatedData = $request->validate([
        'users_id' => 'required|exists:users,id',
    ]);*/
    $code = new AccessCode();
    //$code->users_id = $validatedData['users_id']; // Assuming the coach is logged in
    $code->users_id = auth()->id();
    $code->code = Str::random(10); // Generate a random string
    $code->expires_at = Carbon::now()->addSeconds(300); // Set expiration time
    $code->save();

    return response()->json([
        'message' => 'Codigo de Acceso generado exitosamente',
        'code' => $code->code,
        'expires_at' => $code->expires_at,
    ]);
}
}
