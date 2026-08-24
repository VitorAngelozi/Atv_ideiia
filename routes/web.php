<?php

use App\Http\Controllers\StudyActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StudyActivityController::class, 'dashboard'])->name('dashboard');
Route::patch('/atividades/{activity}/status', [StudyActivityController::class, 'updateStatus'])
    ->name('activities.status');
Route::resource('atividades', StudyActivityController::class)
    ->parameters(['atividades' => 'activity'])
    ->names('activities');
