<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    // Step 2: Email not found
    if (!$user) {
        return response()->json(['errors' => ['email' => ['This email does not exist in our records.']]], 422);
    }

    // Step 3: Password mismatch
    if (!Hash::check($request->password, $user->password)) {
        return response()->json(['errors' => ['password' => ['Incorrect password.']]], 422);
    }

    // Step 4: Login success
    Auth::login($user);
    return response()->json(['message' => 'Login successfull!']);
}


    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
