<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginUserController;

/** Login */
//Auth::routes();
//Route::get('/login/{email}/{password}', [LoginUserController::class, 'loginByEmail']);

/****************************************************************************/
/********************* Redirect to Support Multi Languages ******************/
/****************************************************************************/

Route::get('/', function () {
    return redirect()->to('/' . Locale() . '/');
});

Route::any('{query}', function ($query) {
    $query = explode('/', $query);
    foreach ($query as $i => $q) {
        if (in_array($q, array_keys(Languages()))) {
            unset($query[$i]);
        }
    }
    $query = implode('/', $query);
    return redirect('/' . Locale() . '/' . $query);
})->where('query', '.*');

/****************************************************************************/
/****************************************************************************/
/****************************************************************************/
