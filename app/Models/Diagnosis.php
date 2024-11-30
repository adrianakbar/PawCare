<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'diagnosis',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);  // Pastikan menggunakan foreign key yang sesuai
    }
}
