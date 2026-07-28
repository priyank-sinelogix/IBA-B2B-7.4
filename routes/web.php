<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\SampleWebController;
use App\Http\Controllers\Web\OrderWebController;
use App\Http\Controllers\Web\ShipmentWebController;
use App\Http\Controllers\Web\FinanceWebController;
use App\Http\Controllers\Web\MessageWebController;
use App\Http\Controllers\Web\SampleRequestWebController;
use App\Http\Controllers\Admin\Web\AdminAuthController;
use App\Http\Controllers\Admin\Web\CompanyController;
use App\Http\Controllers\Admin\Web\LedgerController;
use App\Http\Controllers\Admin\Web\AuditLogController;
use App\Http\Controllers\Admin\Web\SkuController;
use App\Http\Controllers\Admin\Web\PricingController;
use App\Http\Controllers\Admin\Web\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

// Guest - customer
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Guest - internal staff
Route::middleware('guest')->prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin']);
    Route::post('/login', [AdminAuthController::class, 'login']);
});

// Authenticated customer portal (AdminLTE views)
Route::middleware(['auth', 'customer.scope'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/samples', [SampleWebController::class, 'index']);
    Route::get('/samples/{sample}', [SampleWebController::class, 'show']);
    Route::post('/samples/{sample}/approve', [SampleWebController::class, 'approve']);
    Route::post('/samples/{sample}/revise', [SampleWebController::class, 'requestRevision']);
    Route::post('/samples/{sample}/size-chart/approve', [SampleWebController::class, 'approveSizeChart']);

    Route::get('/sample-requests', [SampleRequestWebController::class, 'index']);
    Route::get('/sample-requests/create', [SampleRequestWebController::class, 'create']);
    Route::post('/sample-requests', [SampleRequestWebController::class, 'store']);

    Route::get('/orders', [OrderWebController::class, 'index']);

    Route::get('/shipments', [ShipmentWebController::class, 'index']);

    Route::get('/finance', [FinanceWebController::class, 'index']);
    Route::get('/finance/statement/download', [FinanceWebController::class, 'downloadStatement']);

    Route::get('/messages', [MessageWebController::class, 'index']);
    Route::post('/messages', [MessageWebController::class, 'store']);
});

// Authenticated internal admin panel — full CRUD for the IBA team
Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout']);

    Route::get('/dashboard', [\App\Http\Controllers\Admin\Web\DashboardController::class, 'index']);

    // Full resource routes now include 'show' — every list row is clickable
    Route::resource('companies', CompanyController::class);
    Route::resource('samples', \App\Http\Controllers\Admin\Web\SampleController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\Web\OrderController::class);
    Route::resource('shipments', \App\Http\Controllers\Admin\Web\ShipmentController::class);
    Route::resource('users', \App\Http\Controllers\Admin\Web\UserController::class);

    // Admin posting their own point/comment on a sample (visible to the client too)
    Route::post('/samples/{sample}/comment', [\App\Http\Controllers\Admin\Web\SampleController::class, 'storeComment']);
    Route::post('/samples/{sample}/size-chart', [\App\Http\Controllers\Admin\Web\SampleController::class, 'updateSizeChart']);
    Route::get('/samples/{sample}/pdf', [PdfController::class, 'generate']);

    // Client-submitted new sample requests
    Route::get('/sample-requests', [\App\Http\Controllers\Admin\Web\SampleRequestController::class, 'index']);
    Route::get('/sample-requests/{sampleRequest}', [\App\Http\Controllers\Admin\Web\SampleRequestController::class, 'show']);
    Route::post('/sample-requests/{sampleRequest}/status', [\App\Http\Controllers\Admin\Web\SampleRequestController::class, 'updateStatus']);
    Route::post('/sample-requests/{sampleRequest}/convert', [\App\Http\Controllers\Admin\Web\SampleRequestController::class, 'convert']);

    // SKU generation
    Route::resource('skus', SkuController::class)->except(['show']);

    // Pricing table
    Route::resource('pricing', PricingController::class)->except(['show']);

    Route::get('/finance', [LedgerController::class, 'index']);
    Route::get('/finance/create', [LedgerController::class, 'create']);
    Route::post('/finance', [LedgerController::class, 'store']);
    Route::delete('/finance/{entry}', [LedgerController::class, 'destroy']);

    Route::get('/audit-logs', [AuditLogController::class, 'index']);
});
