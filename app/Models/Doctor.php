<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'specialization',
        'contact',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
