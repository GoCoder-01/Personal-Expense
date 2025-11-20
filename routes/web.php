<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

Route::get('/dashboard', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/get-otp', [LoginController::class, 'getOTP'])->name('get-otp');
Route::post('/verify-otp', [LoginController::class, 'verifyOTP'])->name('verify-otp');