<?php

use App\Http\Controllers\BookeetController;
use App\Http\Controllers\USSDController;
use Illuminate\Support\Facades\Route;


Route::post('ussd', [USSDController::class, 'index']);


Route::post('create', [BookeetController::class, 'createVirtualAccount']);
Route::post('transfer', [BookeetController::class, 'payout']);
Route::get('account', [BookeetController::class, 'getVirtualAccount']);
Route::get('transactions', [BookeetController::class, 'getTransactions']);
