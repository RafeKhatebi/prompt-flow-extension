<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromptController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Prompts the user to log in or register when they access the dashboard without being authenticated. The 'auth' middleware checks if the user is logged in, and if not
Route::resource('prompts', PromptController::class)->middleware('auth');
Route::resource('users', RegisteredUserController::class)->middleware('auth');
// The parameter name {user} must match $user in the controller


require __DIR__.'/auth.php';
