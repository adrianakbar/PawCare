<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Animal;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Diagnosis;
use App\Models\Appointment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin user
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'), // Default password for admin
        ]);

        // Seed sample doctors
        $doctor1 = Doctor::create([
            'name' => 'Dr. John Doe',
            'specialization' => 'Veterinary Surgeon',
            'contact' => '123456789',
            'gender' => 'Male'
        ]);

        $doctor2 = Doctor::create([
            'name' => 'Dr. Jane Smith',
            'specialization' => 'Animal Nutritionist',
            'contact' => '987654321',
            'gender' => 'Female'
        ]);

        // Seed sample animals
        $animal1 = Animal::create([
            'name' => 'Buddy',
            'type' => 'Dog',
            'breed' => 'Golden Retriever',
            'age' => 3,
            'owner_name' => 'Alice',
            'owner_contact' => '555-1234',
        ]);

        $animal2 = Animal::create([
            'name' => 'Kitty',
            'type' => 'Cat',
            'breed' => 'Persian',
            'age' => 2,
            'owner_name' => 'Bob',
            'owner_contact' => '555-5678',
        ]);

        // Seed schedules for doctors
        Schedule::create([
            'doctor_id' => $doctor1->id,
            'animal_id' => $animal1->id,
            'date' => now()->addDays(1)->toDateString(),
            'time' => '10:00:00',
        ]);

        Schedule::create([
            'doctor_id' => $doctor2->id,
            'animal_id' => $animal2->id,
            'date' => now()->addDays(2)->toDateString(),
            'time' => '14:00:00',
        ]);

        // Seed diagnoses
        Diagnosis::create([
            'animal_id' => $animal1->id,
            'doctor_id' => $doctor1->id,
            'diagnosis' => 'Mild skin allergy',
        ]);

        Diagnosis::create([
            'animal_id' => $animal2->id,
            'doctor_id' => $doctor2->id,
            'diagnosis' => 'Nutritional deficiency',
        ]);
    }
}
