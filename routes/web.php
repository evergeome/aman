<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerminalController;
use App\Livewire\Main\HomeComponent;

/** Home */
Route::get('/', HomeComponent::class)->name('home');

/** Dashboard Page */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';

Route::get('/code', [TerminalController::class, 'code'])->name('terminal');

