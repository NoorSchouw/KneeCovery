<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class AddPatientsController extends Controller
{
    public function index()
    {
        $patients = Patient::orderBy('id')->get();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'patient_number' => 'nullable|string',
            'gender' => 'nullable|string',
            'dob' => 'required|date',
            'email' => 'nullable|email',
            'mobile' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'injured_knee' => 'nullable|string',
        ]);

        Patient::create($data);

        return redirect()->route('patients.index')
            ->with('success', 'Patient added successfully');
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $data = $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'patient_number' => 'nullable|string',
            'gender' => 'nullable|string',
            'dob' => 'required|date',
            'email' => 'nullable|email',
            'mobile' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'injured_knee' => 'nullable|string',
        ]);

        $patient->update($data);

        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Patient deleted');
    }
}
