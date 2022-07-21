<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StreamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->prefix('/dashboard')->group(function() {
    Route::controller(DashboardController::class)->group(function() {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::controller(StreamController::class)->group(function() {
        Route::get('/streams/create', 'create')->name('stream-create-form');
        Route::post('/streams/create', 'store')->name('stream-store');
    });
});

require __DIR__.'/auth.php';
