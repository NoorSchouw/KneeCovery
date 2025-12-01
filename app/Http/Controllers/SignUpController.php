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
            'email' => ['required', 'email', 'max:255', Rule::unique('user', 'email')],
            'password' => 'required|string|min:8|max:20',
        ]);

        // Naam opsplitsen
        [$firstName, $lastName] = $this->splitName($request->name);

        // Maak nieuwe gebruiker
        User::create([
            'first_name' => $firstName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => 'undefined',
            'last_name' => $lastName,
        ]);

        return redirect('/homepage')->with('success', 'Account created successfully!');
    }

    private function splitName(string $name): array
    {
        $parts = preg_split('/\s+/', trim($name));

        if (count($parts) === 1) {
            return [$parts[0], ''];
        }

        $firstName = array_shift($parts);   // first element
        $lastName  = implode(' ', $parts);  // everything else

        return [$firstName, $lastName];
    }


}
