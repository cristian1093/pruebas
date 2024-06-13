<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//de esta forma SOLO nos genera las rutas de los metodos que estan en el only
//Route::resource('blog',App\Http\Controllers\BlogController::class)->only(['index','store','show','update','destroy']);

//de esta forma nos genera todas las rutas
Route::prefix('movie')->group(function () {

    Route::get('/', [App\Http\Controllers\MovieController::class, 'index']);
    Route::post('/create', [App\Http\Controllers\MovieController::class, 'storeMovie']);
    Route::put('/update/{id}', [App\Http\Controllers\MovieController::class, 'updateMovie']);
    Route::get('/show/{id}', [App\Http\Controllers\MovieController::class, 'showMovie']);
    Route::delete('/delete/{id}', [App\Http\Controllers\MovieController::class, 'destroyMovie']);
});

Route::prefix('schedule')->group(function () {

    Route::get('/', [App\Http\Controllers\ScheduleController::class, 'index']);
    Route::post('/create', [App\Http\Controllers\ScheduleController::class, 'storeSchedule']);
    Route::put('/update/{id}', [App\Http\Controllers\ScheduleController::class, 'updateSchedule']);
    Route::get('/show/{id}', [App\Http\Controllers\ScheduleController::class, 'showSchedule']);
    Route::delete('/delete/{id}', [App\Http\Controllers\ScheduleController::class, 'destroySchedule']);
});
