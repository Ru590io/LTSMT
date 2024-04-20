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
}
