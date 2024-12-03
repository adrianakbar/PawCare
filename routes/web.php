<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Middleware\LogMethodCalls;
use App\Http\Controllers\GraphController;
use App\Models\Animal;
use App\Models\Doctor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);


    Route::get('/animal', [AnimalController::class, 'view']);
    Route::post('/animal', [AnimalController::class, 'create']);
    Route::delete('/animal/{id}', [AnimalController::class, 'delete'])->name('animals.delete');
    Route::put('/animal/{id}', [AnimalController::class, 'update']);

    Route::get('/doctor', [DoctorController::class, 'view']);
    Route::post('/doctor', [DoctorController::class, 'create']);
    Route::delete('/doctor/{id}', [DoctorController::class, 'delete'])->name('doctors.delete');
    Route::put('/doctor/{id}', [DoctorController::class, 'update']);

    Route::get('/schedule', [ScheduleController::class, 'view']);
    Route::post('/update-schedule-status', [ScheduleController::class, 'updateStatus']);
    Route::post('/schedule', [ScheduleController::class, 'create']);

    Route::get('/diagnosis', [DiagnosisController::class, 'view']);
    Route::post('/diagnosis', [DiagnosisController::class, 'create']);
    Route::delete('/diagnosis/{id}', [DiagnosisController::class, 'delete'])->name('diagnoses.delete');

Route::get('/graph', [GraphController::class, 'index']);
