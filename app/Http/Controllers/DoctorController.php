<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Animal;
use App\Models\Schedule;
use App\Models\Diagnosis;

class DoctorController
{
    public function view()
    {
        // Get all animals
        $totalanimal = Animal::count();
        $totaldoctor = Doctor::count();
        $totalschedule = Schedule::count();
        $totaldiagnosis = Diagnosis::count();
        $doctor = Doctor::paginate(6);

        return view('doctor', compact('totalanimal', 'totaldoctor', 'totalschedule', 'totaldiagnosis', 'doctor'));
    }

    public function create(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'specialization' => 'required',
            'contact' => 'required',
        ]);

        // Create a new doctor
        $docotr = Doctor::create($validatedData);

        return redirect()->back()->with('success', 'Doctor created successfully');
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->all());

        return redirect()->back()->with('success', 'Doctor updated successfully');
    }

    public function delete($id)
    {
        Doctor::destroy($id);

        return redirect()->back()->with('success', 'Doctor deleted successfully');
    }
}
