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

Route::resource('prompts', PromptController::class)->middleware('auth');
Route::get('prompts-export', [PromptController::class, 'export'])->middleware('auth')->name('prompts.export');
Route::post('prompts-import', [PromptController::class, 'import'])->middleware('auth')->name('prompts.import');
Route::post('prompts/{prompt}/favorite', [PromptController::class, 'toggleFavorite'])->middleware('auth')->name('prompts.favorite');
Route::post('prompts/{prompt}/duplicate', [PromptController::class, 'duplicate'])->middleware('auth')->name('prompts.duplicate');
Route::post('prompts/{prompt}/use', [PromptController::class, 'incrementUse'])->middleware('auth')->name('prompts.use');

Route::resource('users', RegisteredUserController::class)
    ->middleware(['auth', 'can:admin-only']);

require __DIR__.'/auth.php';
