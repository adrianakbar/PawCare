<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Diagnosis;
use App\Models\Doctor;

class DiagnosisController
{
    public function view()
    {
        $animal = Animal::all();
        $groupedAnimals = $animal->groupBy('type');
        return view('diagnosis', compact('animal', 'groupedAnimals'));
    }

    public function create(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'diagnosis' => 'required',
        ]);

        // Cari animal_id berdasarkan nama dan tipe
        $animal = Animal::where('name', $request->name)
            ->where('type', $request->type)
            ->first();

        if (!$animal) {
            return redirect()->back()->with('error', 'Animal not found.');
        }

        // Simpan data ke tabel schedule
        Diagnosis::create([
            'animal_id' => $animal->id,
            'diagnosis' => $request->diagnosis,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Diagnosis created successfully.');
    }

    public function delete($id)
    {
        // Hapus data diagnosis berdasarkan id
        Diagnosis::destroy($id);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Diagnosis deleted successfully.');
    }
}
