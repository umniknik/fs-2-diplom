<?php

use App\Http\Controllers\HallController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\PricesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('hall', function() {
    return view('hall');
} );

Route::get('payment', function() {
    return view('payment');
});

Route::get('ticket', function() {
    return view('ticket');
});

Route::get('admin', function() {
    return view('admin.index');
});

//Роутер создания нового зала
Route::post('create-hall', [HallController::class, 'createHall']);
// Route::post('/create-hall', 'HallController@createHall');  // такая запись не работает, похоже устарела

//Роутер отображения всех залов на странице администрирования залов
Route::get('admin', [HallController::class, 'showAllHalls']);

// Route::post('delete-hall', [HallController::class, 'destroy']);
Route::delete('/delete-hall/{hall}', [HallController::class, 'destroy'])->name('hall.destroy');

Route::post('create-seats', [SeatController::class, 'createSeats']);

//Маршрут получаения всех мест в зале по id зала
Route::get('/api/halls/{hallId}/seats', [App\Http\Controllers\SeatController::class, 'getSeatsByHallId']);

//Маршрут для создания новых записей цен на места
Route::post('create-prices', [PricesController::class, 'createPrices']);

//Маршрут получаения всех цен на места в зале по id зала
Route::get('/api/halls/{hallId}/prices', [App\Http\Controllers\PricesController::class, 'getPricesByHallId']);