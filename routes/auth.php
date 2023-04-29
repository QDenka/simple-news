<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
