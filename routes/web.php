<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\config\FinancialyearController;


Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/get-otp', [LoginController::class, 'getOTP'])->name('get-otp');
Route::post('/verify-otp', [LoginController::class, 'verifyOTP'])->name('verify-otp');

Route::middleware('auth')->group(function(){
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/financial-year', [FinancialyearController::class, 'financialYears'])->name('financial-year.index');
    Route::get('/create-financial-year', [FinancialyearController::class, 'create'])->name('financial-year.create');
    Route::post('/store-financial-year-data', [FinancialyearController::class, 'store'])->name('financial-year.store');
});