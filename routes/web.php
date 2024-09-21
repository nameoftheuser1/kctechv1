<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/searchroom', [HomeController::class, 'searchRoom'])->name('searchRoom');
Route::post('/searchroom', [HomeController::class, 'search']);

Route::resource('rooms', RoomController::class);
Route::resource('staff', StaffController::class);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
