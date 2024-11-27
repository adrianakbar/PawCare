<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Animal;
use App\Models\Schedule;
use App\Models\Diagnosis;

class ScheduleController
{
    public function view()
    {
        // Get all animals
        $doctor = Doctor::all();

        return view('schedule', compact('doctor'));
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
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->back()->with('success', 'Doctor deleted successfully');
    }
}
