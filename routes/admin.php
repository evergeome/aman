<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TerminalController;

/** Code */
Route::get('/code', [TerminalController::class, 'code'])->name('terminal');
