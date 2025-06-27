<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando']);
});

Route::post('/login', UserController::class . '@login');
Route::post('/register', UserController::class . '@register');

//grupo de rutas protegidas
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    //USER
    Route::post('/logout/{user}', UserController::class . '@logout');
    Route::get('/user/{user}', UserController::class . '@getUser');

});


