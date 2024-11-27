<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'doctor_id',
        'date',
        'time',
        'status',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
