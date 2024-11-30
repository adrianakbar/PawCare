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
        $animal = Animal::all();

        return view('schedule', compact('doctor', 'animal'));
    }

    public function create(Request $request)
    {
        // Validasi data input
        $request->validate([
            'doctor' => 'required',
            'name' => 'required',
            'type' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        // Cari animal_id berdasarkan nama dan tipe
        $animal = Animal::where('name', $request->name)
            ->where('type', $request->type)
            ->first();

        if (!$animal) {
            return redirect()->back()->with('error', 'Animal not found.');
        }

        // Simpan data ke tabel schedule
        Schedule::create([
            'doctor_id' => $request->doctor,
            'animal_id' => $animal->id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 0, // Default value
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Schedule created successfully.');
    }

    public function updateStatus(Request $request)
    {
        $schedule = Schedule::find($request->id);
        if ($schedule) {
            $schedule->status = $request->status;
            $schedule->save();
        }
    }
}
