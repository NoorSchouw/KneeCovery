<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{
    public function information()
    {
        $userId = Auth::id(); // logged-in user's ID

        $patient = Patient::with('user', 'injury')
            ->where('user_id', $userId)
            ->firstOrFail();

        return view('patient.information', compact('patient'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . $user->id . ',id',
            'phone_number' => 'nullable|string|max:20',
            'gender'     => 'required|string|in:male,female,other',
        ]);

        // Update user info
        $user->update([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'gender'     => $data['gender'],
        ]);

        // Update patient phone number
        $patient = $user->patient;
        if ($patient) {
            $patient->update([
                'phone_number' => $data['phone_number'] ?? $patient->phone_number,
            ]);
        }

        return redirect()->route('patient.information')->with('success', 'Information updated successfully.');
    }
}
