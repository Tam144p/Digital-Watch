<?php

use App\Http\Controllers\EventController;

Route::resource('events', EventController::class);

Route::get('/', function () {
    return view('jamdigital'); // Nama file view
})->name('jamdigital');

Route::get('/alarm', function () {
    return view('alarm');
});

Route::get('/timer', function () {
    return view('timer');
});

Route::get('/stopwatch', function () {
    return view('stopwatch');
});

Route::get('/detail', [EventController::class, 'detail'])->name('detail');

