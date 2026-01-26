<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [EventController::class, 'home'])->name('home');

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.public.show');
    
    Route::get('/dashboard', [RegistrationController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


    Route::post('events/{id}/register', [EventController::class, 'register'])->name('events.register');
    Route::delete('events/{id}/unregister', [EventController::class, 'unregister'])->name('events.unregister');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); //affichage
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); //modification
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('events', EventController::class);
});

require __DIR__.'/auth.php';
