<?php

use App\Http\Controllers\News\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('news', [NewsController::class, 'index'])->name('news.index');

Route::middleware('auth')
    ->name('news.')
    ->controller(NewsController::class)
    ->prefix('news')->group(function () {
        Route::post('/', 'store');
        Route::put('/{news}', 'update');
        Route::delete('/{news}', 'destroy');
    });
