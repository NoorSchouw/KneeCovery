<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login page
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Handle login attempt
     */
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

            $user = Auth::user();

            // 3. Redirect based on role
            if ($user->physiotherapist()->exists()) {
                return redirect()->route('patients.index');
            }


            if ($user->patient()->exists()) {
                return redirect()->route('homepage');
            }

            // 4. Safety fallback (no role)
            Auth::logout();
            return redirect('/')
                ->withErrors([
                    'email' => 'This account has no role assigned.'
                ]);
        }

        // 5. Login failed — check why
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->withErrors(['email' => 'There is no user with this email.'])
                ->onlyInput('email');
        }

        return back()
            ->withErrors(['email' => 'The provided credentials do not match.'])
            ->onlyInput('email');
    }

    /**
     * Logout the user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
