<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Doctor;

class DiagnosisController
{
    public function view()
    {
        $animal = Animal::all();
        return view('diagnosis', compact('animal'));
    }
}
