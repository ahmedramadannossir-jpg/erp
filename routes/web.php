<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstallmentContractController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\PublicClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::resource('clients', ClientController::class)->except(['show']);
Route::resource('contracts', InstallmentContractController::class)->only(['index', 'create', 'store', 'show']);
Route::patch('installments/{installment}/paid', [InstallmentController::class, 'markPaid'])->name('installments.paid');

Route::get('/u/{token}', [PublicClientController::class, 'show'])->name('public.clients.show');
