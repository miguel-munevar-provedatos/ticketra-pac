<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['message' => 'API funcionando']);
});
/**
 * API BASE UNAUTHENTICATED
 */
Route::post('/login', [UserController::class, 'login'])
    ->middleware(['web']);
Route::post('/register', [UserController::class, 'register']);
//-----------------------------------------------------------------------------


/**
 * API BASE AUTHENTICATED COKIE (SANCTUM)
 */
Route::group(['middleware' => ['web']], function () {
    Route::get('/sanctum/csrf-cookie', function (Request $request) {
        return response()->noContent();
    });

    Route::get('/check-auth', function (Request $request) {
        return response()->json([
            'authenticated' => true,
            'user' => $request->user()
        ]);
    });
});
//----------------------------------------------------------------------------


/**
 * API BASE AUTHENTICATED (SANCTUM)
 */
Route::group(['middleware' => 'auth:sanctum'], function () {

    //USER
    Route::post('/logout/{user}', UserController::class . '@logout');
    Route::get('/user/{user}', UserController::class . '@getUser');
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
    //---------------------------------------------------------------------
});
