<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/convert', [App\Http\Controllers\HomeController::class, 'convert'])->name('convert');
Route::get('/history', [App\Http\Controllers\HomeController::class, 'history'])->name('history');
Route::get('/get-history', [App\Http\Controllers\HomeController::class, 'getHistory'])->name('get-history');

// User profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('user-profile');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('update-profile');
Route::get('/get-profile', [App\Http\Controllers\ProfileController::class, 'getProfile'])->name('get-profile');
