<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\DashboardController;


Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/get-otp', [LoginController::class, 'getOTP'])->name('get-otp');
Route::post('/verify-otp', [LoginController::class, 'verifyOTP'])->name('verify-otp');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});