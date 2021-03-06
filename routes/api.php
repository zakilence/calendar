<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CalendarController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// カレンダー関連
// Route::group(['prefix' => 'calendars', 'as' => 'calendars.'], function () {
//     Route::get('/', [CalendarController::class, 'index'])->name('index');
//     Route::get("/{id}", [CalendarController::class, 'show'])->name('show');
//     Route::post('/', [CalendarController::class, 'create'])->name('create');
//     Route::put('/{id}', [CalendarController::class, 'save'])->name('update');
//     Route::delete('/{id}', [CalendarController::class, 'destroy'])->name('delete');
// });

// // イベント関連
// Route::group(['prefix' => 'events', 'as' => 'events.'], function () {
//     Route::get('/', [EventController::class, 'index'])->name('index');
//     Route::get("/{id}", [EventController::class, 'show'])->name('show');
//     Route::post('/', [EventController::class, 'create'])->name('create');
//     Route::put('/{id}', [EventController::class, 'save'])->name('update');
//     Route::delete('/{id}', [EventController::class, 'destroy'])->name('delete');
// });