<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientInjury;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddPatientsController extends Controller
{
    public function index()
    {
        // Only active patients
        $patients = Patient::with(['user', 'injury'])
            ->where('treatment_status', 'active')
            ->orderBy('user_id')
            ->get();

        return view('fysio.patients', compact('patients'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'nullable|email',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'phone_number' => 'nullable|string',
            'injured_knee' => 'required|string|in:left knee,right knee',
            'medical_notes' => 'nullable|string',
            'patient_number'  => 'required|string',
        ]);

        DB::transaction(function () use ($data) {

            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'] ?? null,
                'gender' => $data['gender'],
                'password' => bcrypt('default123'),
            ]);

            Patient::create([
                'user_id' => $user->user_id,
                'phy_user_id' => auth()->user()->user_id,
                'physio_number' => auth()->user()->physiotherapist->physio_number ?? 1,
                'start_date' => now(),
                'treatment_status' => 'active',
                'medical_notes' => $data['medical_notes'] ?? null,
                'phone_number' => $data['phone_number'] ?? null,
                'date_of_birth' => $data['dob'],
                'patient_number' => $data['patient_number'], // new
            ]);

            PatientInjury::create([
                'user_id' => $user->user_id,
                'phy_user_id' => auth()->user()->user_id,
                'physio_number' => auth()->user()->physiotherapist->physio_number ?? 1,
                'affected_area' => $data['injured_knee'],
            ]);
        });

        return redirect()->route('patients.index');
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $user = $patient->user;

        DB::transaction(function () use ($request, $patient, $user) {

            // 🔒 FORCE STRINGS (this fixes EVERYTHING)
            $firstName = $request->input('edit_first_name');
            $lastName = $request->input('edit_last_name');
            $email = $request->input('edit_email');
            $gender = $request->input('edit_gender');
            $dob = $request->input('edit_dob');
            $phone = $request->input('edit_phone_number');
            $notes = $request->input('edit_medical_notes');
            $knee = $request->input('edit_injured_knee');

            // Update user
            $user->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'gender' => $gender,
            ]);

            // Update patient
            $patient->update([
                'phone_number' => $phone,
                'date_of_birth' => $dob,
                'medical_notes' => $notes,
            ]);

            // Update OR create injury
            $injury = PatientInjury::firstOrNew([
                'user_id' => $patient->user_id,
                'phy_user_id' => auth()->user()->user_id,
                'physio_number' => auth()->user()->physiotherapist->physio_number ?? 1,
            ]);

            $injury->affected_area = $knee;
            $injury->save();
        });

        return redirect()->route('patients.index');
    }

    // DELETE a patient by changing the status to inactive
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->update(['treatment_status' => 'inactive']);
        return redirect()->route('patients.index')->with('success', 'Patient marked as inactive.');
    }

    public function report($user_id)
    {
        // Haal de patiënt op
        $patient = Patient::with(['user', 'injury'])->findOrFail($user_id);

        // Sla geselecteerde patient op in session
        session([
            'selected_patient_id' => $patient->user_id
        ]);

        // Redirect naar ReportPhysioController@index
        return redirect()->route('fysio.report');
    }

}
