<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SetLocale;

use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        function (){

            Route::prefix('{locale?}')
                ->where(['locale' => '[a-zA-Z]{2}-[a-zA-Z]{2}'])
                ->group(function () {
                    Route::domain('admin.' . env('APP_URL'))
                        ->middleware(['web', 'auth', 'verified', 'authAdmin'])
                        ->name('admin.')
                        ->group(base_path('routes/admin.php'));

                    Route::domain('care.' . env('APP_URL'))
                        ->middleware(['web', 'auth', 'verified', 'authCare'])
                        ->name('care.')
                        ->group(base_path('routes/care.php'));

                    Route::domain(env('APP_URL'))
                        ->middleware('web')
                        ->group(base_path('routes/web.php'));
                });

            Route::middleware('web')
                ->group(base_path('routes/locale.php'));
        },
        //web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(SetLocale::class);
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
