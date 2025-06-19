<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerminalController;
use App\Livewire\User\HomeComponent;

Route::get('/', HomeComponent::class)->name('home');

/** Welcome Page */
/*Route::get('/', function () {
    return view('welcome');
});*/

/** Dashboard Page */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';

Route::get('/code', [TerminalController::class, 'code'])->name('terminal');

