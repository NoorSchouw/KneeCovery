<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\Rule;

class SignUpController extends Controller
{
    // Toon signup-formulier
    public function showSignupForm()
    {
        return view('signup');
    }

    // Verwerk nieuwe gebruiker
    public function createUser(Request $request)
    {
        // Validatie
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => 'required|string|min:8|max:20',
        ]);

        // Maak nieuwe gebruiker
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/homepage')->with('success', 'Account created successfully!');
    }

}
