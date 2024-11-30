<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Diagnosis;
use Illuminate\Http\Request;

class AnimalController
{
    public function view()
    {
        // Get all animals
        $totalanimal = Animal::count();
        $totaldoctor = Doctor::count();
        $totalschedule = Schedule::count();
        $totaldiagnosis = Diagnosis::count();
        $animals = Animal::paginate(6);

        return view('animal', compact('totalanimal', 'totaldoctor', 'totalschedule', 'totaldiagnosis', 'animals'));
    }

    public function create(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'breed' => 'required',
            'age' => 'required',
            'owner_name' => 'required',
            'owner_contact' => 'required',
        ]);

        // Create a new animal
        $animal = Animal::create($validatedData);

        return redirect()->back()->with('success', 'Animal created successfully');
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->update($request->all());

        return redirect()->back()->with('success', 'Animal updated successfully');
    }

    public function delete($id)
    {
        Animal::destroy($id);

        return redirect()->back()->with('success', 'Animal deleted successfully');
    }
}
