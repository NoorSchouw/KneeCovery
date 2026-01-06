<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // 1. Validate input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Optional: relations eager load
            Auth::user()->load(['patient', 'physiotherapist']);

            // 4. Redirect to homepage
            return redirect('/homepage');
        }

        // 5. If failed
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'There is no user with this email.'
            ])->onlyInput('email');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
