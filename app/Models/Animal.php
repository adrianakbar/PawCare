<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'breed',
        'age',
        'owner_name',
        'owner_contact',
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
