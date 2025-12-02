<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('forgot_password');
    }

    public function reset(Request $request)
    {
        // 1. Validatie
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // 2. Check of het e-mailadres bestaat
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Melding als email niet bestaat
            return back()->withErrors([
                'email' => 'There is no user with this email address.'
            ])->withInput();
        }

        // 3. Update het wachtwoord
        $user->password = $request->password; // cast 'hashed' zorgt voor encryptie
        $user->save();

        // 4. Redirect met succesmelding
        return redirect('/homepage')->with('success', 'Password successfully reset!');
    }

}

